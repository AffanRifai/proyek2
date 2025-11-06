<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mobil - Rental Mobil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        :root {
            --primary-color: #007bff;
            --dark-color: #333;
            --light-gray: #f4f4f4;
            --border-color: #ddd;
            --box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            --header-bg: #212529;
            --header-color: #fff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            background-color: var(--light-gray);
        }

        .sidebar {
            width: 250px;
            background-color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            height: 100vh;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .logo img {
            width: 40px;
            height: 40px;
        }

        .logo h3 {
            color: var(--primary-color);
            font-weight: 600;
        }

        .menu {
            list-style: none;
        }

        .menu li {
            margin-bottom: 10px;
        }

        .menu li a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            text-decoration: none;
            color: var(--dark-color);
            border-radius: 8px;
            transition: background-color 0.3s, color 0.3s;
        }

        .menu li.active a, .menu li a:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .menu li.active a i, .menu li a:hover i {
            color: white;
        }

        .menu li a i {
            width: 20px;
            text-align: center;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: var(--box-shadow);
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
            color: var(--dark-color);
        }

        .admin-profile i {
            font-size: 24px;
            color: var(--primary-color);
        }

        .search-bar {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-bar input {
            padding: 10px 40px 10px 15px;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            outline: none;
            width: 300px;
            font-size: 14px;
        }

        .search-bar i {
            position: absolute;
            right: 15px;
            color: #aaa;
        }

        .page-header {
            background-color: var(--primary-color);
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: var(--box-shadow);
            margin: 20px 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .page-header i {
            font-size: 24px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .map-container {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--box-shadow);
            height: 500px;
        }

        #map {
            width: 100%;
            height: 100%;
        }

        .right-panel {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .live-camera-box {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--box-shadow);
        }

        .live-camera-box h4 {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--dark-color);
        }

        .video-placeholder {
            width: 100%;
            background-color: #000;
            aspect-ratio: 16 / 9;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            position: relative;
        }

        .video-placeholder img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .data-info-box {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--box-shadow);
        }

        .data-info-box h4 {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--dark-color);
        }

        .data-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .data-item .label {
            font-weight: 500;
            color: #555;
            width: 100px;
        }

        .data-item .value {
            font-weight: 600;
            color: var(--dark-color);
        }

        .data-item.speed .value {
            font-size: 24px;
            color: #4CAF50;
            display: flex;
            align-items: center;
            gap: 5px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="https://via.placeholder.com/40" alt="Rental Mobil Logo">
            <h3>RENTAL MOBIL</h3>
        </div>
        <ul class="menu">
            <li><a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-car"></i> Manajemen Mobil</a></li>
            <li><a href="#"><i class="fas fa-book"></i> Manajemen Booking</a></li>
            <li class="active"><a href="#"><i class="fas fa-map-marker-alt"></i> Track Location</a></li>
            <li><a href="#"><i class="fas fa-chart-line"></i> Laporan & Statistik</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="navbar">
            <div class="admin-profile">
                <i class="fas fa-user-circle"></i> ADMIN
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Search...">
                <i class="fas fa-search"></i>
            </div>
        </div>
        
        <?php
            // Data statis untuk contoh. Dalam implementasi nyata, ini diambil dari database.
            $car = [
                'plat' => 'B 1234 ABC',
                'merk' => 'Toyota',
                'penyewa' => 'Roni Santoso',
                'speed' => '60 km/h',
                'status' => 'Dibooking',
                'rental_days' => '3 Hari',
                'latitude' => -6.175110,
                'longitude' => 106.865036
            ];
        ?>

        <div class="page-header">
            <i class="fas fa-car"></i>
            <h2>Detail Mobil <?php echo "{$car['plat']} - {$car['merk']}"; ?></h2>
        </div>

        <div class="content-grid">
            <div class="map-container">
                <div id="map"></div>
            </div>
            <div class="right-panel">
                <div class="live-camera-box">
                    <h4>LIVE CAMERA</h4>
                    <div class="video-placeholder">
                        <img src="https://via.placeholder.com/400x225?text=Live+Camera+Feed" alt="Live Camera">
                    </div>
                </div>
                <div class="data-info-box">
                    <h4>Data</h4>
                    <div class="data-item speed">
                        <span class="label">SPEED:</span>
                        <span class="value"><?php echo $car['speed']; ?></span>
                    </div>
                    <div class="data-item">
                        <span class="label">Penyewa:</span>
                        <span class="value"><?php echo $car['penyewa']; ?></span>
                    </div>
                    <div class="data-item">
                        <span class="label">Status:</span>
                        <span class="value"><?php echo $car['status']; ?></span>
                    </div>
                    <div class="data-item">
                        <span class="label">Rental:</span>
                        <span class="value"><?php echo $car['rental_days']; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Ganti 'YOUR_API_KEY' dengan Google Maps API Key Anda yang valid
        const API_KEY = 'YOUR_API_KEY';

        function initMap() {
            const carLocation = { lat: <?php echo $car['latitude']; ?>, lng: <?php echo $car['longitude']; ?> };

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: carLocation,
                mapId: "DEMO_MAP_ID", // Ganti dengan Map ID dari Google Cloud Console
            });

            const marker = new google.maps.Marker({
                position: carLocation,
                map: map,
                title: '<?php echo $car['plat'] . " - " . $car['merk']; ?>',
                icon: {
                    url: 'https://maps.google.com/mapfiles/kml/shapes/cabs.png',
                    scaledSize: new google.maps.Size(40, 40)
                }
            });

            const infoWindow = new google.maps.InfoWindow({
                content: `
                    <div style="font-family: Arial; font-size: 14px;">
                        <strong><?php echo "{$car['plat']} - {$car['merk']}"; ?></strong><br>
                        - <?php echo $car['penyewa']; ?><br>
                        <span style="display: flex; align-items: center; gap: 5px;">
                            <i class="fas fa-tachometer-alt" style="color: #007bff;"></i> <?php echo $car['speed']; ?>
                        </span>
                    </div>
                `,
            });

            marker.addListener("click", () => {
                infoWindow.open(map, marker);
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=${API_KEY}&callback=initMap"></script>
</body>
</html>