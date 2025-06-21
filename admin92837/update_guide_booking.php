<?php
session_start();
include '../connectdb.php';
include_once("functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ตรวจสอบค่าที่ได้รับ
    if (isset($_POST['owner']) && isset($_POST['id'])) {
        $owner = intval($_POST['owner']); // ค่าที่เลือกจาก <select>
        $id = intval($_POST['id']);       // ID ของ booking_details

        // เตรียมคำสั่ง SQL
        $sql = "UPDATE booking_details SET owner = ? WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ii", $owner, $id);

            // เรียกใช้คำสั่ง SQL
            if ($stmt->execute()) {
                addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "เลือกไกด์", "เลือกไกด์ ID: {$owner} ของ booking_details ID: {$id} ");
                echo json_encode(["status" => "success", "message" => "อัปเดตสำเร็จ!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "เกิดข้อผิดพลาด!"]);
            }

            // ปิดการเชื่อมต่อ
            $stmt->close();
        } else {
            echo json_encode(["status" => "error", "message" => "คำสั่ง SQL ไม่ถูกต้อง"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "ข้อมูลไม่ครบถ้วน"]);
    }

    // ปิดการเชื่อมต่อ
    //$conn->close();
}
?>

