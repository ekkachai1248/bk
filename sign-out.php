<?php
session_start();
//session_destroy();

unset($_SESSION['user_id']);
unset($_SESSION['fullname']);
unset($_SESSION['phone']);
unset($_SESSION['address']);
unset($_SESSION['role']);
unset($_SESSION['email']);

header("Location: sign-in.php");
?>