<?php
    session_start();

    if (isset($_SESSION['user_id'])) {

        if (strtolower($_SESSION['role']) === 'admin') {
            header("Location: /jasaan-tourism/frontend/pages/admin/admin_dashboard.php");
        } else {
            header("Location: /jasaan-tourism/frontend/pages/user/user_explore.php");
        }
        
        exit;
    }
?>