<header>
    <a href="/" class="logo">
        <img src="{{ asset('img/logo-kawa.png') }}" alt="logo kawa rental mobil" />
    </a>
    <nav>
        <ul>
            <li><a href="/landingpage">Beranda</a></li>
            <li><a href="/daftar-mobil">Daftar Mobil</a></li>
            <li><a href="/TentangKami">Tentang</a></li>
            @auth
                <li><a href="#" {{ request()->is('pesanan') ? 'active' : '' }}>Pesanan Anda</a></li>
            @endauth
            <li class="search-container">
                <input type="search" placeholder="Search" aria-label="Cari" />
            </li>

            @auth
                <li class="dropdown">
                    <div class="profile-container" id="profileToggle">
                        <img src="{{ Auth::user()->profile_photo ?? asset('img/default-profile.png') }}" alt="Profile"
                            class="profile-img" />
                    </div>

                    <div class="dropdown-menu" id="dropdownMenu">
                        <div class="dropdown-header">
                            <img src="{{ Auth::user()->profile_photo ?? asset('img/default-profile.png') }}" alt="Profile"
                                class="dropdown-profile-img" />
                            <div class="dropdown-user-info">
                                <strong>{{ Auth::user()->name }}</strong><br>
                                <small>{{ Auth::user()->email }}</small>
                            </div>
                        </div>
                        <hr>
                        <a href="/profile" class="dropdown-item">Profil Saya</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item logout-btn">Keluar</button>
                        </form>
                    </div>
                </li>
            @else
                <a href="/login"><button class="login-btn" aria-label="Login">Login</button></a>
            @endauth
        </ul>
    </nav>
</header>
