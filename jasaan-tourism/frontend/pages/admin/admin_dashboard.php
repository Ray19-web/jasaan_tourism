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
        <!-- LEFT PANEL -->
            <div class="admin-sidebar">
                <div class="admin-card">
                    <div class="admin-icon">
                        <i class="fa-solid fa-gear"></i>
                    </div>

                    <h3>Admin Panel</h3>

                    <!-- <button class="active-btn">
                        <i class="fa-solid fa-eye"></i> Overview
                    </button>

                    <button>
                        <i class="fa-solid fa-chart-bar"></i> Manage Assets
                    </button>

                    <button>
                        <i class="fa-solid fa-user"></i> Accounts
                    </button> -->

                    <a href="?page=overview" class="<?= ($_GET['page'] ?? 'overview') == 'overview' ? 'active-btn button' : '' ?>">
                        <i class="fa-solid fa-eye"></i> Overview
                    </a>

                    <a href="?page=assets" class="<?= ($_GET['page'] ?? '') == 'assets' ? 'active-btn button' : '' ?>">
                        <i class="fa-solid fa-chart-bar"></i> Manage Assets
                    </a>

                    <a href="?page=accounts" class="<?= ($_GET['page'] ?? '') == 'accounts' ? 'active-btn button' : '' ?>">
                        <i class="fa-solid fa-user"></i> Accounts
                    </a>
                </div>
            </div>

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
<script src="../../assets/js/assets_search.js"></script>
<script src="../../assets/js/edit_assets.js"></script>
<script src="../../assets/js/delete_assets.js"></script>
</body>
</html>