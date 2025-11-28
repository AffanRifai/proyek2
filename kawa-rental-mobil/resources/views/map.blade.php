<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPS Tracking</title>

    <!-- Ganti dengan API key kamu -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQbGk2zjEda0slkNFyztNOESoH7-t47hA"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f8fa;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        #map {
            width: 90%;
            height: 500px;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

    <h2>📍 Lokasi GPS Terbaru</h2>

    @if ($latestLocation)
        <p>Latitude: {{ $latestLocation->latitude }} | Longitude: {{ $latestLocation->longitude }}</p>
        <div id="map"></div>
        <script>
            function initMap() {
                const loc = { lat: {{ $latestLocation->latitude }}, lng: {{ $latestLocation->longitude }} };
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 15,
                    center: loc
                });
                const marker = new google.maps.Marker({
                    position: loc,
                    map: map,
                    title: "Lokasi Terbaru"
                });
            }
            window.onload = initMap;
        </script>
    @else
        <p style="color:red;">Belum ada data lokasi tersimpan.</p>
    @endif

</body>
</html>
