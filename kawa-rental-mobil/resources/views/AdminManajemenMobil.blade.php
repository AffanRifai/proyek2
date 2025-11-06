<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Mobil Admin - Rental Mobil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        :root {
            --primary-color: #007bff;
            --dark-color: #333;
            --light-gray: #f4f4f4;
            --border-color: #ddd;
            --tersedia-color: #4CAF50;
            --edit-color: #ff9800;
            --delete-color: #f44336;
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
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
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

        .car-management-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
        }

        .header-controls {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .search-car {
            position: relative;
        }

        .search-car input {
            padding: 10px 40px 10px 15px;
            border: 1px solid var(--border-color);
            border-radius: 20px;
            outline: none;
            font-size: 14px;
            width: 200px;
        }

        .search-car i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }

        .filter-button, .add-button {
            background-color: white;
            border: 1px solid var(--border-color);
            padding: 10px 15px;
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-button {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            padding: 10px 20px;
        }

        .add-button:hover {
            background-color: #0056b3;
        }

        .filter-button:hover {
            background-color: var(--light-gray);
        }

        .car-table {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            text-align: left;
            padding: 15px;
            border-bottom: 2px solid var(--border-color);
            font-weight: 600;
            color: #555;
            white-space: nowrap;
        }

        tbody td {
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: top;
        }

        .photo-cell img {
            width: 100px;
            height: auto;
            border-radius: 5px;
        }

        .price-cell span {
            display: block;
            line-height: 1.4;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            color: white;
            display: inline-block;
        }

        .status-badge.tersedia {
            background-color: var(--tersedia-color);
        }

        .actions-cell {
            display: flex;
            flex-direction: column;
            gap: 8px;
            white-space: nowrap;
        }

        .action-button {
            padding: 8px 12px;
            border: none;
            border-radius: 20px;
            font-size: 13px;
            cursor: pointer;
            color: white;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .edit-button {
            background-color: var(--edit-color);
        }

        .delete-button {
            background-color: var(--delete-color);
        }

        .action-button i {
            font-size: 11px;
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
            <li class="active"><a href="/AdminDashboardMobil"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="/AdminManajemenMobil"><i class="fas fa-car"></i> Manajemen Mobil</a></li>
            <li><a href="/AdminManajemenBookingMobil"><i class="fas fa-book"></i> Manajemen Booking</a></li>
            <li><a href="/AdminTrackLocation"><i class="fas fa-map-marker-alt"></i> Track Location</a></li>
            <li><a href="/AdminLaporanStatis"><i class="fas fa-chart-line"></i> Laporan & Statistik</a></li>
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
        <div class="car-management-header">
            <h2>Manajemen Mobil</h2>
            <div class="header-controls">
                <div class="search-car">
                    <input type="text" placeholder="Cari Mobil">
                    <i class="fas fa-search"></i>
                </div>
                <button class="filter-button"><i class="fas fa-sliders-h"></i></button>
                <button class="add-button"><i class="fas fa-plus"></i> Tambah</button>
            </div>
        </div>
        <div class="car-table">
            <table>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>FOTO MOBIL</th>
                        <th>MERK MOBIL</th>
                        <th>TAHUN PRODUKSI</th>
                        <th>KAPASITAS PENUMPANG</th>
                        <th>HARGA SEWA</th>
                        <th>STATUS KETERSEDIAAN</th>
                        <th>DESKRIPSI TAMBAHAN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Data statis untuk contoh. Dalam implementasi nyata, ini diambil dari database.
                        $cars = [
                            [1, 'suzuki_ertiga.jpg', 'Suzuki Ertiga', 2022, '6 Orang', ['With Driver: Rp. 400.000', 'Self Driver: Rp. 500.000'], 'Tersedia', ''],
                            [2, 'suzuki_ertiga.jpg', 'Suzuki Ertiga', 2022, '6 Orang', ['With Driver: Rp. 400.000', 'Self Driver: Rp. 500.000'], 'Tersedia', ''],
                            [3, 'suzuki_ertiga.jpg', 'Suzuki Ertiga', 2022, '6 Orang', ['With Driver: Rp. 400.000', 'Self Driver: Rp. 500.000'], 'Tersedia', ''],
                            [4, 'suzuki_ertiga.jpg', 'Suzuki Ertiga', 2022, '6 Orang', ['With Driver: Rp. 400.000', 'Self Driver: Rp. 500.000'], 'Tersedia', ''],
                            [5, 'suzuki_ertiga.jpg', 'Suzuki Ertiga', 2022, '6 Orang', ['With Driver: Rp. 400.000', 'Self Driver: Rp. 500.000'], 'Tersedia', ''],
                        ];

                        foreach ($cars as $car) {
                            $status_class = strtolower($car[6]);
                            echo "<tr>";
                            echo "<td>{$car[0]}</td>";
                            echo "<td class='photo-cell'><img src='assets/{$car[1]}' alt='Foto Mobil'></td>";
                            echo "<td>{$car[2]}</td>";
                            echo "<td>{$car[3]}</td>";
                            echo "<td>{$car[4]}</td>";
                            echo "<td class='price-cell'><span>{$car[5][0]}</span><br><span>{$car[5][1]}</span></td>";
                            echo "<td><span class='status-badge {$status_class}'>{$car[6]}</span></td>";
                            echo "<td class='actions-cell'>";
                            echo "<button class='action-button edit-button'><i class='fas fa-pen'></i> Edit</button>";
                            echo "<button class='action-button delete-button'><i class='fas fa-trash'></i> Hapus</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
