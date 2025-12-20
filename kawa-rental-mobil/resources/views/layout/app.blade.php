<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>@yield('title', 'KAWA kawa Mobil')</title>

    <link rel="stylesheet" href="{{ secure_asset('css/global.css') }}">

    @stack('styles')

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Custom CSS -->
    <style>
        /* Reset untuk mencegah overflow horizontal */
        html, body {
            overflow-x: hidden;
            width: 100%;
            position: relative;
        }

        /* Container untuk mencegah overflow */
        .page-container {
            width: 100%;
            overflow-x: hidden;
            position: relative;
        }

        /* Floating WhatsApp Button - Fixed Position */
        .floating-whatsapp {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            /* Pastikan z-index tinggi */
        }

        .float-btn {
            background: #25D366;
            color: white;
            padding: 15px 20px;
            border-radius: 50px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
            transition: all 0.3s ease;
            animation: float 3s ease-in-out infinite;
            font-family: 'Inter', sans-serif;
            /* Pastikan tidak ada transform awal */
            transform: none;
            /* Mencegah overflow */
            white-space: nowrap;
            max-width: 100%;
            box-sizing: border-box;
        }

        .float-btn:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.5);
            animation: none;
        }

        .float-text {
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
            /* Mencegah text overflow */
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Float Animation */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-5px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        /* Responsive Design - dengan safe area untuk mobile */
        @media (max-width: 768px) {
            .floating-whatsapp {
                bottom: max(15px, env(safe-area-inset-bottom));
                right: max(15px, env(safe-area-inset-right));
            }

            .float-btn {
                padding: 13px 18px;
            }
        }

        @media (max-width: 576px) {
            .floating-whatsapp {
                bottom: max(12px, env(safe-area-inset-bottom));
                right: max(12px, env(safe-area-inset-right));
            }

            .float-btn {
                padding: 12px 15px;
                border-radius: 50%;
                width: 56px;
                height: 56px;
                justify-content: center;
                /* Reset untuk mobile */
                transform: none !important;
            }

            .float-text {
                display: none;
            }

            .float-btn i {
                font-size: 1.5rem;
                margin: 0;
            }

            /* Hentikan animasi saat hover di mobile */
            .float-btn:hover {
                transform: none !important;
                animation: float 3s ease-in-out infinite;
            }
        }

        /* Untuk layar yang sangat kecil */
        @media (max-width: 360px) {
            .floating-whatsapp {
                bottom: max(10px, env(safe-area-inset-bottom));
                right: max(10px, env(safe-area-inset-right));
            }

            .float-btn {
                width: 52px;
                height: 52px;
                padding: 10px;
            }

            .float-btn i {
                font-size: 1.3rem;
            }
        }

        /* Untuk tablet landscape */
        @media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
            .floating-whatsapp {
                bottom: 15px;
                right: 15px;
            }
        }

        /* Untuk menghindari conflict dengan elemen lain */
        main {
            position: relative;
            z-index: 1;
        }

        /* Fix untuk iOS Safari */
        @supports (-webkit-touch-callout: none) {
            .floating-whatsapp {
                position: -webkit-sticky;
                position: sticky;
                bottom: 20px;
                right: 20px;
                float: right;
                margin-right: 20px;
                margin-bottom: 20px;
            }
        }

        /* Utility class untuk debugging */
        .debug-border {
            border: 1px solid red;
        }
    </style>
</head>

<body>
    <div class="page-container">
        {{-- Navbar --}}
        @include('partials.navbar')

        {{-- Main Content --}}
        <main>
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('partials.footer')

        <!-- Floating WhatsApp Button -->
        <div class="floating-whatsapp" id="whatsappButton">
            <a href="https://wa.me/6282315836060" class="float-btn" target="_blank" rel="noopener noreferrer" aria-label="Chat dengan kami via WhatsApp">
                <i class="fab fa-whatsapp"></i>
                <span class="float-text">Chat dengan Kami</span>
            </a>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const profileToggle = document.getElementById("profileToggle");
            const dropdownMenu = document.getElementById("dropdownMenu");
            const whatsappButton = document.getElementById("whatsappButton");
            const floatBtn = document.querySelector('.float-btn');

            if (profileToggle && dropdownMenu) {
                profileToggle.addEventListener("click", function(e) {
                    e.stopPropagation();
                    dropdownMenu.style.display =
                        dropdownMenu.style.display === "block" ? "none" : "block";
                });

                document.addEventListener("click", function() {
                    dropdownMenu.style.display = "none";
                });
            }

            // Fix untuk WhatsApp button position
            function fixWhatsAppPosition() {
                if (!whatsappButton) return;

                // Dapatkan viewport width
                const viewportWidth = window.innerWidth || document.documentElement.clientWidth;
                const buttonRect = whatsappButton.getBoundingClientRect();
                const buttonRight = buttonRect.right;

                // Jika button melebihi viewport, fix position
                if (buttonRight > viewportWidth) {
                    const overflowAmount = buttonRight - viewportWidth;
                    whatsappButton.style.right = Math.max(10, 20 - overflowAmount) + "px";
                } else {
                    // Reset ke posisi default
                    whatsappButton.style.right = "";
                }

                // Cek jika ada horizontal scroll
                const hasHorizontalScroll = document.documentElement.scrollWidth > viewportWidth;
                if (hasHorizontalScroll) {
                    // Jika ada horizontal scroll, perbaiki layout
                    document.documentElement.style.overflowX = 'hidden';
                    document.body.style.overflowX = 'hidden';
                }
            }

            // Panggil fungsi fix saat load dan resize
            fixWhatsAppPosition();
            window.addEventListener('load', fixWhatsAppPosition);
            window.addEventListener('resize', fixWhatsAppPosition);

            // Juga panggil setelah animasi/transisi selesai
            setTimeout(fixWhatsAppPosition, 500);
            setTimeout(fixWhatsAppPosition, 1000);

            // Optimasi untuk mobile devices
            if ('ontouchstart' in window) {
                // Tambahkan event untuk touch devices
                if (floatBtn) {
                    floatBtn.addEventListener('touchstart', function(e) {
                        this.style.transform = 'scale(0.95)';
                        this.style.transition = 'transform 0.1s ease';
                    });

                    floatBtn.addEventListener('touchend', function(e) {
                        setTimeout(() => {
                            this.style.transform = '';
                            this.style.transition = '';
                        }, 150);
                    });

                    floatBtn.addEventListener('touchcancel', function(e) {
                        this.style.transform = '';
                        this.style.transition = '';
                    });
                }
            }

            // Debounce untuk resize event
            let resizeTimer;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(fixWhatsAppPosition, 250);
            });

            // Fix untuk iOS - panggil setelah semua resources loaded
            window.addEventListener('pageshow', function(event) {
                if (event.persisted) {
                    fixWhatsAppPosition();
                }
            });

            // Fix untuk browser yang support visualViewport API
            if (window.visualViewport) {
                visualViewport.addEventListener('resize', fixWhatsAppPosition);
                visualViewport.addEventListener('scroll', fixWhatsAppPosition);
            }
        });

        // Backup fix untuk case ekstrem
        window.onload = function() {
            setTimeout(function() {
                const whatsappBtn = document.querySelector('.floating-whatsapp');
                if (whatsappBtn) {
                    const viewportWidth = window.innerWidth;
                    const btnRect = whatsappBtn.getBoundingClientRect();

                    if (btnRect.right > viewportWidth) {
                        // Force reposition
                        whatsappBtn.style.position = 'fixed';
                        whatsappBtn.style.right = '10px';
                        whatsappBtn.style.bottom = '20px';
                    }
                }
            }, 100);
        };
    </script>
</body>

</html>
