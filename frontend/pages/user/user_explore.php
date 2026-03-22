<?php
require_once "../../../backend/optional_session.php";

if (isset($_SESSION['role']) && strtolower($_SESSION['role']) === 'admin') {
    header("Location: /jasaan-tourism/frontend/pages/admin/admin_dashboard.php");
    exit;
}

$pageTitle = "Explore - Tourism_Jasaan";
?>

<!DOCTYPE html>
    <html lang="en">

        <?php include '../../includes/user_head.php'; ?>
        <script src="../../assets/js/splash.js"></script>

    <body>

        <div id="authMessage" class="auth-message"></div>

        <?php include '../../includes/splash.php'; ?>

        <div id="toast" class="toast"></div>

        <div id="mainContent" class="main-content" style="display:none;">
            
            <?php include '../../includes/user_navbar.php'; ?>

            <main>
                <h1>Explores Page</h1>
            </main>

        </div>

        <?php include '../../includes/auth-modals.php'; ?>

        <script src="../../assets/js/auth-modal.js"></script>
        <script src="../../assets/js/signup.js"></script>
        <script src="../../assets/js/login.js"></script>

    </body>
</html>