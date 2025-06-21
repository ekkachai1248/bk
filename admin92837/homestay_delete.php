<?php
session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'เกิดข้อผิดพลาด'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['homestay_id'])) {
    include_once("../connectdb.php");
    include_once("functions.php");
    $h_id = intval($_POST['homestay_id']);

    if ($h_id > 0) {
        // ดึงข้อมูลชื่อไฟล์รูปภาพจากฟิลด์ h_pictures
        $sqlSelect = "SELECT h_pictures, h_name FROM homestays WHERE homestay_id = ?";
        $stmtSelect = $conn->prepare($sqlSelect);
        
        if ($stmtSelect) {
            $stmtSelect->bind_param("i", $h_id);
            $stmtSelect->execute();
            $stmtSelect->bind_result($h_pictures, $h_name);
            $stmtSelect->fetch();
            $stmtSelect->close();
            
            if (!empty($h_pictures)) {
                // แยกชื่อไฟล์จากข้อมูล h_pictures ที่ถูกเก็บในฐานข้อมูล
                $picturesArray = explode(";", $h_pictures);
                
                // ลบไฟล์รูปภาพที่เก็บไว้ในโฟลเดอร์
                foreach ($picturesArray as $picture) {
                    $filePath = "../images/homestay/" . $picture;
                    if (file_exists($filePath)) {
                        unlink($filePath); // ลบไฟล์
                    }
                }
            }
        }

        // ลบข้อมูลในตาราง
        $sqlDelete = "DELETE FROM homestays WHERE homestay_id = ?";
        $stmtDelete = $conn->prepare($sqlDelete);

        if ($stmtDelete) {
            $stmtDelete->bind_param("i", $h_id);
            if ($stmtDelete->execute()) {
                // บันทึก Log การลบ
                addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "ลบที่พัก", "ลบที่พัก id: {$h_id} ชื่อ: {$h_name}");
                
                $response = ['success' => true, 'message' => 'ลบข้อมูลสำเร็จ!'];
            } else {
                $response['message'] = 'ไม่สามารถลบข้อมูลได้';
            }
            $stmtDelete->close();
        } else {
            $response['message'] = 'เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL';
        }
    } else {
        $response['message'] = 'ID ของข้อมูลไม่ถูกต้อง';
    }
} else {
    $response['message'] = 'คำขอไม่ถูกต้อง';
}

// ตรวจสอบไม่มีข้อความอื่น ๆ
ob_clean(); // ล้างบัฟเฟอร์เอาต์พุต

echo json_encode($response);
exit;
?>