<?php
require_once "../../../backend/check_admin.php";
$pageTitle = "Admin Dashboard - Tourism_Jasaan";
?>

<!DOCTYPE html>
<html lang="en">

<?php include '../../includes/user_head.php'; ?>

<body>

<div id="mainContent" class="main-content">
    <?php include '../../includes/admin_navbar.php'; ?>

    <div class="admin-container">
        <?php
            $page = $_GET['page'] ?? 'overview';

            if ($page == 'assets') {
                include 'sections/assets.php';
            } elseif ($page == 'accounts') {
                include 'sections/accounts.php';
            } else {
                include 'sections/overview.php';
            }
        ?>
    </div>
<?php include '../../includes/footer.php'; ?>
</div>


<?php include '../../includes/auth-modals.php'; ?>

<script src="../../assets/js/delete_button.js"></script>
</body>
</html>