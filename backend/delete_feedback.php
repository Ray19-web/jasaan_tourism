<?php
require_once "check_admin.php";
require_once "db.php";

$id = $_POST['id'];

$stmt = $conn->prepare("DELETE FROM feedbacks WHERE feedback_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

echo json_encode(["success" => true]);