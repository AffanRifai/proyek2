<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kawa Rental Mobil - GPS</title>

    <!-- Leaflet CSS -->
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    />

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- MQTT over WebSocket -->
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #map {
            width: 100%;
            height: 500px;
            margin-top: 10px;
        }
        #status {
            padding: 8px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>🚗 Tracking Mobil Rental (Realtime)</h2>

<div id="status">⏳ Menghubungkan ke MQTT...</div>
<div id="map"></div>

<script>
    let map = null;
    let marker = null;

    // ================== INIT MAP ==================
    function initMap(lat, lon) {
        map = L.map('map').setView([lat, lon], 16);

        // OpenStreetMap Tile (GRATIS)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        marker = L.marker([lat, lon]).addTo(map);
    }

    // ================== MQTT CONNECT ==================
    const client = mqtt.connect('wss://broker.hivemq.com:8884/mqtt', {
        clientId: 'web_laravel_' + Math.random().toString(16).substr(2, 8)
    });

    client.on('connect', function () {
        document.getElementById("status").innerHTML = "✅ Terhubung ke MQTT";
        client.subscribe('kawa/gps');   // 🔴 pastikan topic SAMA dengan ESP
    });

    client.on('message', function (topic, message) {
        const data = JSON.parse(message.toString());

        if (!map) {
            initMap(data.lat, data.lon);
        } else {
            marker.setLatLng([data.lat, data.lon]);
            map.setView([data.lat, data.lon]);
        }
    });

    client.on('error', function () {
        document.getElementById("status").innerHTML = "❌ MQTT Error";
    });
</script>

</body>
</html>
