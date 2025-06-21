<?php
header('Content-Type: application/json');
$response = ['success' => false, 'message' => 'เกิดข้อผิดพลาด'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tour_id'])) {
    include_once("../connectdb.php");
    $t_id = intval($_POST['tour_id']);
    
    if ($t_id > 0) {
        $sqlSelect = "SELECT t_pictures FROM tours WHERE tour_id = ?";
        $stmtSelect = $conn->prepare($sqlSelect);
        $stmtSelect->bind_param("i", $t_id);
        $stmtSelect->execute();
        $stmtSelect->bind_result($t_pictures);
        $stmtSelect->fetch();
        $stmtSelect->close();

        // ลบไฟล์รูปภาพ
        if (!empty($t_pictures)) {
            foreach (explode(";", $t_pictures) as $picture) {
                $filePath = "../images/tours/" . $picture;
                if (file_exists($filePath)) unlink($filePath);
            }
        }

        // ลบข้อมูลในฐานข้อมูล
        $sqlDelete = "DELETE FROM tours WHERE tour_id = ?";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bind_param("i", $t_id);
        $response['success'] = $stmtDelete->execute();
        $response['message'] = $response['success'] ? 'ลบข้อมูลสำเร็จ!' : 'ไม่สามารถลบข้อมูลได้';
        $stmtDelete->close();
    } else {
        $response['message'] = 'ID ของข้อมูลไม่ถูกต้อง';
    }
} else {
    $response['message'] = 'คำขอไม่ถูกต้อง';
}

ob_clean(); // ล้างบัฟเฟอร์
echo json_encode($response);
exit;
?>
