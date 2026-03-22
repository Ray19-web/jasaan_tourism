<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "jasaan_tourism";

// CREATE CONNECTION
$conn = new mysqli($host, $user, $pass, $db);

// CHECK CONNECTION
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SET CHARSET
$conn->set_charset("utf8mb4");
?>