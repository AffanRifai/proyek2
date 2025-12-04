<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: #f5f6fa;
        }
        .sidebar {
            width: 240px;
            height: 100vh;
            background-color: #343a40;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            color: white;
        }
        .sidebar a {
            color: #ddd;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .content {
            margin-left: 240px;
            padding: 20px;
        }
        .navbar {
            margin-left: 240px;
        }
    </style>

    @yield('css')
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4 class="text-center">Admin Panel</h4>
        <hr style="border-color:#777;">
        <a href="/admin/dashboard"><i class="fa fa-home"></i> Dashboard</a>
        <a href="/admin/laporan-bulanan"><i class="fa fa-chart-line"></i> Laporan Bulanan</a>
        <a href="/admin/bookings"><i class="fa fa-car"></i> Booking</a>
        <a href="/admin/pembayaran"><i class="fa fa-wallet"></i> Pembayaran</a>
        <a href="/logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <h2>@yield('content_header')</h2>
        <hr>

        @yield('content')
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @yield('js')

</body>
</html>
