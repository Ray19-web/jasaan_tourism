<?php
    session_start();
    require_once "db.php";

    header("Content-Type: application/json");

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // CHECK IF EMPTY
    if (empty($username) || empty($password)) {
        echo json_encode([
            "success" => false,
            "message" => "Please fill in all fields"
        ]);
        exit;
    }

    // FIND USER
    $stmt = $conn->prepare("SELECT user_id, username, email, password, role FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode([
            "success" => false,
            "message" => "User not found"
        ]);
        exit;
    }

    $user = $result->fetch_assoc();

    // VERIFY PASSWORD
    if (password_verify($password, $user['password'])) {

        // STORE SESSION
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        echo json_encode([
            "success" => true,
            "message" => "Login successful",
            "role" => $user['role'] // ✅ IMPORTANT FIX
        ]);

    } else {
        echo json_encode([
            "success" => false,
            "message" => "Incorrect password"
        ]);
    }

    $stmt->close();
    $conn->close();
?>