<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Booking Admin - Rental Mobil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        :root {
            --primary-color: #007bff;
            --dark-color: #333;
            --light-gray: #f4f4f4;
            --border-color: #ddd;
            --aktif-color: #4CAF50;
            --selesai-color: #2196F3;
            --batal-color: #f44336;
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

        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
        }

        .booking-header h2 {
            font-weight: 600;
        }

        .filter-button {
            background-color: white;
            border: 1px solid var(--border-color);
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .filter-button:hover {
            background-color: var(--light-gray);
        }

        .booking-table {
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
        }

        tbody td {
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            color: white;
        }

        .status-badge.selesai {
            background-color: var(--selesai-color);
        }

        .status-badge.batal {
            background-color: var(--batal-color);
        }

        .status-badge.aktif {
            background-color: var(--aktif-color);
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            gap: 10px;
        }

        .dot {
            width: 10px;
            height: 10px;
            background-color: #bbb;
            border-radius: 50%;
            cursor: pointer;
        }

        .dot.active {
            background-color: var(--primary-color);
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
        <div class="booking-header">
            <h2>Manajemen Booking</h2>
            <button class="filter-button">Filter Tanggal</button>
        </div>
        <div class="booking-table">
            <table>
                <thead>
                    <tr>
                        <th>ID Booking</th>
                        <th>Pelanggan</th>
                        <th>Merk Mobil</th>
                        <th>Plat Nomor</th>
                        <th>Tanggal Kembali</th>
                        <th>Total Biaya</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Contoh data statis untuk menampilkan tabel
                        // Dalam implementasi nyata, data ini akan diambil dari database
                        $bookings = [
                            ['BK-001', 'Reza Rahardian', 'Ayla', 'F 1404 ER', '2025-09-01', '400.000', 'Selesai'],
                            ['BK-002', 'Iko Uwais', 'Agya', 'AD 1908 BA', '2025-09-01', '400.000', 'Batal'],
                            ['BK-003', 'Dian Sastrowa', 'Sigra', 'B 1980 AL', '2025-09-01', '400.000', 'Aktif'],
                            ['BK-004', 'Nicholas Saputra', 'Calya', 'D 2024 EN', '2025-09-01', '400.000', 'Aktif'],
                            ['BK-005', 'Chelsea Islan', 'Yaris', 'L 7000 TU', '2025-09-01', '400.000', 'Selesai'],
                            ['BK-006', 'Vidi Aldiano', 'Avanza', 'DK 1234 LU', '2025-09-01', '400.000', 'Batal'],
                            ['BK-007', 'Maudy Ayunda', 'Xenia', 'S 5555 SA', '2025-09-01', '400.000', 'Aktif'],
                        ];

                        foreach ($bookings as $booking) {
                            $status_class = strtolower($booking[6]);
                            echo "<tr>";
                            echo "<td>{$booking[0]}</td>";
                            echo "<td>{$booking[1]}</td>";
                            echo "<td>{$booking[2]}</td>";
                            echo "<td>{$booking[3]}</td>";
                            echo "<td>{$booking[4]}</td>";
                            echo "<td>{$booking[5]}</td>";
                            echo "<td><span class='status-badge {$status_class}'>{$booking[6]}</span></td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="pagination">
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>
</body>
</html>
