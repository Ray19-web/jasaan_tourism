<?php
require_once "db.php";

header("Content-Type: application/json");

// GET DATA
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

// CHECK EXISTING USER
$stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ? OR username = ?");
$stmt->bind_param("ss", $email, $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "User already exists"]);
    exit;
}

// HASH PASSWORD
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// INSERT USER
$stmt = $conn->prepare("INSERT INTO users (username, full_name, email, password, role) VALUES (?, ?, ?, ?, 'user')");
$stmt->bind_param("ssss", $username, $full_name, $email, $hashedPassword);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Account created successfully"]);
} else {
    echo json_encode(["success" => false, "message" => "Signup failed"]);
}

$stmt->close();
$conn->close();
?>