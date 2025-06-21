<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header("Location: sign-in.php");
    exit();
}
?>