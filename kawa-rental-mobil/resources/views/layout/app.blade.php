<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'KAWA kawa Mobil')</title>

    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
</head>
<body>
    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const profileToggle = document.getElementById("profileToggle");
            const dropdownMenu = document.getElementById("dropdownMenu");

            if (profileToggle && dropdownMenu) {
                profileToggle.addEventListener("click", function (e) {
                    e.stopPropagation();
                    dropdownMenu.style.display =
                        dropdownMenu.style.display === "block" ? "none" : "block";
                });

                document.addEventListener("click", function () {
                    dropdownMenu.style.display = "none";
                });
            }
        });
    </script>
</body>
</html>
