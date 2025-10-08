<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kawa Rental Mobil</title>
    {{-- Font Awesome  --}}
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    {{-- New Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"/>
    {{-- Ionicons  --}}
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');


        :root {
            --primary-bg-color: #0b1a30;
            --secondary-bg-color: #1a2a47;
            --form-bg-color: #ffffff;
            --text-color: #0b1a30;
            --input-bg-color: #f0f0f0;
            --button-bg-color: #3f87b8;
            --button-hover-color: #2e6b8c;
            --link-color: #3f87b8;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: var(--primary-bg-color);
            color: var(--text-color);
            position: relative;
            overflow: hidden;
        }

        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('img/header.jpg')}}');
            background-repeat: no-repeat;
            background-size: cover; 
            background-position: center;
            filter: brightness(0.8);
            z-index: -1;
        }
        
        .background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.1);
        }

        .register-container {
            width: 90%;
            max-width: 380px; 
            background-color: var(--form-bg-color);
            padding: 30px; 
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .register-container h2 {
            margin-bottom: 20px; 
            font-weight: 600;
            color: var(--text-color);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .input-group {
            margin-bottom: 15px; 
        }

        .input-group input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            background-color: var(--input-bg-color);
            color: var(--text-color);
            transition: border-color 0.3s ease;
        }

        .error-message {
            color: red;
            font-size: 0.85em;
            margin-bottom: 10px;
            display: block;
            text-align: left;
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--button-bg-color);
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
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: var(--button-bg-color);
            color: white;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-register:hover {
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
                <input type="email" name="email" placeholder="Masukan email"  value="{{ old('email') }}">
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
                <input type="password" name="confirm_password" placeholder="masukan ulang password" required id="confirm_password">
            </div>

            <div class="terms-group">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">Dengan mendaftar, saya menyetujui Syarat & ketentuan dan kebijakan privasi</label>
            </div>

            <div class="social-buttons">
                <div class="social-btn">
                    <img src="{{asset ('img/google.png')}}" alt="Google Logo">
                    Google
                </div>
                <div class="social-btn">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/05/Facebook_Logo_%282019%29.png" alt="Facebook Logo">
                    Facebook
                </div>
            </div>
            <button type="submit" class="btn-register">Daftar</button>
        </form>
        <div class="link-group">
            Sudah punya akun? <a href="/login">masuk</a>
        </div>
    </div>
</body>
</html>