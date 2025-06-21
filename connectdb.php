<?php
$servername = "localhost";
$username = "root";
//$password = "";
$password = "7ci838a!nK";
$dbname = "localbuengkan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
$conn->set_charset("utf8");
//$conn->close();
?>
