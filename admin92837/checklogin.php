<?php
session_start();
if (empty($_SESSION['buser_id'])) {
    header("Location: index.php");
    exit();
}
?>