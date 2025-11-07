<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kawa Rental Mobil</title>
    {{-- Font Awesome  --}}
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- New Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    {{-- Ionicons  --}}
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');


        :root {
            --primary-bg-color: #ff0000a4;
            --secondary-bg-color: #471a1a;
            --form-bg-color: #ffffff;
            --text-color: #0b1a30;
            --input-bg-color: #f0f0f0;
            --button-bg-color: #3f87b8;
            --button-hover-color: #2e6b8c;
            --link-color: #2078b2;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url('{{ asset('img/background-mobil.png') }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }

        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            filter: brightness(0.1);
            z-index: -1;
        }

        .register-container {
            width: 90%;
            max-width: 400px;
            padding: 40px;
            border-radius: 15px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .5);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .5);
            color: #fff;
            text-align: center;
            position: relative;
            z-index:
        }

        .register-container h2 {
            margin-bottom: 25px;
            font-weight: 600;
            color: white;
            font-size: 36px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group input {
            background: transparent;
            width: 100%;
            font-size: 16px;
            padding: 12px 15px;
            border: 2px solid rgba(255, 255, 255, 0.4);
            border-radius: 40px;
            box-sizing: border-box;
            transition: border-color 0.3s
        }

        .input-group input::placeholder {
            color: rgba(255, 255, 255, 50);
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--button-bg-color);
        }

        .error-message {
            color: red;
            font-size: 0.85em;
            margin-bottom: 10px;
            display: block;
            text-align: left;
        }

        .terms-group {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            text-align: left;
        }

        .terms-group input {
            margin-top: 4px;
            margin-right: 10px;
            cursor: pointer;
        }

        .terms-group label {
            font-size: 0.8em;
            color: #555;
            line-height: 1.4;
        }

        .btn-register {
            width: 50%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: var(--primary-bg-color);
            color: white;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            margin: 10px 0;
            transition: background-color 0.3s ease;
        }

        .btn-register:hover {
            background-color: var(--secondary-bg-color);
        }

        .social-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 15px 0;
        }

        .social-btn {
            padding: 8px 15px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            border: 1px solid #ccc;
            background-color: white;
            font-size: 0.85em;
            font-weight: 500;
        }

        .social-btn img {
            width: 18px;
        }

        .link-group {
            margin-top: 15px;
            font-size: 0.8em;
            color: #777;
        }

        .link-group a {
            color: var(--link-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .link-group a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            font-size: 0.85em;
            margin-bottom: 10px;
        }


        @media (max-width: 480px) {
            .register-container {
                padding: 25px;
            }
        }
    </style>
</head>

<body>
    <div class="background"></div>
    <div class="register-container">

        <h2>DAFTAR</h2>
        <form action="/register" method="POST">
            @csrf
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <div class="input-group">
                <input type="text" name="name" placeholder="Masukan nama lengkap" value="{{ old('name') }}">
            </div>

            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <div class="input-group">
                <input type="email" name="email" placeholder="Masukan email" value="{{ old('email') }}">
            </div>

            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <div class="input-group">
                <input type="password" name="password" placeholder="masukan password" required id="confirm_password">
            </div>

            @error('confirm_password')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <div class="input-group">
                <input type="password" name="confirm_password" placeholder="masukan ulang password" required
                    id="confirm_password">
            </div>

            <div class="terms-group">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms" style="color: white;">Dengan mendaftar, saya menyetujui Syarat & ketentuan dan
                    kebijakan privasi</label>
            </div>

            <button type="submit" class="btn-register">Daftar</button>

        </form>
        <p>- atau -</p>

        <div class="social-buttons">
            <a href="{{ route('google.login') }}" style="text-decoration: none;">
                <div class="social-btn" style="color: black;">
                    <img src="{{ asset('img/google.png') }}" alt="Google Logo">
                    Daftar dengan Goggle
                </div>
            </a>
        </div>
        <div class="link-group" style="color: white;">
            Sudah punya akun? <a href="/login">masuk</a>
        </div>
    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    @if (session('failed'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('failed') }}",
                showConfirmButton: true,
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#a62f19'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Terjadi Kesalahan!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonText: 'Perbaiki',
                confirmButtonColor: '#a62f19'
            });
        </script>
    @endif

</body>

</html>
