<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Profil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font & Icon -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: #333;
            background-image: url('{{ asset('img/background-mobil.png') }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
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

        .profile-card {
            background: #ffffff;
            padding: 2rem 2.5rem;
            border-radius: 20px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.1);
            max-width: 460px;
            width: 100%;
            animation: fadeIn 0.6s ease;
            border-top: 6px solid #a62f19;
            margin: 20px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h2 {
            text-align: center;
            color: #a62f19;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .alert {
            padding: 0.8rem 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            text-align: center;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .photo-section {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .photo-preview img {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #a62f19;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .photo-preview img:hover {
            transform: scale(1.05);
        }

        .upload-btn {
            display: inline-block;
            background: #a62f19;
            color: white;
            padding: 8px 16px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 0.9rem;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .upload-btn:hover {
            background: #8b2715;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px 14px;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 0.95rem;
            margin-top: 6px;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #a62f19;
            outline: none;
            box-shadow: 0 0 5px rgba(166, 47, 25, 0.3);
        }

        hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 1.5rem 0;
        }

        .input-with-btn {
            display: flex;
            align-items: center;
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            color: #a62f19;
            cursor: pointer;
            font-size: 1.1rem;
            transition: transform 0.2s ease;
        }

        .toggle-password:hover {
            transform: scale(1.1);
        }

        .save-btn {
            width: 100%;
            padding: 12px;
            border: none;
            background: #a62f19;
            color: white;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 1.2rem;
            transition: all 0.3s ease;
        }

        .save-btn:hover {
            background: #8b2715;
            transform: translateY(-1px);
        }

        .action-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.3rem;
            font-size: 0.9rem;
        }

        .action-links a {
            text-decoration: none;
            color: #a62f19;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color 0.3s ease;
        }

        .action-links a:hover {
            color: #8b2715;
        }

        @media (max-width: 480px) {
            .profile-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="background"></div>
    <div class="profile-card">
        <h2>Profil Saya</h2>

        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div style="background:#fde68a;padding:10px;border-radius:8px;margin-bottom:12px;color:#7c2d12;">
                <strong>Terjadi kesalahan:</strong>
                <ul style="margin:8px 0 0 16px;">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('failed'))
            <div style="background:#fecaca;padding:10px;border-radius:8px;margin-bottom:12px;color:#7f1d1d;">
                {{ session('failed') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="photo-section">
                <div class="photo-preview">
                    <img id="preview-img"
                        src="{{ $user->profile_photo ? asset($user->profile_photo) : asset('img/default-profile.png') }}"
                        alt="Foto Profil">
                </div>
                <label class="upload-btn">
                    <i class="fa-solid fa-camera"></i> Ganti Foto
                    <input type="file" name="profile_photo" id="profile_photo" accept="image/*" hidden>
                </label>
            </div>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" readonly>
            </div>

            <hr>
            <h4 style="margin-bottom: 1rem; color:#444;">Ubah Password (opsional)</h4>

            @php
                $passwordFields = [
                    ['id' => 'current_password', 'label' => 'Password Saat Ini', 'name' => 'current_password'],
                    ['id' => 'new_password', 'label' => 'Password Baru', 'name' => 'new_password'],
                    [
                        'id' => 'new_password_confirmation',
                        'label' => 'Konfirmasi Password Baru',
                        'name' => 'new_password_confirmation',
                    ],
                ];
            @endphp

            @foreach ($passwordFields as $field)
                <div class="form-group">
                    <label for="{{ $field['id'] }}">{{ $field['label'] }}</label>
                    <div class="input-with-btn">
                        <input id="{{ $field['id'] }}" type="password" name="{{ $field['name'] }}"
                            placeholder="Masukkan {{ strtolower($field['label']) }}">
                        <button type="button" class="toggle-password" data-target="{{ $field['id'] }}">
                            <i class="fa-solid fa-lock"></i>
                        </button>
                    </div>
                </div>
            @endforeach

            <button type="submit" class="save-btn">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
            </button>
        </form>

        <div class="action-links">
            <a href="/landingpage"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
            <a href="{{ route('password.request') }}"><i class="fa-solid fa-key"></i> Lupa Password?</a>

        </div>
    </div>

    <script>
        // Preview foto
        document.getElementById('profile_photo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('preview-img').src = ev.target.result;
            }
            reader.readAsDataURL(file);
        });

        // Toggle password animasi
        document.querySelectorAll('.toggle-password').forEach(btn => {
            btn.addEventListener('click', () => {
                const target = document.getElementById(btn.dataset.target);
                const icon = btn.querySelector('i');
                const showing = target.type === 'text';
                target.type = showing ? 'password' : 'text';

                icon.style.transform = 'rotateY(180deg)';
                setTimeout(() => {
                    icon.classList.toggle('fa-lock');
                    icon.classList.toggle('fa-lock-open');
                    icon.style.transform = 'rotateY(0)';
                }, 200);
            });
        });
    </script>
</body>

</html>
