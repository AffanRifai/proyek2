<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Location Admin - Rental Mobil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        :root {
            --primary-color: #007bff;
            --dark-color: #333;
            --light-gray: #f4f4f4;
            --border-color: #ddd;
            --box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            --info-box-bg: #f7f7f7;
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

        .map-container {
            margin: 20px 0;
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

        .car-list-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .car-list-header h3 {
            font-weight: 600;
        }

        .filter-status {
            position: relative;
            display: inline-block;
        }

        .filter-status select {
            padding: 8px 30px 8px 15px;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            background-color: white;
            appearance: none;
            cursor: pointer;
            font-size: 14px;
        }

        .filter-status i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #555;
            pointer-events: none;
        }

        .car-card-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .car-card {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: var(--box-shadow);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .car-info {
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
        }

        .car-icon {
            width: 40px;
            height: 40px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .details h4 {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
            color: var(--dark-color);
        }

        .details p {
            font-size: 14px;
            margin: 0;
            color: #777;
        }

        .status-info {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 14px;
            color: #555;
            white-space: nowrap;
        }

        .status-info i {
            color: var(--primary-color);
        }

        .status-info .speed, .status-info .status {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .status-info .status i {
            color: #4CAF50;
        }

        .action-link {
            text-decoration: none;
            color: var(--primary-color);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: color 0.3s;
        }

        .action-link:hover {
            color: #0056b3;
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
        <div class="map-container">
            <div id="map"></div>
        </div>
        <div class="car-list-header">
            <h3>Daftar Mobil yang Aktif:</h3>
            <div class="filter-status">
                <select>
                    <option>Filter Mobil berdasarkan Status</option>
                    <option>Dibooking</option>
                    <option>Tersedia</option>
                    <option>Sedang Diservis</option>
                </select>
                <i class="fas fa-caret-down"></i>
            </div>
        </div>
        <div class="car-card-list">
            <?php
                // Data statis untuk contoh. Dalam implementasi nyata, ini diambil dari database.
                $active_cars = [
                    ['plat' => 'B 1234 ABC', 'merk' => 'Toyota', 'penyewa' => 'Roni Santoso', 'kecepatan' => '60 km/h', 'status' => 'Dibooking'],
                    ['plat' => 'B 1234 ABC', 'merk' => 'Toyota', 'penyewa' => 'Roni Santoso', 'kecepatan' => '60 km/h', 'status' => 'Dibooking'],
                    ['plat' => 'B 1234 ABC', 'merk' => 'Toyota', 'penyewa' => 'Roni Santoso', 'kecepatan' => '0 km/h', 'status' => 'Tersedia'],
                    ['plat' => 'B 1234 ABC', 'merk' => 'Toyota', 'penyewa' => 'Roni Santoso', 'kecepatan' => '60 km/h', 'status' => 'Dibooking']
                ];

                foreach ($active_cars as $car) {
                    $status_icon = ($car['status'] === 'Dibooking') ? 'fas fa-check-circle' : 'fas fa-home';
                    echo "<div class='car-card'>";
                    echo "<div class='car-info'>";
                    echo "<div class='car-icon'><i class='fas fa-car'></i></div>";
                    echo "<div class='details'>";
                    echo "<h4>{$car['plat']} - {$car['merk']}</h4>";
                    echo "<p>Penyewa {$car['penyewa']}</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='status-info'>";
                    echo "<span class='speed'><i class='fas fa-tachometer-alt'></i> {$car['kecepatan']}</span>";
                    echo "<span class='status'><i class='{$status_icon}'></i> {$car['status']}</span>";
                    echo "</div>";
                    echo "<a href='#' class='action-link'>Lihat selengkapnya <i class='fas fa-chevron-right'></i></a>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>
    <script>
        // Ganti 'YOUR_API_KEY' dengan Google Maps API Key Anda yang valid
        const API_KEY = 'YOUR_API_KEY';
        
        function initMap() {
            // Koordinat pusat peta (contoh: Jakarta)
            const mapCenter = { lat: -6.200000, lng: 106.816666 };

            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 12,
                center: mapCenter,
                mapId: "DEMO_MAP_ID", // Ganti dengan Map ID dari Google Cloud Console
            });

            // Data lokasi mobil (contoh statis)
            const carLocations = [
                { position: { lat: -6.175110, lng: 106.865036 }, title: 'B 1234 ABC - Toyota', speed: '60 km/h', status: 'Dibooking' },
                { position: { lat: -6.213251, lng: 106.832961 }, title: 'B 1yoata Aanza - B 1224 ABC', speed: '60 km/h', status: 'Dibooking' },
                { position: { lat: -6.230000, lng: 106.800000 }, title: 'B layoalt2 remyets', speed: '0 km/h', status: 'Tersedia' },
                { position: { lat: -6.185000, lng: 106.880000 }, title: 'B layoalta remyess', speed: '60 km/h', status: 'Dibooking' }
            ];

            // Menambahkan marker untuk setiap mobil
            carLocations.forEach((car) => {
                const marker = new google.maps.Marker({
                    position: car.position,
                    map: map,
                    title: car.title,
                    icon: {
                        url: 'https://maps.google.com/mapfiles/kml/shapes/cabs.png',
                        scaledSize: new google.maps.Size(40, 40)
                    }
                });
                
                // Menambahkan InfoWindow (pop-up) saat marker diklik
                const infoWindow = new google.maps.InfoWindow({
                    content: `
                        <div style="font-family: Arial; font-size: 14px;">
                            <strong>${car.title}</strong><br>
                            - Roni Santoso<br>
                            <span style="display: flex; align-items: center; gap: 5px;">
                                <i class="fas fa-tachometer-alt" style="color: #007bff;"></i> ${car.speed}
                            </span>
                        </div>
                    `,
                });

                marker.addListener("click", () => {
                    infoWindow.open(map, marker);
                });
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=${API_KEY}&callback=initMap"></script>
</body>
</html>