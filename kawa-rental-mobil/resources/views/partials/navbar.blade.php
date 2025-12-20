<header>
    <style>
        /* === VARIABLES & GLOBAL === */
        :root {
            --primary: #A62F19;
            --primary-dark: #8a2815;
            --primary-light: #ff5a3c;
            --text: #333333;
            --text-light: #666666;
            --bg: #ffffff;
            --bg-light: #f8f9fa;
            --border: #e0e0e0;
            --shadow: rgba(0, 0, 0, 0.08);
            --shadow-hover: rgba(166, 47, 25, 0.15);
            --radius: 12px;
            --radius-full: 999px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* === MODERN NAVBAR === */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background: var(--bg);
            border-bottom: 1px solid var(--border);
            position: relative;
            z-index: 1000;
            box-shadow: 0 2px 20px var(--shadow);
            backdrop-filter: blur(10px);
            overflow: visible !important;
            /* PERBAIKAN: Pastikan tidak ada overflow yang memotong */
        }

        .logo {
            display: block;
        }

        .logo img {
            width: 140px;
            height: auto;
            transition: var(--transition);
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .logo:hover img {
            transform: scale(1.05);
            filter: drop-shadow(0 4px 8px rgba(166, 47, 25, 0.2));
        }

        /* === NAVIGATION === */
        nav {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            overflow: visible !important;
            /* PERBAIKAN: Pastikan tidak ada overflow yang memotong */
        }

        .nav-desktop {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
            overflow: visible !important;
            /* PERBAIKAN: Pastikan tidak ada overflow yang memotong */
        }

        .nav-desktop li:not(.dropdown):not(.search-container) a {
            text-decoration: none;
            color: var(--text);
            font-weight: 500;
            font-size: 0.95rem;
            padding: 0.5rem 0;
            position: relative;
            transition: var(--transition);
            white-space: nowrap;
        }

        .nav-desktop li:not(.dropdown):not(.search-container) a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            transition: var(--transition);
            border-radius: 2px;
        }

        .nav-desktop li:not(.dropdown):not(.search-container) a:hover {
            color: var(--primary);
        }

        .nav-desktop li:not(.dropdown):not(.search-container) a:hover::after {
            width: 100%;
        }

        /* === SEARCH BAR MODERN === */
        .search-container {
            position: relative;
            margin-right: 0.5rem;
        }

        .search-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            color: var(--text-light);
            transition: var(--transition);
            pointer-events: none;
        }

        .search-input {
            padding: 0.7rem 1rem 0.7rem 2.5rem;
            border: 2px solid transparent;
            background: var(--bg-light);
            border-radius: var(--radius-full);
            width: 180px;
            font-size: 0.9rem;
            transition: var(--transition);
            outline: none;
            color: var(--text);
        }

        .search-input::placeholder {
            color: var(--text-light);
            opacity: 0.7;
        }

        .search-input:focus {
            width: 250px;
            background: var(--bg);
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--shadow-hover);
        }

        .search-input:focus+.search-icon {
            color: var(--primary);
        }

        /* === LOGIN BUTTON === */
        .login-btn {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 0.7rem 1.8rem;
            border-radius: var(--radius-full);
            font-weight: 600;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 4px 12px rgba(166, 47, 25, 0.25);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(166, 47, 25, 0.35);
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .login-btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%);
            transform-origin: 50% 50%;
        }

        .login-btn:focus:not(:active)::after {
            animation: ripple 1s ease-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }

            100% {
                transform: scale(40, 40);
                opacity: 0;
            }
        }

        /* === PROFILE SECTION === */
        .profile-toggle {
            display: flex;
            cursor: pointer;
            position: relative;
            transition: var(--transition);
            transform-style: preserve-3d;
            /* PERBAIKAN: Untuk transform 3D yang lebih baik */
        }

        .profile-img {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid transparent;
            background: linear-gradient(var(--bg), var(--bg)) padding-box,
                linear-gradient(135deg, var(--primary), var(--primary-light)) border-box;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(166, 47, 25, 0.15);
        }

        .profile-img:hover {
            transform: scale(1.08);
            box-shadow: 0 6px 20px rgba(166, 47, 25, 0.25);
        }

        .profile-notification {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 12px;
            height: 12px;
            background: linear-gradient(135deg, #ff4757, #ff3838);
            border-radius: 50%;
            border: 2px solid var(--bg);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        /* === DROPDOWN MODERN - DIPERBAIKI === */
        .dropdown {
            position: relative;
            overflow: visible !important;
        }

        /* Dropdown Container - Menyesuaikan width dengan konten */
        .dropdown-menu {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background: var(--bg);
            border-radius: var(--radius);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            min-width: 200px;
            /* Diperkecil dari 280px */
            max-width: 300px;
            /* Batas maksimum */
            width: max-content;
            /* Menyesuaikan dengan konten */
            z-index: 1100;
            padding: 0.4rem;
            /* Diperkecil dari 0.5rem */
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: var(--transition);
            border: 1px solid var(--border);
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.98);
            overflow: visible !important;
            margin-top: 5px;
        }

        .dropdown-menu.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
            animation: dropdownSlide 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes dropdownSlide {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Panah dropdown */
        .dropdown-menu::before {
            content: '';
            position: absolute;
            top: -8px;
            right: 20px;
            width: 16px;
            height: 16px;
            background: var(--bg);
            transform: rotate(45deg);
            border-top: 1px solid var(--border);
            border-left: 1px solid var(--border);
            z-index: 1101;
        }

        /* Header Dropdown - Diperkecil */
        .dropdown-header {
            display: flex;
            align-items: center;
            gap: 10px;
            /* Diperkecil dari 12px */
            padding: 0.8rem;
            /* Diperkecil dari 1.2rem */
            margin-bottom: 0.3rem;
            /* Diperkecil dari 0.5rem */
        }

        .dropdown-profile-img {
            width: 45px;
            /* Diperkecil dari 50px */
            height: 45px;
            /* Diperkecil dari 50px */
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid transparent;
            /* Diperkecil dari 3px */
            background: linear-gradient(var(--bg), var(--bg)) padding-box,
                linear-gradient(135deg, var(--primary), var(--primary-light)) border-box;
        }

        .dropdown-header div {
            flex: 1;
            min-width: 0;
            /* Agar teks panjang bisa wrap */
            overflow: hidden;
        }

        .dropdown-header strong {
            display: block;
            color: var(--text);
            font-size: 0.88rem;
            /* Diperkecil dari 0.95rem */
            margin-bottom: 0.1rem;
            /* Diperkecil dari 0.2rem */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .dropdown-header small {
            color: var(--text-light);
            font-size: 0.75rem;
            /* Diperkecil dari 0.8rem */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Item Dropdown - Diperkecil */
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            /* Diperkecil dari 0.8rem */
            padding: 0.7rem 0.8rem;
            /* Diperkecil dari 0.9rem 1rem */
            color: var(--text);
            text-decoration: none;
            transition: var(--transition);
            font-weight: 500;
            font-size: 0.85rem;
            /* Diperkecil dari 0.9rem */
            border-radius: 6px;
            /* Diperkecil dari 8px */
            margin: 0.15rem 0;
            /* Diperkecil dari 0.2rem 0 */
            white-space: nowrap;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, rgba(166, 47, 25, 0.08), rgba(166, 47, 25, 0.04));
            color: var(--primary);
            transform: translateX(3px);
            /* Diperkecil dari 5px */
        }

        .dropdown-item.logout-btn {
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            font-family: inherit;
        }

        .dropdown-item.logout-btn:hover {
            color: #ff3838;
        }

        .dropdown-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border), transparent);
            margin: 0.3rem 0.8rem;
            /* Diperkecil dari 0.5rem 1rem */
        }

        /* Icon dalam dropdown item - Diperkecil */
        .dropdown-item svg {
            width: 16px;
            /* Diperkecil dari 18px */
            height: 16px;
            /* Diperkecil dari 18px */
            flex-shrink: 0;
        }

        /* Responsive untuk dropdown di mobile */
        @media (max-width: 1100px) {
            .dropdown-menu {
                min-width: 180px;
                max-width: 280px;
                padding: 0.3rem;
            }

            .dropdown-header {
                padding: 0.6rem;
                gap: 8px;
            }

            .dropdown-profile-img {
                width: 40px;
                height: 40px;
            }

            .dropdown-header strong {
                font-size: 0.85rem;
            }

            .dropdown-header small {
                font-size: 0.72rem;
            }

            .dropdown-item {
                padding: 0.6rem 0.7rem;
                font-size: 0.82rem;
                gap: 0.6rem;
            }

            .dropdown-item svg {
                width: 15px;
                height: 15px;
            }

            .dropdown-menu::before {
                right: 15px;
                width: 14px;
                height: 14px;
            }
        }

        @media (max-width: 900px) {
            .dropdown-menu {
                min-width: 170px;
                padding: 0.25rem;
                top: calc(100% + 6px) !important;
            }

            .dropdown-header {
                padding: 0.5rem 0.6rem;
            }

            .dropdown-profile-img {
                width: 38px;
                height: 38px;
            }

            .dropdown-item {
                padding: 0.55rem 0.6rem;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .dropdown-menu {
                min-width: 160px;
                max-width: 220px;
            }

            .dropdown-header {
                padding: 0.4rem 0.5rem;
            }

            .dropdown-profile-img {
                width: 35px;
                height: 35px;
            }

            .dropdown-header strong {
                font-size: 0.8rem;
            }

            .dropdown-header small {
                font-size: 0.7rem;
            }

            .dropdown-item {
                padding: 0.5rem;
                font-size: 0.78rem;
            }

            .dropdown-divider {
                margin: 0.2rem 0.5rem;
            }
        }

        /* === BURGER MENU SIMPLE === */
        .burger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 0.5rem;
            background: var(--bg-light);
            border-radius: var(--radius);
            transition: var(--transition);
            z-index: 100;
            position: relative;
        }

        .burger:hover {
            background: rgba(166, 47, 25, 0.1);
            transform: scale(1.05);
        }

        .burger span {
            width: 25px;
            height: 2.5px;
            background: var(--text);
            border-radius: 2px;
            transition: var(--transition);
            transform-origin: center;
        }

        /* Burger tidak berubah menjadi X saat aktif */
        .burger.active span {
            /* Tidak ada transformasi menjadi X */
            background: var(--text);
        }

        /* === MOBILE MENU MODERN === */
        .mobile-menu {
            position: fixed;
            top: 0;
            left: -100%;
            width: 300px;
            height: 100vh;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98), rgba(248, 249, 250, 0.98));
            padding: 2rem;
            box-shadow: 5px 0 30px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            gap: 1rem;
            transition: var(--transition-slow);
            z-index: 999;
            backdrop-filter: blur(20px);
            overflow-y: auto;
        }

        .mobile-menu::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
        }

        .mobile-menu.open {
            left: 0;
        }

        .mobile-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
            z-index: 998;
        }

        .mobile-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .mobile-logo {
            margin-bottom: 2rem;
            text-align: center;
            display: none;
            /* Logo disembunyikan di mobile */
        }

        .mobile-logo img {
            width: 160px;
            height: auto;
        }

        .mobile-menu a {
            padding: 1rem 1.5rem;
            font-weight: 600;
            font-size: 1rem;
            color: var(--text);
            text-decoration: none;
            border-radius: var(--radius);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .mobile-menu a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: linear-gradient(90deg, rgba(166, 47, 25, 0.1), transparent);
            transition: var(--transition);
            z-index: -1;
        }

        .mobile-menu a:hover {
            color: var(--primary);
            transform: translateX(10px);
        }

        .mobile-menu a:hover::before {
            width: 100%;
        }

        .close-menu {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-light);
            border-radius: 50%;
            cursor: pointer;
            transition: var(--transition);
            font-size: 1.5rem;
            color: var(--text);
        }

        .close-menu:hover {
            background: var(--primary);
            color: white;
            transform: rotate(90deg);
        }

        /* === RESPONSIVE DESIGN === */
        @media (max-width: 1100px) {
            .nav-desktop li:not(.dropdown):not(.search-container):not(.login-container) {
                display: none;
            }
        }

        @media (max-width: 900px) {
            header {
                padding: 1rem;
            }

            /* Make header more compact on mobile */
            header {
                padding: 0.6rem 0.8rem;
            }

            /* Hide desktop logo on mobile (mobile-logo inside panel remains) */
            .logo {
                display: none !important;
            }

            .mobile-logo {
                display: block !important;
            }

            /* Smaller, cleaner search on mobile */
            .search-input {
                width: 40px;
                padding-left: 36px;
                font-size: 0.85rem;
            }

            .search-input:focus {
                width: 160px;
                padding-left: 2.2rem;
            }

            /* Show burger on mobile */
            .burger {
                display: flex;
                margin-right: auto;
            }

            .mobile-menu {
                width: 260px;
                padding: 1.2rem;
            }

            /* Adjust layout order and spacing */
            nav {
                margin-left: auto;
            }

            .search-container {
                order: 1;
            }

            .dropdown,
            .login-container {
                order: 2;
            }

            .login-btn {
                padding: 0.5rem 1.1rem;
                font-size: 0.82rem;
            }

            .profile-img {
                width: 38px;
                height: 38px;
            }
        }

        @media (max-width: 480px) {
            .search-container {
                margin-right: 0;
            }

            .search-input:focus {
                width: 140px;
            }

            .login-btn {
                padding: 0.5rem 1rem;
                font-size: 0.78rem;
            }

            .profile-img {
                width: 34px;
                height: 34px;
            }

            /* Tighter spacing for very small screens */
            .burger {
                padding: 0.35rem;
            }

            .burger span {
                width: 20px;
                height: 1.8px;
            }
        }

        /* === UTILITY CLASSES === */
        .shadow-sm {
            box-shadow: 0 2px 10px var(--shadow) !important;
        }

        .glass-effect {
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.9) !important;
        }
    </style>

    <!-- Desktop Logo - Tersembunyi di Mobile -->
    <a href="/" class="logo">
        <img src="{{ asset('img/logo-kawa.png') }}" alt="logo kawa rental mobil" />
    </a>

    <!-- Burger Icon - Selalu tampil di mobile, posisi kiri -->
    <div class="burger" id="burgerBtn">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <!-- Mobile Overlay untuk menutup menu -->
    <div class="mobile-overlay" id="mobileOverlay"></div>

    <!-- MOBILE SLIDE MENU -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="close-menu" id="closeMenuBtn">✕</div>

        <!-- Logo di mobile menu (opsional) -->
        <div class="mobile-logo" style="display: block;">
            <img src="{{ asset('img/logo-kawa.png') }}" alt="logo mobile">
        </div>

        <a href="/">Beranda</a>
        <a href="/daftar-mobil">Daftar Mobil</a>
        <a href="/TentangKami">Tentang Kami</a>

        @auth
            <a href="{{ route('pesanan.index') }}">Pesanan Anda</a>
            <a href="/profile">Profil Saya</a>
            <form action="{{ route('logout') }}" method="POST" style="margin-top: 1rem;">
                @csrf
                <button type="submit" class="login-btn" style="width: 100%; justify-content: center;">
                    Keluar
                </button>
            </form>
        @endauth
    </div>

    <!-- NAV DESKTOP -->
    <nav>
        <ul class="nav-desktop">
            <!-- Navigation Items (hidden on mobile) -->
            <li><a href="/">Beranda</a></li>
            <li><a href="/daftar-mobil">Daftar Mobil</a></li>
            <li><a href="/TentangKami">Tentang</a></li>

            @auth
                <li><a href="{{ route('pesanan.index') }}">Pesanan</a></li>
            @endauth

            <!-- Search -->
            <li class="search-container">
                <div class="search-input-wrapper">
                    <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8" />
                        <path d="M21 21l-4.35-4.35" />
                    </svg>
                    <input type="search" class="search-input" placeholder="Cari mobil...">
                </div>
            </li>

            <!-- Profile / Login -->
            @auth
                <li class="dropdown">
                    <div id="profileToggle" class="profile-toggle">
                        <img src="{{ Auth::user()->profile_photo ?? asset('img/default-profile.png') }}" class="profile-img"
                            alt="Profile">
                        @if (rand(0, 1))
                            <!-- Example notification indicator -->
                            <div class="profile-notification"></div>
                        @endif
                    </div>

                    <!-- Dropdown -->
                    <div class="dropdown-menu" id="dropdownMenu">
                        <div class="dropdown-header">
                            <img src="{{ Auth::user()->profile_photo ?? asset('img/default-profile.png') }}"
                                class="dropdown-profile-img" />
                            <div>
                                <strong>{{ Auth::user()->name }}</strong>
                                <small>{{ Auth::user()->email }}</small>
                            </div>
                        </div>

                        <div class="dropdown-divider"></div>

                        <a href="/profile" class="dropdown-item">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            Profil Saya
                        </a>

                        <a href="{{ route('pesanan.index') }}" class="dropdown-item">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path
                                    d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2M9 5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2" />
                            </svg>
                            Pesanan Saya
                        </a>

                        <div class="dropdown-divider"></div>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item logout-btn">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                    <polyline points="16 17 21 12 16 7" />
                                    <line x1="21" y1="12" x2="9" y2="12" />
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </li>
            @else
                <li class="login-container">
                    <a href="/login">
                        <button class="login-btn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                                <polyline points="10 17 15 12 10 7" />
                                <line x1="15" y1="12" x2="3" y2="12" />
                            </svg>
                            Login
                        </button>
                    </a>
                </li>
            @endauth
        </ul>
    </nav>
</header>

<script>
    /* ==================== ENHANCED PROFILE DROPDOWN - DIPERBAIKI ==================== */
    document.addEventListener("DOMContentLoaded", () => {
        const profileToggle = document.getElementById("profileToggle");
        const dropdownMenu = document.getElementById("dropdownMenu");

        if (profileToggle && dropdownMenu) {
            // Fungsi untuk menyesuaikan posisi dropdown jika perlu
            function adjustDropdownPosition() {
                if (dropdownMenu.classList.contains('show')) {
                    const rect = dropdownMenu.getBoundingClientRect();
                    const viewportHeight = window.innerHeight;

                    // Jika dropdown akan keluar dari bawah viewport (hanya untuk desktop)
                    if (window.innerWidth > 900 && rect.bottom > viewportHeight) {
                        // Atur ke posisi di atas
                        dropdownMenu.style.top = 'auto';
                        dropdownMenu.style.bottom = '100%';
                        dropdownMenu.style.marginBottom = '15px';
                        dropdownMenu.style.marginTop = '0';

                        // Sesuaikan panah
                        dropdownMenu.style.setProperty('--arrow-top', 'auto');
                        dropdownMenu.style.setProperty('--arrow-bottom', '-8px');
                        dropdownMenu.querySelector('.dropdown-menu::before')?.style.setProperty('top', 'auto');
                        dropdownMenu.querySelector('.dropdown-menu::before')?.style.setProperty('bottom',
                            '-8px');
                    } else {
                        // Reset ke posisi normal
                        dropdownMenu.style.top = 'calc(100% + 10px)';
                        dropdownMenu.style.bottom = 'auto';
                        dropdownMenu.style.marginBottom = '0';
                        dropdownMenu.style.marginTop = '5px';

                        // Reset panah
                        dropdownMenu.style.setProperty('--arrow-top', '-8px');
                        dropdownMenu.style.setProperty('--arrow-bottom', 'auto');
                    }
                }
            }

            // Toggle dropdown dengan animasi
            profileToggle.addEventListener("click", (e) => {
                e.stopPropagation();
                e.preventDefault();

                const isOpening = !dropdownMenu.classList.contains('show');

                if (isOpening) {
                    // Tutup dropdown lain yang mungkin terbuka
                    document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                        if (menu !== dropdownMenu) {
                            menu.classList.remove('show');
                        }
                    });
                }

                dropdownMenu.classList.toggle('show');

                // Sesuaikan posisi setelah dropdown ditampilkan
                if (dropdownMenu.classList.contains('show')) {
                    setTimeout(adjustDropdownPosition, 10);
                } else {
                    // Reset posisi saat dropdown ditutup
                    dropdownMenu.style.top = '';
                    dropdownMenu.style.bottom = '';
                    dropdownMenu.style.marginBottom = '';
                    dropdownMenu.style.marginTop = '';
                }
            });

            // Enhanced click outside handler
            document.addEventListener("click", (e) => {
                if (!dropdownMenu.contains(e.target) && !profileToggle.contains(e.target)) {
                    dropdownMenu.classList.remove('show');
                    // Reset position
                    dropdownMenu.style.top = '';
                    dropdownMenu.style.bottom = '';
                    dropdownMenu.style.marginBottom = '';
                    dropdownMenu.style.marginTop = '';
                }
            });

            // Sesuaikan posisi saat resize
            let resizeTimer;
            window.addEventListener("resize", () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    if (dropdownMenu.classList.contains('show')) {
                        adjustDropdownPosition();
                    }
                }, 250);
            });

            // Add escape key support
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && dropdownMenu.classList.contains('show')) {
                    dropdownMenu.classList.remove('show');
                    dropdownMenu.style.top = '';
                    dropdownMenu.style.bottom = '';
                    dropdownMenu.style.marginBottom = '';
                    dropdownMenu.style.marginTop = '';
                }
            });

            // Sesuaikan posisi saat scroll (untuk desktop)
            if (window.innerWidth > 900) {
                window.addEventListener('scroll', () => {
                    if (dropdownMenu.classList.contains('show')) {
                        adjustDropdownPosition();
                    }
                });
            }
        }
    });

    /* ==================== SIMPLE MOBILE MENU ==================== */
    const burgerBtn = document.getElementById("burgerBtn");
    const mobileMenu = document.getElementById("mobileMenu");
    const mobileOverlay = document.getElementById("mobileOverlay");
    const closeMenuBtn = document.getElementById("closeMenuBtn");

    function toggleMobileMenu() {
        const isOpening = !mobileMenu.classList.contains("open");

        // Burger tidak berubah menjadi X - hanya toggle menu
        burgerBtn.classList.toggle("active");
        mobileMenu.classList.toggle("open");
        mobileOverlay.classList.toggle("active");

        // Tutup dropdown profile jika terbuka
        const dropdownMenu = document.getElementById("dropdownMenu");
        if (dropdownMenu && dropdownMenu.classList.contains('show')) {
            dropdownMenu.classList.remove('show');
        }

        // Prevent body scroll when menu is open
        document.body.style.overflow = isOpening ? "hidden" : "";

        // Tambah efek smooth
        if (isOpening) {
            mobileMenu.style.animation = "none";
            setTimeout(() => {
                mobileMenu.style.animation = "";
            }, 10);
        }
    }

    // Fungsi untuk menutup mobile menu
    function closeMobileMenu() {
        mobileMenu.classList.remove("open");
        mobileOverlay.classList.remove("active");
        burgerBtn.classList.remove("active");
        document.body.style.overflow = "";
    }

    // Event listener untuk burger button
    if (burgerBtn && mobileMenu) {
        burgerBtn.onclick = (e) => {
            e.stopPropagation();
            e.preventDefault();
            toggleMobileMenu();
        };
    }

    // Event listener untuk close button
    if (closeMenuBtn) {
        closeMenuBtn.onclick = () => {
            closeMobileMenu();
        };
    }

    // Event listener untuk overlay (klik di luar menu)
    if (mobileOverlay) {
        mobileOverlay.onclick = () => {
            closeMobileMenu();
        };
    }

    // Event listener untuk klik di luar menu mobile
    document.addEventListener('click', (e) => {
        // Jika menu terbuka dan yang diklik bukan bagian dari menu atau burger button
        if (mobileMenu.classList.contains('open') &&
            !mobileMenu.contains(e.target) &&
            !burgerBtn.contains(e.target)) {
            closeMobileMenu();
        }
    });

    // Close menu when clicking a link inside menu
    document.querySelectorAll('.mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            closeMobileMenu();
        });
    });

    // Close menu on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (mobileMenu.classList.contains('open')) {
                closeMobileMenu();
            }

            // Juga tutup dropdown profile jika terbuka
            const dropdownMenu = document.getElementById("dropdownMenu");
            if (dropdownMenu && dropdownMenu.classList.contains('show')) {
                dropdownMenu.classList.remove('show');
            }
        }
    });

    /* ==================== SEARCH BAR ENHANCEMENT ==================== */
    const searchInput = document.querySelector('.search-input');
    if (searchInput) {
        // Focus animation
        searchInput.addEventListener('focus', function() {
            this.parentElement.parentElement.classList.add('focused');
        });

        searchInput.addEventListener('blur', function() {
            this.parentElement.parentElement.classList.remove('focused');
        });

        // Add keyboard shortcut
        document.addEventListener('keydown', (e) => {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                searchInput.focus();
            }
        });
    }

    /* ==================== SCROLL EFFECT ==================== */
    let lastScroll = 0;
    window.addEventListener('scroll', () => {
        const header = document.querySelector('header');
        const currentScroll = window.pageYOffset;

        if (currentScroll > 50) {
            header.classList.add('shadow-sm');
            header.classList.add('glass-effect');
        } else {
            header.classList.remove('shadow-sm');
            header.classList.remove('glass-effect');
        }

        lastScroll = currentScroll;
    });

    /* ==================== RESIZE HANDLER ==================== */
    // Tutup semua menu saat resize
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            // Tutup mobile menu jika lebar layar > 900px
            if (window.innerWidth > 900) {
                closeMobileMenu();
            }

            // Tutup dropdown profile
            const dropdownMenu = document.getElementById("dropdownMenu");
            if (dropdownMenu && dropdownMenu.classList.contains('show')) {
                dropdownMenu.classList.remove('show');
                dropdownMenu.style.top = '';
                dropdownMenu.style.bottom = '';
                dropdownMenu.style.marginBottom = '';
                dropdownMenu.style.marginTop = '';
            }
        }, 250);
    });
</script>
