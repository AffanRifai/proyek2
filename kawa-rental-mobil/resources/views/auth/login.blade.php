<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Kawa Rental Mobil</title>
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
            background-image: url('{{asset('img/background-mobil.png')}}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
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
            background-color: rgba(0, 0, 0, 0.10);
            filter: brightness(0.1);
            z-index: -1;
        }


        .login-container {
            width: 90%;
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.3);
            padding: 40px;
            border-radius: 15px;
            border: 2px solid rgba(0, 0, 0, 0.10);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .login-container h2 {
            margin-bottom: 25px;
            font-weight: 600;
            color: var(--text-color);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .input-group {
            margin-bottom: 20px;
        }
        
        .input-group input {
            background: rgba(0, 0, 0, 0.2);
            width: 100%;
            padding: 12px 15px;
            border: 1px solid rgba(0, 0, 0, 0.10);
            border-radius: 8px;
            box-sizing: border-box;   
            color: #fff;
            transition: border-color 0.3s ease;
        }

        ::placeholder {
            color: #e5e5e5;
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

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            font-size: 0.9em;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: left;
        }

        .checkbox-group {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 25px;
        }

        .checkbox-group input {
            margin-right: 10px;
            cursor: pointer;
        }

        .checkbox-group label {
            font-size: 0.9em;
            color: #555;
        }

        .btn-login {
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

        .btn-login:hover {
            background-color: var(--button-hover-color);
        }

        .link-group {
            margin-top: 20px;
        }

        .link-group a {
            color: var(--link-color);
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
            color: #777;
        }
    </style>
</head>

<body>
    <div class="background"></div>
    <div class="login-container">

        @if (session('failed'))
        <div class="alert-danger">{{ session('failed') }}</div>
        @endif

            <h2>LOGIN</h2>
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
                    <input type="password" name="password" placeholder="Masukan sandi">
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" name="remember">
                    <label for="remember-me">Remember me?</label>
                </div>
                <button type="submit" class="btn-login">Login</button>
            </form>
            <div class="link-group">
                <a href="#">Lupa kata sandi?</a>
                <p>Belum punya akun? <a href="/register">Daftar</a></p>
            </div>
        </div>
</body>

</html>