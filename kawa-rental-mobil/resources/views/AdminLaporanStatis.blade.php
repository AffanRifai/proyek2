<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan & Statistik Admin - Rental Mobil</title>
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
            grid-template-columns: repeat(2, 1fr) 1.5fr;
            gap: 20px;
            margin: 20px 0;
        }

        .stats-info-box {
            background-color: var(--info-box-bg);
            padding: 20px;
            border-radius: 10px;
            box-shadow: var(--info-box-shadow);
            text-align: left;
        }

        .stats-info-box h4 {
            font-weight: 500;
            color: #555;
            margin-bottom: 5px;
        }

        .stats-info-box p {
            font-size: 24px;
            font-weight: 600;
            color: var(--dark-color);
        }

        .chart-box {
            background-color: var(--info-box-bg);
            padding: 20px;
            border-radius: 10px;
            box-shadow: var(--info-box-shadow);
        }

        .line-chart-container {
            grid-column: span 2;
            height: 300px;
        }

        .pie-chart-container {
            height: 300px;
        }

        .report-table {
            margin-top: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .report-table h3 {
            margin-bottom: 15px;
            font-weight: 600;
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

        tfoot td {
            font-weight: 600;
            padding: 15px;
            border-top: 2px solid var(--border-color);
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
            <div class="stats-info-box">
                <h4>Pendapatan Bulan Ini</h4>
                <p>Rp. 10.000.000</p>
            </div>
            <div class="stats-info-box">
                <h4>Jumlah Transaksi Bulan Ini</h4>
                <p>120</p>
            </div>
            <div class="chart-box line-chart-container">
                <canvas id="lineChart"></canvas>
            </div>
            <div class="chart-box pie-chart-container">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
        <div class="report-table">
            <h3>Tabel Laporan & Statistik Rental Mobil Bulanan</h3>
            <table>
                <thead>
                    <tr>
                        <th>Jenis Mobil</th>
                        <th>Jumlah unit disewa</th>
                        <th>Jumlah transaksi</th>
                        <th>Total Hari Sewa</th>
                        <th>Rata-rata Lama Sewa (hari)</th>
                        <th>Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Data statis untuk tabel. Dalam implementasi nyata, ini diambil dari database.
                        $data = [
                            ['SUV', 20, 24, 70, 2.9, 'Rp. 2.000.000'],
                            ['Sedan', 28, 36, 110, 3.0, 'Rp. 3.500.000'],
                            ['Hybrid', 32, 42, 125, 3.0, 'Rp. 3.800.000'],
                            ['Pickup', 15, 18, 55, 3.1, 'Rp. 1.500.000'],
                            ['Listrik', 10, 12, 20, 2.9, 'Rp. 1.000.000']
                        ];

                        foreach ($data as $row) {
                            echo "<tr>";
                            foreach ($row as $cell) {
                                echo "<td>{$cell}</td>";
                            }
                            echo "</tr>";
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">TOTAL</td>
                        <td>Rp. 11.800.000</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
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

        // Data untuk Pie Chart
        const pieChartData = {
            labels: ['Mobil SUV', 'Mobil Sedan', 'Mobil Hybrid', 'Mobil Pickup'],
            datasets: [{
                data: [30, 35, 25, 10], // Persentase sewa
                backgroundColor: [
                    '#2196F3',
                    '#f44336',
                    '#4CAF50',
                    '#ff9800'
                ],
                hoverOffset: 4
            }]
        };

        // Konfigurasi Pie Chart
        const pieChartConfig = {
            type: 'pie',
            data: pieChartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                }
            }
        };

        // Inisialisasi Pie Chart
        var pieChart = new Chart(
            document.getElementById('pieChart'),
            pieChartConfig
        );
    </script>
</body>
</html>
