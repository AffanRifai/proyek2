<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Kata Sandi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ffffff;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 520px;
            margin: 40px auto;
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #a62f19;
            color: #fff;
            text-align: center;
            padding: 25px;
        }
        .header h2 {
            margin: 0;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .content {
            padding: 30px;
            text-align: center;
        }
        .content p {
            line-height: 1.7;
        }
        .btn {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 28px;
            background-color: #a62f19;
            color: #fff !important;
            text-decoration: none;
            font-weight: 600;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #912814;
        }
        .footer {
            text-align: center;
            font-size: 13px;
            color: #888;
            padding: 20px;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Reset Kata Sandi Anda</h2>
        </div>
        <div class="content">
            <p>Halo <strong>{{ $user->name }}</strong>,</p>
            <p>Kami menerima permintaan untuk mengatur ulang kata sandi akun Anda. Klik tombol di bawah ini untuk melanjutkan proses reset kata sandi.</p>
            <a href="{{ $resetUrl }}" class="btn">Atur Ulang Kata Sandi</a>
            <p style="margin-top: 25px; color: #777;">Tautan ini hanya berlaku selama 60 menit. Jika Anda tidak meminta reset, abaikan pesan ini.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Sistem Booking Lapangan. Semua Hak Dilindungi.</p>
        </div>
    </div>
</body>
</html>
