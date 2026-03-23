<header class="navbar">
    <div class="logo">
        <a href="../../pages/user/user_explore.php" class="brand-link">
            <img src="../../assets/images/branding.png" alt="JASAYA Journey Center" class="brand-logo">
        </a>
    </div>

    <nav class="nav-menu" id="nav-menu">

        <a href="user_explore.php" class="<?= basename($_SERVER['PHP_SELF']) == 'user_explore.php' ? 'active' : '' ?>">
            <i class="fa-solid fa-house"></i> <span>Explore</span>
        </a>

        <a href="attractions.php" class="<?= basename($_SERVER['PHP_SELF']) == 'attractions.php' ? 'active' : '' ?>">
            <i class="fa-solid fa-camera"></i> <span>Attractions</span>
        </a>

        <a href="resorts.php" class="<?= basename($_SERVER['PHP_SELF']) == 'resorts.php' ? 'active' : '' ?>">
            <i class="fa-solid fa-water"></i> <span>Resorts</span>
        </a>

        <a href="localfoods.php" class="<?= basename($_SERVER['PHP_SELF']) == 'localfoods.php' ? 'active' : '' ?>">
            <i class="fa-solid fa-bowl-food"></i> <span>Local Products</span>
        </a>

        <a href="markets.php" class="<?= basename($_SERVER['PHP_SELF']) == 'markets.php' ? 'active' : '' ?>">
            <i class="fa-solid fa-bag-shopping"></i> <span>Markets</span>
        </a>

    </nav>

    <div class="nav-icons">
        <a href="profile.php" class="icon-btn">
            <i class="fa-regular fa-circle-user"></i>
        </a>

        <a href="#" class="icon-btn" id="logoutBtn">
            <i class="fa-solid fa-right-from-bracket"></i>
        </a>
    </div>
</header>