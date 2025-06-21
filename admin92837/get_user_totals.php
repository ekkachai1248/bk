<?php
include_once("checklogin.php");
include '../connectdb.php';

// ดึงข้อมูลจาก user_totals view
$sql = "SELECT role, count FROM user_totals";
$result = $conn->query($sql);

$roles = [];
$counts = [];

while ($row = $result->fetch_assoc()) {
    $roles[] = $row['role'];
    $counts[] = $row['count'];
}

// จัดการให้ PHP ส่งค่าผ่าน JSON ไปยัง JavaScript
$data = [
    'roles' => $roles,
    'counts' => $counts
];

echo json_encode($data);
?>