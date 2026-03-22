<?php
require_once "../../../backend/db.php";

// COUNT BY TYPE NAME
$attractions = $conn->query("
    SELECT COUNT(*) as total
    FROM assets a
    JOIN asset_types t ON a.type_id = t.type_id
    WHERE t.type_name = 'attraction'
")->fetch_assoc()['total'];

$resorts = $conn->query("
    SELECT COUNT(*) as total
    FROM assets a
    JOIN asset_types t ON a.type_id = t.type_id
    WHERE t.type_name = 'resort'
")->fetch_assoc()['total'];

$products = $conn->query("
    SELECT COUNT(*) as total
    FROM assets a
    JOIN asset_types t ON a.type_id = t.type_id
    WHERE t.type_name = 'local_product'
")->fetch_assoc()['total'];

$markets = $conn->query("
    SELECT COUNT(*) as total
    FROM assets a
    JOIN asset_types t ON a.type_id = t.type_id
    WHERE t.type_name = 'market'
")->fetch_assoc()['total'];

$feedbacks = $conn->query("
    SELECT 
        f.feedback_id,
        f.comment,
        f.rating,
        f.created_at,
        u.username,
        u.user_id,
        a.location AS asset_name
    FROM feedbacks f
    JOIN users u ON f.user_id = u.user_id
    JOIN assets a ON f.asset_id = a.asset_id
    ORDER BY f.feedback_id DESC
");
?>

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

        <!-- RIGHT PANEL -->
        <div class="admin-content">

            <!-- STATS -->
            <div class="stats-grid">
                <div class="stat-card green">
                    <h4>Attractions</h4>

                    <div class="stat-content">
                        <p class="stat-number" style="font-size: 34px; color: #000;"><?= $attractions ?></p>
                        <div class="stat-icon-box">
                            <i class="fas fa-camera"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card blue">
                    <h4>Resorts</h4>

                    <div class="stat-content">
                        <p class="stat-number" style="font-size: 34px; color: #000;"><?= $resorts ?></p>
                        <div class="stat-icon-box">
                            <i class="fas fa-umbrella-beach"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card yellow">
                    <h4>Local Products</h4>

                    <div class="stat-content">
                        <p class="stat-number"  style="font-size: 34px; color: #000;"><?= $products ?></p>
                        <div class="stat-icon-box">
                            <i class="fas fa-box-open"></i>
                        </div>
                    </div>
                </div>

                <div class="stat-card red">
                    <h4>Markets</h4>

                    <div class="stat-content">
                        <p class="stat-number" style="font-size: 34px; color: #000;"><?= $markets ?></p>
                        <div class="stat-icon-box">
                            <i class="fas fa-store"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FEEDBACK TABLE -->
            <div class="feedback-box">
                <h3><i class="fa-solid fa-bullhorn"></i> Manage Feedback</h3>

                <table>
                    <thead>
                        <tr>
                            <th>Users</th>
                            <th>Feedback</th>
                            <th>Assets</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($row = $feedbacks->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <div class="user-profile">
                                    <img src="https://i.pravatar.cc/40?u=<?= $row['user_id'] ?>">
                                    <div class="user-info">
                                        <span class="user-name"><?= htmlspecialchars($row['username']) ?></span>
                                        <small class="user-id">ID: #<?= $row['user_id'] ?></small>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <?= htmlspecialchars($row['comment']) ?><br>

                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <?= $i <= $row['rating'] ? '⭐' : '☆' ?>
                                <?php endfor; ?>
                            </td>

                            <td>
                                <span class="tag"><?= htmlspecialchars($row['asset_name']) ?></span>
                            </td>

                            <td>
                                <i class="fa-solid fa-trash delete"
                                onclick="deleteFeedback(<?= $row['feedback_id'] ?>)"></i>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </div>