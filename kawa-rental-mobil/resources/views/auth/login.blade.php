<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Kawa Rental Mobil</title>
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        :root {
            --primary-bg-color: #ff0000a4;
            --secondary-bg-color: #1a2a47;
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

        .login-container {
            width: 90%;
            max-width: 400px;
            padding: 30px 25px;
            border-radius: 15px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .5);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, .5);
            color: #fff;
            text-align: center;
            position: relative;
            z-index: 1;
            margin: 20px;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 25px 20px;
                width: 85%;
                max-width: 350px;
            }
        }

        .login-container h2 {
            margin-bottom: 20px;
            font-weight: 600;
            color: white;
            font-size: 28px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        @media (max-width: 480px) {
            .login-container h2 {
                font-size: 24px;
                margin-bottom: 15px;
            }
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group input {
            background: transparent;
            width: 100%;
            font-size: 16px;
            padding: 14px 45px 14px 15px;
            border: 2px solid rgba(255, 255, 255, 0.4);
            border-radius: 40px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
            color: white;
        }

        @media (max-width: 480px) {
            .input-group input {
                padding: 13px 40px 13px 15px;
                font-size: 15px;
            }
        }

        /* Fix untuk iOS agar tidak zoom */
        @media screen and (max-width: 480px) {
            .input-group input {
                font-size: 16px !important;
            }
        }

        .input-group input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--button-bg-color);
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            font-size: 18px;
            padding: 0;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 480px) {
            .password-toggle {
                right: 12px;
                font-size: 16px;
            }
        }

        .error-message {
            color: red;
            font-size: 0.85em;
            margin-bottom: 10px;
            display: block;
            text-align: left;
        }

        .checkbox-group {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 20px;
        }

        .checkbox-group input {
            margin-right: 10px;
            cursor: pointer;
            width: 16px;
            height: 16px;
        }

        @media (max-width: 480px) {
            .checkbox-group input {
                width: 16px;
                height: 16px;
            }
        }

        .checkbox-group label {
            font-size: 0.9em;
            color: white;
        }

        .btn-login {
            width: 50%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: var(--primary-bg-color);
            color: white;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        @media (max-width: 480px) {
            .btn-login {
                width: 60%;
                padding: 11px;
                font-size: 0.95em;
            }
        }

        .btn-login:hover {
            background-color: var(--button-hover-color);
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
            gap: 8px;
            cursor: pointer;
            border: 1px solid #ccc;
            background-color: white;
            font-size: 0.9rem;
            font-weight: 550;
            text-decoration: none;
            height: 40px;
        }

        @media (max-width: 480px) {
            .social-btn {
                padding: 6px 12px;
                font-size: 0.85rem;
                height: 38px;
            }
        }

        .social-btn img {
            width: 24px;
            height: 24px;
        }

        @media (max-width: 480px) {
            .social-btn img {
                width: 22px;
                height: 22px;
            }
        }

        .link-group {
            margin-top: 20px;
        }

        .link-group a {
            color: #a3d5ff;
            text-decoration: none;
            font-size: 0.9em;
            transition: color 0.3s ease;
        }

        .link-group a:hover {
            text-decoration: underline;
        }

        .link-group p {
            margin: 0;
            font-size: 0.9em;
            color: white;
        }

        p {
            color: white;
            margin: 12px 0;
            font-size: 0.95em;
        }
    </style>
</head>

<body>
    <div class="background"></div>
    <div class="login-container">
        <h2>MASUK</h2>
        <form action="/login" method="POST">
            @csrf

            @error('email')
                <small class="error-message" style="color: red;">{{ $message }}</small>
            @enderror
            <div class="input-group">
                <input type="email" name="email" placeholder="masukan email">
            </div>

            @error('password')
                <small class="error-message" style="color: red;">{{ $message }}</small>
            @enderror
            <div class="input-group">
                <input type="password" name="password" id="password" placeholder="Masukan sandi">
                <button type="button" class="password-toggle" id="togglePassword">
                    <i class="fas fa-lock"></i>
                </button>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me?</label>
            </div>
            <button type="submit" class="btn-login">Masuk</button>
        </form>

        <p>- atau -</p>

        <div class="social-buttons">
            <a href="{{ route('google.login') }}" style="text-decoration: none;">
                <div class="social-btn" style="color: black;">
                    <img src="{{ asset('img/google.png') }}" alt="Google Logo">
                    Masuk dengan Google
                </div>
            </a>
        </div>

        <div class="link-group">
            <a href="{{ route('password.request') }}">Lupa kata sandi?</a>
            <p>Belum punya akun? <a href="/register">Daftar</a></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                if (type === 'text') {
                    this.innerHTML = '<i class="fas fa-lock-open"></i>';
                } else {
                    this.innerHTML = '<i class="fas fa-lock"></i>';
                }
            });
        });
    </script>

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
