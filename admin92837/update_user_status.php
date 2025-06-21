<?php
session_start();
header('Content-Type: application/json');

$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'], $_POST['available'])) {
    include_once("../connectdb.php");
    include_once("functions.php");
    $userId = intval($_POST['user_id']);
    $status = $_POST['available'];

    if (in_array($status, ['active', 'inactive'])) {
        $stmt = $conn->prepare("UPDATE users SET available = ? WHERE user_id = ?");
        $stmt->bind_param("si", $status, $userId);
        
        addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "อัปเดตสถานะผู้ใช้", "อัปเดตสถานะผู้ใช้ของตนเอง User ID: {$userId} {$status}");
        
        $response['success'] = $stmt->execute();
    }
}

echo json_encode($response);
exit;
?>