let map, marker;
let markers = [];

// 🌍 INIT MAP
function initMap() {
    map = L.map('map', { zoomAnimation: true })
        .setView([8.4542, 124.6319], 10); // Bukidnon

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    // 📍 CLICK EVENT
    map.on('click', function (e) {
        placeMarker(e.latlng.lat, e.latlng.lng, "Selected Location");
    });

    // 🔎 AUTOCOMPLETE FIX (Photon API)
    setupAutocomplete();

    // 📌 LOAD SAVED DATA
    loadSavedAssets();
}

// 📍 PLACE MARKER
function placeMarker(lat, lng, name = "Location") {

    if (marker) map.removeLayer(marker);

    marker = L.marker([lat, lng], {
        riseOnHover: true
    }).addTo(map);

    map.flyTo([lat, lng], 15, { duration: 1.2 });

    document.getElementById("lat").value = lat;
    document.getElementById("lng").value = lng;

    marker.bindPopup(`
        <b>${name}</b><br>
        ${lat.toFixed(6)}, ${lng.toFixed(6)}<br>
        <button onclick="copyCoords('${lat},${lng}')">Copy</button>
    `).openPopup();
}

// 📋 COPY
function copyCoords(text) {
    navigator.clipboard.writeText(text);
    alert("Copied: " + text);
}

// 🔎 AUTOCOMPLETE (FIXED SEARCH ISSUE)
function setupAutocomplete() {
    const input = document.getElementById("locationInput");

    let dropdown = document.createElement("div");
    dropdown.style.position = "absolute";
    dropdown.style.background = "#fff";
    dropdown.style.width = input.offsetWidth + "px";
    dropdown.style.zIndex = 1000;
    dropdown.style.border = "1px solid #ccc";

    input.parentNode.appendChild(dropdown);

    input.addEventListener("input", async function () {
        const query = input.value;
        if (query.length < 3) {
            dropdown.innerHTML = "";
            return;
        }

        const res = await fetch(`https://photon.komoot.io/api/?q=${query}&limit=5`);
        const data = await res.json();

        dropdown.innerHTML = "";

        data.features.forEach(place => {
            const [lng, lat] = place.geometry.coordinates;
            const name = place.properties.name || place.properties.city || "Unknown";

            const item = document.createElement("div");
            item.style.padding = "6px";
            item.style.cursor = "pointer";
            item.innerHTML = `${name}`;

            item.onclick = () => {
                input.value = name;
                dropdown.innerHTML = "";

                placeMarker(lat, lng, name);
            };

            dropdown.appendChild(item);
        });
    });
}

// 📌 LOAD SAVED MARKERS FROM DB
function loadSavedAssets() {
    fetch("../../../backend/get_assets_map.php")
        .then(res => res.json())
        .then(data => {

            data.forEach(asset => {
                if (!asset.latitude || !asset.longitude) return;

                const marker = L.marker([
                    parseFloat(asset.latitude),
                    parseFloat(asset.longitude)
                ], {
                    riseOnHover: true
                }).addTo(map);

                marker.bindPopup(`
                    <b>${asset.name}</b><br>
                    ${asset.location}<br>
                    ${asset.latitude}, ${asset.longitude}
                `);

                markers.push(marker);
            });

        });
}

// INIT
document.addEventListener("DOMContentLoaded", initMap);