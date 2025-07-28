<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>DISKOMINFO SP - PEMERINTAH KABUPATEN MURUNG RAYA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }

        .navbar {
            position: fixed;
            width: 100%;
            top: 0;
            padding: 1.5rem 0;
            font-size: 1.1rem;
            background: linear-gradient(rgba(8, 7, 90, 0.9));
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.4s ease-in-out;
            z-index: 100;
        }

        .navbar.scrolled {
            padding: 0.73rem 0;
        }

        .navbar.scrolled .nav-link {
            font-size: 0.95rem;
            padding: 0.25rem 0.5rem;
        }

        .navbar.scrolled .navbar-brand {
            font-size: 1.2rem;
        }

        .navbar .nav-link,
        .navbar .navbar-brand {
            transition: all 0.3s ease-in-out;
        }

        .navbar-brand {
            font-size: 1.6rem;
            font-weight: 700;
            color: #ffffff !important;
        }

        .nav-link {
            position: relative;
            font-size: 1.1rem;
            font-weight: 500;
            color: #ffffff !important;
            padding: 0.5rem 0.75rem;
            transition: color 0.3s ease;
        }

        .nav-link:hover,
        .dropdown-item:hover {
            color: #ff6600 !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 4px;
            transform: translateX(-50%) scaleX(0);
            transform-origin: center;
            width: 60%;
            height: 3px;
            background: linear-gradient(90deg, #ff6600, #ffdd57);
            border-radius: 2px;
            box-shadow: 0 0 6px rgba(255, 193, 7, 0.6);
            transition: transform 0.35s ease, opacity 0.35s ease;
            opacity: 0;
            pointer-events: none;
        }

        .nav-link:hover:not(.dropdown-toggle)::after,
        .nav-link.active-dropdown:not(.dropdown-toggle)::after {
            transform: translateX(-50%) scaleX(1);
            opacity: 1;
        }

        .nav-link.active-dropdown:not(.dropdown-toggle)::after {
            width: 100%;
        }

        .nav-link.dropdown-toggle {
            cursor: pointer;
        }

        .nav-item.dropdown {
            position: relative;
        }

        .small-indicator {
            font-size: 0.60rem;
            vertical-align: middle;
            transition: transform 0.3s ease, opacity 0.3s ease;
            display: inline-block;
            opacity: 0.7;
            font-weight: bold;
            transform: rotate(0deg);
            transform-origin: center;
        }

        .nav-link.dropdown-toggle.active-dropdown .small-indicator {
            transform: rotate(180deg);
            opacity: 1;
        }

        .dropdown-global {
            top: 100%;
            position: absolute;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 0;
            padding: 1rem 1.5rem;
            min-width: 220px;
            opacity: 0;
            pointer-events: none;
            transform-origin: top center;
            transform: scaleY(0.8) translateY(-10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .dropdown-global.show {
            display: block;
            opacity: 1;
            transform: scaleY(1) translateY(0);
            pointer-events: auto;
        }

        .dropdown-global::before {
            content: '';
            position: absolute;
            top: -12px;
            left: 25%;
            width: 50%;
            height: 12px;
        }

        .dropdown-global::after {
            content: '';
            position: absolute;
            top: -10px;
            left: 33px;
            border-width: 0 8px 8px 8px;
            border-style: solid;
            border-color: transparent transparent rgba(255, 255, 255, 0.95) transparent;
            filter: drop-shadow(0 2px 2px rgba(0, 0, 0, 0.1));
            transition: opacity 0.2s ease;
            transform: translateX(-50%);
        }

        .dropdown-global a {
            font-size: 0.95rem;
            line-height: 1.2;
            display: block;
            width: 100%;
            color: #003366;
            font-weight: 500;
            text-decoration: none;
            border-left: 3px solid transparent;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: border-color 0.3s ease, color 0.3s ease, background-color 0.3s ease;
        }

        .dropdown-global a:hover {
            border-left: 3px solid #0056b3;
            background-color: rgba(0, 86, 179, 0.05);
            color: #0056b3;
        }

        .theme-toggle {
            display: flex;
            align-items: center;
            cursor: pointer;
            background-color: #ffffff33;
            border-radius: 30px;
            padding: 4px 10px;
            transition: background 0.3s ease;
            position: relative;
            width: 90px;
            height: 36px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .theme-toggle:hover {
            background-color: #ffffff55;
        }

        .toggle-switch {
            display: flex;
            align-items: center;
            width: 100%;
            position: relative;
            transition: transform 0.4s ease;
        }

        .theme-toggle i {
            font-size: 1.2rem;
            transition: transform 0.4s ease;
        }

        .theme-toggle span {
            margin-left: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            white-space: nowrap;
            color: #fff;
            transition: transform 0.4s ease, opacity 0.4s ease;
        }

        .theme-toggle.active i {
            transform: translateX(48px) rotate(360deg);
        }

        .theme-toggle.active span {
            transform: translateX(-50px);
            opacity: 0;
        }

        .theme-toggle.active::after {
            content: "Light";
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #fff;
            font-size: 0.9rem;
            font-weight: 600;
            opacity: 1;
            transition: opacity 0.4s ease;
        }

        body.dark-mode {
            background-color: #121212;
            color: #f1f1f1;
        }

        body.dark-mode .navbar {
            background: rgba(18, 18, 18, 0.95);
        }

        body.dark-mode .nav-link {
            color: #ffffff !important;
        }

        body.dark-mode .nav-link:hover {
            color: #ffdd57 !important;
        }

        body.dark-mode .dropdown-global {
            background-color: rgba(30, 30, 30, 0.95);
        }

        body.dark-mode .dropdown-global a {
            color: #ffffff;
        }

        body.dark-mode .dropdown-global a:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: #ffdd57;
        }

        body.dark-mode .custom-footer {
            background-color: #1a1a1a;
        }

        body.dark-mode .footer-link {
            color: #bbbbbb;
        }

        body.dark-mode .footer-link:hover {
            color: #ffdd57;
        }

        #backToTopBtn {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 999;
            width: 40px;
            height: 40px;
            background: transparent;
            border: none;
            border-radius: 50%;
            box-shadow: none;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transform: scale(0.8);
            transition: all 0.3s ease;
            padding: 0;
        }

        #backToTopBtn.show {
            opacity: 1;
            visibility: visible;
            transform: scale(1);
        }

        #backToTopBtn:hover i {
            transform: translate(-50%, -50%) scale(1.15);
            color: #ff6600;
        }

        #backToTopBtn i {
            font-size: 1.6rem;
            color: #ff6600;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        #backToTopBtn svg.progress-circle {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 60px;
            height: 60px;
            transform: translate(-50%, -50%) rotate(-90deg);
            z-index: 1;
            pointer-events: none;
        }

        .custom-footer {
            background-color: #08075a;
            color: white;
            font-family: 'Inter', sans-serif;
            position: relative;
            overflow: hidden;
            z-index: 1;
            font-size: 0.95rem;
        }

        .custom-footer::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 500px;
            height: 100%;
            background-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg"><g fill="none" stroke="%23004bff" stroke-opacity="0.3" stroke-width="1"><path d="M500 0 Q250 250 500 500"/><path d="M480 0 Q250 250 480 500"/><path d="M460 0 Q250 250 460 500"/><path d="M440 0 Q250 250 440 500"/></g></svg>');
            background-repeat: no-repeat;
            background-size: cover;
            opacity: 0.5;
            pointer-events: none;
            z-index: -1;
        }

        .footer-link {
            color: #ffffff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            text-decoration: underline;
            color: #ff6600;
        }

        .footer-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            margin: 2rem 0 1rem;
        }

        .footer-bottom {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .footer-main {
            padding-top: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .footer-left,
        .footer-right {
            flex: 1;
            min-width: 260px;
        }

        .footer-right {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .footer-left {
            line-height: 1.4;
        }

        .social-icons {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .icon-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border: 1px solid white;
            border-radius: 12px;
            background-color: transparent;
            font-size: 1.25rem;
            transition: all 0.3s ease;
            color: white;
        }

        .icon-circle:hover {
            background-color: white;
            transform: scale(1.05);
        }

        .facebook-icon {
            font-family: Arial, sans-serif;
            font-weight: bold;
            font-size: 1.6rem;
            text-transform: lowercase;
            letter-spacing: -0.5px;
            color: white;
            border: 1px solid white;
            border-radius: 12px;
            width: 48px;
            height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: transparent;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .facebook-icon:hover {
            color: #3b5998;
            border: none;
            transform: scale(1.05);
        }

        .icon-circle i {
            transition: color 0.3s ease;
        }

        .custom-footer .social-icons a:nth-child(1):hover i {
            color: #e1306c;
        }

        .custom-footer .social-icons a:nth-child(3):hover i {
            color: #1da1f2;
        }

        .custom-footer .social-icons a:nth-child(4):hover i {
            color: #000000;
        }

        .custom-footer .social-icons a:nth-child(5):hover i {
            color: #ff0000;
        }
    </style>
    @stack('styles')
</head>

<body>
    <!-- Tombol Kembali ke Atas -->
    <button onclick="scrollToTop()" id="backToTopBtn" title="Kembali ke atas" aria-label="Kembali ke atas">
        <svg class="progress-circle" viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="30" stroke="#ffffff33" stroke-width="6" fill="none" />
            <circle id="progressRing" cx="50" cy="50" r="30" stroke="#ff6600" stroke-width="3"
                fill="none" stroke-linecap="round" stroke-dasharray="283" stroke-dashoffset="283" />
        </svg>
        <i class="bi bi-arrow-up-short"></i>
    </button>

    <!-- Navbar -->
    @include('frontend.partial.navbar')

    <!-- Main content -->
    <main style="padding-top: calc(1.5rem + 4rem);">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('frontend.partial.footer')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
        // Tampilkan tombol saat scroll ke bawah
        window.onscroll = function() {
            const btn = document.getElementById("backToTopBtn");
            const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;

            const progress = scrollTop / scrollHeight;
            const circle = document.getElementById("progressRing");
            const circumference = 2 * Math.PI * 30;
            const offset = circumference * (1 - progress);

            if (btn) {
                btn.classList.toggle('show', scrollTop > 300);
            }

            if (circle) {
                circle.style.strokeDashoffset = offset;
            }
        };

        // Fungsi scroll ke atas
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Fungsi Dark Mode
        document.addEventListener("DOMContentLoaded", function() {
            const toggle = document.getElementById("darkModeToggle");
            const icon = document.getElementById("darkIcon");

            // Cek preferensi sebelumnya
            if (localStorage.getItem("theme") === "dark") {
                document.body.classList.add("dark-mode");
                toggle.classList.add("active");
                icon.classList.replace("bi-moon-stars-fill", "bi-sun-fill");
            }

            toggle.addEventListener("click", () => {
                const isDark = document.body.classList.toggle("dark-mode");
                toggle.classList.toggle("active", isDark);

                // Ganti ikon
                icon.classList.toggle("bi-moon-stars-fill", !isDark);
                icon.classList.toggle("bi-sun-fill", isDark);

                // Simpan preferensi
                localStorage.setItem("theme", isDark ? "dark" : "light");
            });
        });

        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('scrolled', window.scrollY > 60);
        });
        document.addEventListener("DOMContentLoaded", function() {
            const items = [{
                    triggerId: 'profilMenu',
                    dropdownId: 'dropdownProfil'
                },
                {
                    triggerId: 'galeriMenu',
                    dropdownId: 'dropdownGaleri'
                }
            ];
            let timeout;

            function closeAllDropdowns() {
                items.forEach(({
                    triggerId,
                    dropdownId
                }) => {
                    document.getElementById(triggerId)?.classList.remove('active-dropdown');
                    document.getElementById(dropdownId)?.classList.remove('show');
                });
            }
            items.forEach(({
                triggerId,
                dropdownId
            }) => {
                const trigger = document.getElementById(triggerId);
                const dropdown = document.getElementById(dropdownId);

                function showDropdown() {
                    if (!trigger || !dropdown) return;
                    closeAllDropdowns();
                    dropdown.style.top = '160%';
                    dropdown.style.left = `0`;
                    dropdown.style.minWidth = `${trigger.offsetWidth}px`;
                    dropdown.style.position = 'absolute';
                    dropdown.classList.add('show');
                    trigger.classList.add('active-dropdown');
                }

                function hideDropdown() {
                    dropdown.classList.remove('show');
                    trigger.classList.remove('active-dropdown');
                }
                if (window.innerWidth >= 992) {
                    trigger.addEventListener('mouseenter', () => {
                        clearTimeout(timeout);
                        showDropdown();
                    });
                    trigger.addEventListener('mouseleave', () => {
                        timeout = setTimeout(hideDropdown, 200);
                    });
                    dropdown.addEventListener('mouseenter', () => clearTimeout(timeout));
                    dropdown.addEventListener('mouseleave', () => {
                        timeout = setTimeout(hideDropdown, 200);
                    });
                }
                trigger.addEventListener('click', function(e) {
                    if (window.innerWidth < 992) {
                        e.preventDefault();
                        const isOpen = dropdown.classList.contains('show');
                        closeAllDropdowns(); // Tutup semua

                        if (!isOpen) {
                            dropdown.classList.add('show');
                            trigger.classList.add('active-dropdown');
                        } else {
                            dropdown.classList.remove('show');
                            trigger.classList.remove('active-dropdown');
                        }
                    }
                });
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
