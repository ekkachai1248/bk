<?php
session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'เกิดข้อผิดพลาด'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    include_once("../connectdb.php");
    include_once("functions.php");
    $p_id = intval($_POST['product_id']);

    if ($p_id > 0) {
        // ดึงข้อมูลชื่อไฟล์รูปภาพจากฟิลด์ p_pictures
        $sqlSelect = "SELECT p_pictures, p_name FROM products WHERE p_id = ?";
        $stmtSelect = $conn->prepare($sqlSelect);
        
        if ($stmtSelect) {
            $stmtSelect->bind_param("i", $p_id);
            $stmtSelect->execute();
            $stmtSelect->bind_result($p_pictures, $p_name);
            $stmtSelect->fetch();
            $stmtSelect->close();
            
            if (!empty($p_pictures)) {
                // แยกชื่อไฟล์จากข้อมูล p_pictures ที่ถูกเก็บในฐานข้อมูล
                $picturesArray = explode(";", $p_pictures);
                
                // ลบไฟล์รูปภาพที่เก็บไว้ในโฟลเดอร์
                foreach ($picturesArray as $picture) {
                    $filePath = "../images/products/" . $picture;
                    if (file_exists($filePath)) {
                        unlink($filePath); // ลบไฟล์
                    }
                }
            }
        }

        // ลบข้อมูลในตาราง
        $sqlDelete = "DELETE FROM products WHERE p_id = ?";
        $stmtDelete = $conn->prepare($sqlDelete);

        if ($stmtDelete) {
            $stmtDelete->bind_param("i", $p_id);
            if ($stmtDelete->execute()) {
                // บันทึก Log การลบ
                addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "ลบสินค้า", "ลบสินค้า id: {$p_id} {$p_name}");
                
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