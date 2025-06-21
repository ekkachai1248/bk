<?php
include_once("checklogin.php");
include '../connectdb.php'; // เชื่อมต่อฐานข้อมูล

$sql = "SELECT type, total FROM booking_totals";
$result = $conn->query($sql);

$totals = [];
while ($row = $result->fetch_assoc()) {
    $totals[$row['type']] = number_format($row['total'], 0, '.', ','); // ใส่ comma format
}

echo json_encode($totals, JSON_UNESCAPED_UNICODE); // ส่งเป็น JSON
?>