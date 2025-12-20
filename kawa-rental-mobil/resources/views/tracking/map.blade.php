<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Live Map</title>

    <link rel="stylesheet"
          href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>

    <style>
        html, body, #map {
            margin: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>

<div id="map"></div>

<script>
let map;
let marker;

function initMap(lat, lon) {
    map = L.map('map').setView([lat, lon], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
    }).addTo(map);

    marker = L.marker([lat, lon]).addTo(map);
}

const client = mqtt.connect('wss://broker.hivemq.com:8884/mqtt', {
    clientId: 'iframe_map_' + Math.random().toString(16).substr(2,8)
});

client.on('connect', () => {
    client.subscribe('kawa/gps');
});

client.on('message', (topic, message) => {
    const data = JSON.parse(message.toString());

    if (!map) {
        initMap(data.lat, data.lon);
    } else {
        marker.setLatLng([data.lat, data.lon]);
        map.panTo([data.lat, data.lon]);
    }
});
</script>

</body>
</html>
