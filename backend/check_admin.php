<?php
require_once "check_session.php";

if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
    header("Location: /jasaan-tourism/frontend/pages/user/user_explore.php");
    exit;
}