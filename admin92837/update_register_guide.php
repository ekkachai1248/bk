<?php
include_once("checklogin.php");
include_once("../connectdb.php");
include_once("functions.php");

$tour_id = (int)$_GET['tour_id'];
$user_id = $_SESSION['buser_id'];
$action = $_GET['action'];

$sql = "UPDATE tours SET guide_list = 
        CASE 
            WHEN ? = 'add' THEN CONCAT(guide_list, ';', ?)
            WHEN ? = 'remove' THEN REPLACE(guide_list, CONCAT(';', ?), '')
        END 
        WHERE tour_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $action, $user_id, $action, $user_id, $tour_id);
$stmt->execute();

addLog($conn, $_SESSION['buser_id'], $_SESSION['bfullname'], $_SESSION['brole'], "สมัครหรือยกเลิกการเป็นไกด์", "{$action} tour_id:  {$tour_id} user_id: {$user_id} ");

$referer = $_SERVER['HTTP_REFERER'];
if (strpos($referer, 'success=true') === false) {
    $referer .= (parse_url($referer, PHP_URL_QUERY) ? '&' : '?') . 'success=true';
}
header("Location: $referer");
exit;
?>
