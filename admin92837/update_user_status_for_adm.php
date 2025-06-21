<?php
session_start();
include('../connectdb.php'); 
include_once("functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['status_type'], $_POST['new_value'])) {
    $userId = $_POST['user_id'];
    $statusType = $_POST['status_type'];
    $newValue = $_POST['new_value'];

    // อัปเดตฟิลด์ในฐานข้อมูลตาม status_type (available หรือ enable)
    if ($statusType === 'active') {
        $sql = "UPDATE users SET available = ? WHERE user_id = ?";
    } elseif ($statusType === 'enable') {
        $sql = "UPDATE users SET enable = ? WHERE user_id = ?";
    } else {
        // หาก status_type ไม่ตรงกับที่กำหนด
        echo json_encode(['status' => 'failed', 'message' => 'Invalid status type']);
        exit;
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $newValue, $userId);

    if ($stmt->execute()) {
        addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "อัปเดตสถานะผู้ใช้", "อัปเดตสถานะผู้ใช้ User ID: {$userId} {$newValue}");
        echo json_encode(['status' => 'success', 'message' => 'อัปเดตสถานะสำเร็จ']);
    } else {
        echo json_encode(['status' => 'failed', 'message' => 'เกิดข้อผิดพลาดในการอัปเดต']);
    }
}
?>