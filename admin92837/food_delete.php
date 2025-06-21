<?php
session_start();
header('Content-Type: application/json'); // ระบุให้ส่งข้อมูล JSON

$response = ['success' => false, 'message' => 'เกิดข้อผิดพลาด'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['food_id'])) {
    include_once("../connectdb.php");
    include_once("functions.php");
    $f_id = intval($_POST['food_id']);

    if ($f_id > 0) {
        // ดึงข้อมูลชื่อไฟล์รูปภาพจากฟิลด์ f_pictures และชื่ออาหาร
        $sqlSelect = "SELECT f_pictures, f_name FROM foods WHERE f_id = ?";
        $stmtSelect = $conn->prepare($sqlSelect);

        if ($stmtSelect) {
            $stmtSelect->bind_param("i", $f_id);
            $stmtSelect->execute();
            $stmtSelect->bind_result($f_pictures, $f_name);
            $stmtSelect->fetch();
            $stmtSelect->close();

            if (!empty($f_pictures)) {
                // แยกชื่อไฟล์จากข้อมูล f_pictures ที่ถูกเก็บในฐานข้อมูล
                $picturesArray = explode(";", $f_pictures);

                // ลบไฟล์รูปภาพที่เก็บไว้ในโฟลเดอร์
                foreach ($picturesArray as $picture) {
                    $filePath = "../images/foods/" . $picture;
                    if (file_exists($filePath)) {
                        unlink($filePath); // ลบไฟล์
                    }
                }
            }
        }

        // ลบข้อมูลในตาราง foods
        $sqlDelete = "DELETE FROM foods WHERE f_id = ?";
        $stmtDelete = $conn->prepare($sqlDelete);

        if ($stmtDelete) {
            $stmtDelete->bind_param("i", $f_id);
            if ($stmtDelete->execute()) {
                // บันทึก Log การลบ
                addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "ลบอาหาร", "ลบอาหาร f_id: {$f_id} ชื่อ: {$f_name}");
                
                $response = ['success' => true, 'message' => 'ลบอาหารสำเร็จ!'];
            } else {
                $response['message'] = 'ไม่สามารถลบอาหารได้';
            }
            $stmtDelete->close();
        } else {
            $response['message'] = 'เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL';
        }
    } else {
        $response['message'] = 'ID ของอาหารไม่ถูกต้อง';
    }
} else {
    $response['message'] = 'คำขอไม่ถูกต้อง';
}

// ตรวจสอบไม่มีข้อความอื่น ๆ
if (ob_get_length()) {
    ob_end_clean();
}

echo json_encode($response);
exit;
?>
