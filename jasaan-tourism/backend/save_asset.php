<?php
require_once "../../../backend/db.php";

$type_id = $_POST['type_id'];
$name = $_POST['name'];
$location = $_POST['location'];
$description = $_POST['description'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$lat = $_POST['latitude'];
$lng = $_POST['longitude'];

/* THUMBNAIL */
$thumbnail = '';
if (!empty($_FILES['thumbnail']['name'])) {
    $thumbnail = time() . '_' . $_FILES['thumbnail']['name'];
    move_uploaded_file($_FILES['thumbnail']['tmp_name'], "../../../uploads/$thumbnail");
}

/* INSERT */
$conn->query("
INSERT INTO assets (type_id, location, description, thumbnail, phone_number, email, latitude, longitude)
VALUES ('$type_id', '$location', '$description', '$thumbnail', '$phone', '$email', '$lat', '$lng')
");

$asset_id = $conn->insert_id;

/* MULTIPLE IMAGES */
foreach ($_FILES['images']['tmp_name'] as $key => $tmp) {
    if ($_FILES['images']['name'][$key]) {
        $imgName = time() . '_' . $_FILES['images']['name'][$key];
        move_uploaded_file($tmp, "../../../uploads/$imgName");

        $conn->query("
            INSERT INTO asset_images (asset_id, image_path)
            VALUES ('$asset_id', '$imgName')
        ");
    }
}

header("Location: assets.php");