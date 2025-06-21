<?php
// สร้าง Logs
function addLog($conn, $user_id, $fullname, $role, $action, $details = null) {
    $stmt = $conn->prepare("INSERT INTO logs (user_id, fullname, role, action, details) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $fullname, $role, $action, $details);
    $stmt->execute();
    $stmt->close();
}
?>