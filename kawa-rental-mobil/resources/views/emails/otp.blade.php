<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi Akun</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f6f7fb;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .header {
            background-color: #0d6efd;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 20px;
            font-weight: bold;
        }
        .content {
            padding: 30px;
            color: #333333;
            line-height: 1.6;
        }
        .otp-box {
            text-align: center;
            margin: 20px 0;
            background-color: #f1f4ff;
            border: 1px dashed #0d6efd;
            border-radius: 8px;
            padding: 15px;
            font-size: 24px;
            font-weight: bold;
            color: #0d6efd;
            letter-spacing: 4px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            padding: 15px 20px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Verifikasi Email Anda
        </div>
        <div class="content">
            <p>Halo <strong>{{ $user->name ?? $user->email }}</strong>,</p>
            <p>Terima kasih telah melakukan pendaftaran di <strong>{{ $appName }}</strong>.</p>
            <p>Untuk menyelesaikan proses pendaftaran, silakan masukkan kode OTP berikut pada halaman verifikasi:</p>

            <div class="otp-box">
                {{ $otp }}
            </div>

            <p>Kode ini hanya berlaku selama <strong>5 menit</strong>.  
            Jika Anda tidak merasa melakukan pendaftaran, abaikan saja email ini.</p>

            <p>Hormat kami,<br>
            <strong>Tim {{ $appName }}</strong></p>
        </div>
        <div class="footer">
            &copy; 2025 {{ $appName }}. Seluruh hak cipta dilindungi.
        </div>
    </div>
</body>
</html>
