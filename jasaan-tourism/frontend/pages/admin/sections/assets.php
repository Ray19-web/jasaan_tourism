<?php
require_once "../../../backend/db.php";

$assets = $conn->query("
    SELECT 
        a.asset_id,
        a.location AS name,
        a.location,
        a.thumbnail,
        t.type_name
    FROM assets a
    LEFT JOIN asset_types t ON a.type_id = t.type_id
    ORDER BY a.asset_id DESC
");
?>

<!-- ✅ Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<!-- ✅ Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="../../assets/js/map.js"></script>

<div class="admin-content">

    <div class="assets-box">

        <!-- HEADER -->
        <div class="assets-header">
            <h3><i class="fa-solid fa-layer-group"></i> Manage Assets</h3>

            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                <input type="text" id="searchInput" placeholder="Search item here..." />
            </div>
            <button onclick="openModal()" class="add-btn">
                <i class="fa-solid fa-plus"></i> Add Assets
            </button>
        </div>

        <!-- TABLE -->
        <table class="assets-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Classification</th>
                    <th>Location</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody id="assetsTable">
                <?php while ($row = $assets->fetch_assoc()): ?>
                <tr>

                    <!-- NAME -->
                    <td>
                        <div class="asset-info">
                            <img src="<?= !empty($row['thumbnail']) 
                                ? '../../../uploads/' . $row['thumbnail'] 
                                : '../../assets/images/default.png' ?>" 
                            class="asset-img">

                            <div>
                                <strong><?= htmlspecialchars($row['name']) ?></strong><br>
                                <small>ID: <?= $row['asset_id'] ?></small>
                            </div>
                        </div>
                    </td>

                    <!-- TYPE -->
                    <td>
                        <span class="badge <?= $row['type_name'] ?>">
                            <?= ucfirst($row['type_name']) ?>
                        </span>
                    </td>

                    <!-- LOCATION -->
                    <td><?= htmlspecialchars($row['location']) ?></td>

                    <!-- ACTION -->
                    <td>
                        <i class="fa-solid fa-pen edit"
                           onclick="editAsset(<?= $row['asset_id'] ?>)"></i>

                        <i class="fa-solid fa-trash delete"
                           onclick="deleteAsset(<?= $row['asset_id'] ?>)"></i>
                    </td>

                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</div>

<div class="assets-modal" id="addAssetModal">
            <div class="assets-modal-content">
                <div class="modal-header">
                    <h2><i class="fa-solid fa-file-circle-plus"></i> ADD ASSETS</h2>

                    <span class="assets-close-btn" onclick="closeModal()">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                </div>

                <form class="assets-form" action="../../../../backend/save_asset.php" method="POST" enctype="multipart/form-data">

                    <div class="assets-form-row">

                        <!-- NAME -->
                        <div class="assets-form-group">
                            <label>Asset Name</label>
                            <input type="text" name="name" required placeholder="e.g Sagpulong Falls">
                        </div>

                        <!-- TYPE -->
                        <div class="assets-form-group">
                            <label>Classification</label>
                            <select name="type_id" required>
                                <option value="">Select Type</option>
                                <?php
                                $types = $conn->query("SELECT * FROM asset_types");
                                while($t = $types->fetch_assoc()):
                                ?>
                                <option value="<?= $t['type_id'] ?>">
                                    <?= $t['type_name'] ?>
                                </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <!-- LOCATION SEARCH -->
                        <div class="assets-form-group">
                            <label>Asset Location</label>
                            <input type="text" id="locationInput" name="location" 
                                placeholder="Search location..." required>
                        </div>

                    </div>

                    <!-- MAP -->
                    <div id="map"></div>

                    <!-- HIDDEN LAT LNG -->
                    <input type="hidden" name="latitude" id="lat">
                    <input type="hidden" name="longitude" id="lng">

                    <!-- DETAILS -->
                    <div class="assets-form-group">
                        <label>Asset Details</label>
                        <textarea name="description" placeholder="Enter details here..."></textarea>
                    </div>

                    <!-- CONTACT -->
                    <div class="assets-form-row">
                        <input type="text" name="phone" placeholder="Phone Number">
                        <input type="email" name="email" placeholder="Email Address">
                    </div>

                    <!-- IMAGE -->
                    <div class="assets-form-row">
                        <input type="file" name="thumbnail">
                        <input type="file" name="images[]" multiple>
                    </div>

                    <button type="submit" class="btn-primary">ADD ITEM</button>
                </form>

            </div>
        </div>

<script src="../../assets/js/add_modal.js"></script>