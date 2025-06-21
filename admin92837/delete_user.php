<?php
include_once("checklogin.php");
include_once("../connectdb.php");
include_once("functions.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $user_id = $conn->real_escape_string($_POST['user_id']);

    // ดึงข้อมูลรูปภาพของผู้ใช้จากฐานข้อมูล
    $query = "SELECT picture FROM users WHERE user_id = '$user_id'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filePath = "../images/users/" . $row['picture']; // สร้างเส้นทางไฟล์รูปภาพ

        // ลบรูปภาพจากโฟลเดอร์
        if (!empty($row['picture']) && file_exists($filePath)) {
            unlink($filePath); // ลบไฟล์
        }

        // ลบข้อมูลจากฐานข้อมูล
        $sql = "DELETE FROM users WHERE user_id = '$user_id'";
        if ($conn->query($sql) === TRUE) {
            addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "ลบผู้ใช้", "ลบผู้ใช้ User ID: {$user_id}");
            echo "success"; // ส่งข้อความสำเร็จกลับ
        } else {
            echo "ข้อผิดพลาด: " . $conn->error; // ส่งข้อความข้อผิดพลาดกลับ
        }
    } else {
        echo "ไม่พบผู้ใช้";
    }
} else {
    echo "คำขอไม่ถูกต้อง";
}
?>
