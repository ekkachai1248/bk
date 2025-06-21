<?php
session_start();

unset($_SESSION['buser_id']);
unset($_SESSION['bfullname']);
unset($_SESSION['brole']);
unset($_SESSION['bpicture']);

header("Location: index.php");
?>