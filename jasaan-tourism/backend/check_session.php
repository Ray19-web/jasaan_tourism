<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Don't force redirect to protected pages
    header("Location: /jasaan-tourism/frontend/pages/user/user_explore.php");
    exit;
}