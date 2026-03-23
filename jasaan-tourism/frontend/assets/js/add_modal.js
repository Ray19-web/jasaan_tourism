function openModal() {
    document.getElementById("addAssetModal").style.display = "flex";
}

function closeModal() {
    document.getElementById("addAssetModal").style.display = "none";
}

window.onclick = function(event) {
    const modal = document.getElementById("addAssetModal");

    if (event.target === modal) {
        modal.style.display = "none";
    }
};