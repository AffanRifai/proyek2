<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Rental Mobil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
        :root {
            --primary-color: #007bff;
            --dark-color: #333;
            --light-gray: #f4f4f4;
            --border-color: #ddd;
            --info-box-bg: #fff;
            --info-box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
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
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin: 20px 0;
        }
        .stats-box {
            background-color: var(--info-box-bg);
            padding: 20px;
            border-radius: 10px;
            box-shadow: var(--info-box-shadow);
            text-align: left;
        }
        .stats-box h4 {
            font-weight: 500;
            color: #555;
            margin-bottom: 5px;
        }
        .stats-box p {
            font-size: 24px;
            font-weight: 600;
            color: var(--dark-color);
        }
        .chart-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-top: 20px;
        }
        .chart-box {
            background-color: var(--info-box-bg);
            padding: 20px;
            border-radius: 10px;
            box-shadow: var(--info-box-shadow);
        }
        .chart-box h3 {
            font-weight: 600;
            margin-bottom: 15px;
        }
        .table-container {
            background-color: var(--info-box-bg);
            padding: 20px;
            border-radius: 10px;
            box-shadow: var(--info-box-shadow);
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
        .status-badge.proses {
            background-color: #ff9800;
        }
        .status-badge.selesai {
            background-color: #4CAF50;
        }
        #monthlyRevenueChart {
            height: 250px;
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

        <div class="stats-grid">
            <div class="stats-box">
                <h4>Pendapatan Bulan Ini</h4>
                <p>Rp. 10.000.000</p>
            </div>
            <div class="stats-box">
                <h4>Jumlah Transaksi Bulan Ini</h4>
                <p>120</p>
            </div>
            <div class="stats-box">
                <h4>Mobil Tersedia / Total</h4>
                <p>10 / 15</p>
            </div>
            <div class="stats-box">
                <h4>Booking Pending</h4>
                <p>8</p>
            </div>
        </div>
        <div class="chart-grid">
            <div class="chart-box">
                <h3>Pendapatan Perbulan</h3>
                <div class="chart-box line-chart-container">
                <canvas id="lineChart"></canvas>
            </div>
            <div class="table-container">
                <h3>Status Mobil</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Jenis Mobil</th>
                            <th>Tersedia</th>
                            <th>Disewa</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $car_status = [
                                ['SUV', 2, 5, 7],
                                ['Sedan', 6, 4, 10],
                                ['Hybrid', 2, 2, 4],
                                ['Pickup', 3, 1, 4],
                                ['Box', 1, 2, 3],
                                ['Truk', 1, 1, 2],
                            ];
                            foreach ($car_status as $row) {
                                echo "<tr>";
                                foreach ($row as $cell) {
                                    echo "<td>{$cell}</td>";
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="table-container" style="margin-top: 20px;">
            <h3>Transaksi Terbaru</h3>
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Customer</th>
                        <th>Mobil</th>
                        <th>Durasi (hari)</th>
                        <th>Total Bayar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $transactions = [
                            ['12-09-2025', 'Joko munowar', '1', '5', 'RP 2.500.000', 'proses'],
                            ['10-09-2025', 'Samsudin', '2', '4', 'RP 2.500.000', 'selesai'],
                            ['9-09-2025', 'Andi Rahayu', '1', '2', 'RP 2.500.000', 'selesai'],
                            ['7-09-2025', 'Jafar', '1', '1', 'RP 2.500.000', 'selesai'],
                            ['7-09-2025', 'Irawan', '3', '2', 'RP 2.500.000', 'selesai'],
                            ['6-09-2025', 'Munawar', '1', '1', 'RP 2.500.000', 'selesai'],
                        ];
                        foreach ($transactions as $row) {
                            $status_class = strtolower($row[5]);
                            echo "<tr>";
                            echo "<td>{$row[0]}</td>";
                            echo "<td>{$row[1]}</td>";
                            echo "<td>{$row[2]}</td>";
                            echo "<td>{$row[3]}</td>";
                            echo "<td>{$row[4]}</td>";
                            echo "<td><span class='status-badge {$status_class}'>{$row[5]}</span></td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        const monthlyRevenueData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Pendapatan',
                data: [10000000, 8000000, 12000000, 10000000, 7000000, 9000000, 8500000, 11000000, 9500000, 14500000, 11000000, 13000000],
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                fill: true,
                tension: 0.4
            }]
        };
        const monthlyRevenueConfig = {
            type: 'line',
            data: monthlyRevenueData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                **animation: false,**
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true, ticks: { callback: function(value) { return 'Rp. ' + value.toLocaleString('id-ID'); } } }
                }
            }
        };
        new Chart(document.getElementById('monthlyRevenueChart'), monthlyRevenueConfig);
    </script>
    <script>
    // Data untuk Line Chart
        const lineChartData = {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            datasets: [
                {
                    label: 'Mobil SUV',
                    data: [12, 20, 25, 30, 25, 38, 30, 35, 28, 30, 32, 35],
                    borderColor: '#2196F3',
                    fill: false,
                    tension: 0.4
                },
                {
                    label: 'Mobil Sedan',
                    data: [25, 30, 28, 35, 32, 28, 34, 30, 32, 28, 30, 33],
                    borderColor: '#f44336',
                    fill: false,
                    tension: 0.4
                },
                {
                    label: 'Mobil Hybrid',
                    data: [15, 25, 30, 25, 28, 30, 25, 28, 26, 30, 31, 29],
                    borderColor: '#4CAF50',
                    fill: false,
                    tension: 0.4
                },
                {
                    label: 'Mobil Pickup',
                    data: [10, 12, 15, 18, 20, 15, 18, 16, 15, 12, 14, 10],
                    borderColor: '#ff9800',
                    fill: false,
                    tension: 0.4
                }
            ]
        };

        // Konfigurasi Line Chart
        const lineChartConfig = {
            type: 'line',
            data: lineChartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Inisialisasi Line Chart
        var lineChart = new Chart(
            document.getElementById('lineChart'),
            lineChartConfig
        );
    </script>
</body>
</html>
