function deleteAsset(id) {
    if (!confirm("Delete this asset?")) return;

    fetch("delete_asset.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "id=" + id
    })
    .then(res => res.text())
    .then(() => location.reload());
}