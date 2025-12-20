<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kawa Rental Mobil - GPS</title>

    <!-- Leaflet CSS -->
    <link rel="stylesheet"
          href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- MQTT -->
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>

    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f3f4f6;
        }

        header {
            background: #111827;
            color: white;
            padding: 14px 20px;
            font-size: 18px;
            font-weight: 600;
        }

        #status {
            padding: 10px 20px;
            background: #e5e7eb;
            font-size: 14px;
        }

        #map {
            width: 100%;
            height: calc(100vh - 96px);
        }

        /* ===== INFO PANEL ===== */
        .info-panel {
            position: absolute;
            top: 120px;
            right: 20px;
            width: 260px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            padding: 16px;
            z-index: 1000;
        }

        .info-panel h4 {
            margin: 0 0 10px 0;
            font-size: 15px;
            color: #111827;
        }

        .info-item {
            font-size: 13px;
            margin-bottom: 8px;
            color: #374151;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 8px;
            font-size: 12px;
            background: #dcfce7;
            color: #166534;
            font-weight: 600;
        }
    </style>
</head>
<body>

<header>🚗 Kawa Rental Mobil — Live Tracking</header>
<div id="status">⏳ Menghubungkan ke MQTT...</div>

<div id="map"></div>

<!-- ===== INFO PANEL ===== -->
<div class="info-panel">
    <h4>📍 Informasi Lokasi</h4>
    <div class="info-item">Status: <span class="badge" id="conn">OFFLINE</span></div>
    <div class="info-item">Latitude: <b id="lat">-</b></div>
    <div class="info-item">Longitude: <b id="lon">-</b></div>
    <div class="info-item">Update: <b id="time">-</b></div>
</div>

<script>
    let map = null;
    let marker = null;

    function initMap(lat, lon) {
        map = L.map('map').setView([lat, lon], 16);

        // MAP TETAP (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        marker = L.marker([lat, lon]).addTo(map);
    }

    // ===== MQTT CONNECT =====
    const client = mqtt.connect('wss://broker.hivemq.com:8884/mqtt', {
        clientId: 'web_laravel_' + Math.random().toString(16).substr(2, 8)
    });

    client.on('connect', function () {
        document.getElementById("status").innerHTML = "✅ Terhubung ke MQTT";
        document.getElementById("conn").innerText = "ONLINE";
        client.subscribe('kawa/gps');
    });

    client.on('message', function (topic, message) {
        const data = JSON.parse(message.toString());
        const now = new Date().toLocaleTimeString();

        if (!map) {
            initMap(data.lat, data.lon);
        } else {
            marker.setLatLng([data.lat, data.lon]);
            map.setView([data.lat, data.lon]);
        }

        // UPDATE INFO PANEL
        document.getElementById("lat").innerText = data.lat.toFixed(6);
        document.getElementById("lon").innerText = data.lon.toFixed(6);
        document.getElementById("time").innerText = now;
    });

    client.on('error', function () {
        document.getElementById("status").innerHTML = "❌ MQTT Error";
        document.getElementById("conn").innerText = "ERROR";
    });
</script>

</body>
</html>
