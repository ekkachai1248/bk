<?php
include_once("checklogin.php");
include_once("../connectdb.php");
header('Content-Type: application/json; charset=utf-8');

$sql = "SELECT * FROM foods AS f
LEFT JOIN foods_category AS fc
ON f.fc_id = fc.fc_id
WHERE f.c_id='{$_SESSION['buser_id']}'
ORDER BY f.f_id DESC ";
$result = $conn->query($sql);
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// คำนวณจำนวนข้อมูลทั้งหมดในตาราง
$totalResult = $conn->query("SELECT COUNT(*) as total FROM foods WHERE c_id='{$_SESSION['buser_id']}'");
$totalRow = $totalResult->fetch_assoc();

// ส่งข้อมูลกลับไปยัง DataTables
$response = [
    "draw" => isset($_GET['draw']) ? intval($_GET['draw']) : 0,
    "recordsTotal" => $totalRow['total'],
    "recordsFiltered" => $totalRow['total'],
    "data" => $data
];

// ส่งข้อมูลเป็น JSON
echo json_encode($response);
?>