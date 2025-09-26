<?php
$servername = getenv("MYSQLHOST") ?: "localhost";
$username   = getenv("MYSQLUSER") ?: "root";
$password   = getenv("MYSQLPASSWORD") ?: "";
$dbname     = getenv("MYSQLDATABASE") ?: "turfapp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
