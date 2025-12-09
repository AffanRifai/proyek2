@extends('layout.profile')

@section('title', 'Profile - KAWA Rental Mobil')

@section('content')
    <div class="profilepage-container">
        <div class="profile-card">


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

                {{-- Kalau provider-nya manual, tampilkan ubah password --}}
                @if ($user->provider === 'manual' || $user->provider === null)
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
                @else
                    {{-- Kalau login via Google --}}
                    <div class="alert" style="background:#e0f2fe;color:#0369a1;">
                        Anda login menggunakan akun <strong>Google</strong>.<br>
                        Fitur ubah password dan lupa password tidak tersedia.
                    </div>
                @endif

                <button type="submit" class="save-btn">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                </button>
            </form>

            <div class="action-links">
                <a href="/landingpage"><i class="fa-solid fa-arrow-left"></i> Kembali</a>

                @if ($user->provider === 'manual' || $user->provider === null)
                    <a href="{{ route('password.request') }}"><i class="fa-solid fa-key"></i> Lupa Password?</a>
                @endif
            </div>
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
@endsection
