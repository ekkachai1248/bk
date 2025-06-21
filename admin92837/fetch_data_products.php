<?php
include_once("../connectdb.php");
header('Content-Type: application/json; charset=utf-8');

$sql = "SELECT * FROM products AS p
LEFT JOIN products_category AS pc
ON p.pc_id = pc.pc_id
ORDER BY p.p_id DESC ";
$result = $conn->query($sql);
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// คำนวณจำนวนข้อมูลทั้งหมดในตาราง
$totalResult = $conn->query("SELECT COUNT(*) as total FROM products");
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