<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Profil Sekolah')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-blue: #2563eb;
            --secondary-red: #dc2626;
            --accent-yellow: #f59e0b;
            --light-blue: #dbeafe;
            --light-red: #fef2f2;
            --light-yellow: #fefce8;
            --dark-blue: #1e40af;
            --dark-red: #b91c1c;
            --warm-gray: #f8fafc;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
        }

        /* Global Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-primary);
        }

        /* Hero Sections */
        .hero-primary {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="80" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="60" cy="30" r="1.5" fill="rgba(255,255,255,0.1)"/></svg>');
            opacity: 0.1;
        }

        .hero-secondary {
            background: linear-gradient(135deg, var(--secondary-red) 0%, var(--dark-red) 100%);
            color: white;
            padding: 100px 0;
        }

        .hero-accent {
            background: linear-gradient(135deg, var(--accent-yellow) 0%, #d97706 100%);
            color: var(--text-primary);
            padding: 100px 0;
        }

        /* Navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        /* Navbar on scroll effect */
        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.15);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-blue) !important;
            text-decoration: none;
        }

        .brand-text {
            display: inline-block;
            vertical-align: middle;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: var(--text-primary) !important;
            transition: color 0.3s ease;
            padding: 0.75rem 1rem;
            position: relative;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary-blue) !important;
        }

        .navbar-nav .nav-link.active {
            color: var(--primary-blue) !important;
            font-weight: 600;
        }

        .navbar-nav .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background: var(--primary-blue);
            border-radius: 2px;
        }

        /* Dropdown Menu Styles */
        .dropdown-menu {
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            padding: 0.5rem 0;
            margin-top: 0.5rem;
            background: white;
            min-width: 200px;
        }

        .dropdown-item {
            padding: 0.75rem 1.5rem;
            color: var(--text-primary);
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 0;
        }

        .dropdown-item:hover {
            background: var(--light-blue);
            color: var(--primary-blue);
            transform: translateX(5px);
        }

        .dropdown-item.active {
            background: var(--primary-blue);
            color: white;
        }

        .dropdown-toggle::after {
            margin-left: 0.5rem;
            border: none;
            content: '\f145';
            font-family: 'bootstrap-icons';
            font-size: 0.8rem;
            transition: transform 0.3s ease;
        }

        .dropdown-toggle[aria-expanded="true"]::after {
            transform: rotate(180deg);
        }

        /* Navbar Toggler */
        .navbar-toggler {
            border: none;
            background: var(--primary-blue);
            color: white;
            border-radius: 8px;
            padding: 0.5rem;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.25);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='white' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .card-primary {
            border-left: 4px solid var(--primary-blue);
        }

        .card-secondary {
            border-left: 4px solid var(--secondary-red);
        }

        .card-accent {
            border-left: 4px solid var(--accent-yellow);
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--secondary-red) 0%, var(--dark-red) 100%);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(220, 38, 38, 0.3);
        }

        .btn-accent {
            background: linear-gradient(135deg, var(--accent-yellow) 0%, #d97706 100%);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .btn-accent:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
        }

        /* Statistics Cards */
        .stats-card-primary {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            color: white;
            border-radius: 15px;
        }

        .stats-card-secondary {
            background: linear-gradient(135deg, var(--secondary-red) 0%, var(--dark-red) 100%);
            color: white;
            border-radius: 15px;
        }

        .stats-card-accent {
            background: linear-gradient(135deg, var(--accent-yellow) 0%, #d97706 100%);
            color: var(--text-primary);
            border-radius: 15px;
        }

        /* Achievement Icons */
        .achievement-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .achievement-icon-primary {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
        }

        .achievement-icon-secondary {
            background: linear-gradient(135deg, var(--secondary-red) 0%, var(--dark-red) 100%);
        }

        .achievement-icon-accent {
            background: linear-gradient(135deg, var(--accent-yellow) 0%, #d97706 100%);
        }

        /* Section Titles */
        .section-title {
            position: relative;
            margin-bottom: 50px;
            color: var(--text-primary);
            font-weight: 700;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue) 0%, var(--accent-yellow) 50%, var(--secondary-red) 100%);
            border-radius: 2px;
        }

        /* Background Sections */
        .bg-warm {
            background: var(--warm-gray);
        }

        .bg-light-blue {
            background: var(--light-blue);
        }

        .bg-light-red {
            background: var(--light-red);
        }

        .bg-light-yellow {
            background: var(--light-yellow);
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            color: white;
            padding: 60px 0 30px;
        }

        .footer h5 {
            color: white;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .footer a {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--accent-yellow);
        }

        /* Social Links */
        .social-links a {
            color: white;
            margin: 0 12px;
            font-size: 1.5rem;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .social-links a:hover {
            color: var(--accent-yellow);
            transform: translateY(-3px);
        }

        /* Form Styles */
        .form-control {
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* Badge Styles */
        .badge-primary {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
        }

        .badge-secondary {
            background: linear-gradient(135deg, var(--secondary-red) 0%, var(--dark-red) 100%);
        }

        .badge-accent {
            background: linear-gradient(135deg, var(--accent-yellow) 0%, #d97706 100%);
            color: var(--text-primary);
        }

        /* Utility Classes */
        .text-primary-custom {
            color: var(--primary-blue);
        }

        .text-secondary-custom {
            color: var(--secondary-red);
        }

        .text-accent-custom {
            color: var(--accent-yellow);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Dropdown positioning fixes */
        .dropdown-menu {
            z-index: 1050;
            position: absolute;
        }

        .navbar .dropdown-menu {
            margin-top: 0;
            border-radius: 0 0 10px 10px;
        }

        /* Mobile dropdown fixes */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: white;
                border-radius: 0 0 10px 10px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                margin-top: 1rem;
                padding: 1rem;
            }

            .dropdown-menu {
                position: static;
                float: none;
                width: 100%;
                margin-top: 0;
                background-color: transparent;
                border: none;
                box-shadow: none;
                padding: 0;
                display: none;
                /* Initially hidden */
            }

            .dropdown-menu.show {
                display: block;
                /* Show when dropdown is open */
            }

            .dropdown-item {
                padding: 0.75rem 1rem;
                color: var(--text-secondary);
                border-radius: 8px;
                margin-bottom: 0.25rem;
                transition: all 0.3s ease;
            }

            .dropdown-item:hover,
            .dropdown-item:focus {
                background: var(--light-blue);
                color: var(--primary-blue);
                transform: translateX(5px);
            }

            .dropdown-item.active {
                background: var(--primary-blue);
                color: white;
            }

            /* Make dropdown toggle clickable on mobile */
            .dropdown-toggle {
                cursor: pointer;
                position: relative;
                width: 100%;
                text-align: left;
                display: block;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            .dropdown-toggle::after {
                position: absolute;
                right: 1rem;
                top: 50%;
                transform: translateY(-50%) rotate(0deg);
                transition: transform 0.3s ease;
                font-size: 0.8rem;
            }

            .dropdown-toggle[aria-expanded="true"]::after {
                transform: translateY(-50%) rotate(180deg);
            }

            /* Ensure proper spacing */
            .navbar-nav .nav-item {
                margin-bottom: 0.5rem;
            }

            .navbar-nav .dropdown .nav-link {
                padding-right: 2.5rem;
                display: block;
                width: 100%;
            }

            /* Ensure dropdown items are clickable */
            .dropdown-item {
                cursor: pointer;
                display: block;
                width: 100%;
                text-decoration: none;
                border-radius: 8px;
                transition: all 0.3s ease;
            }

            .dropdown-item:hover,
            .dropdown-item:focus {
                transform: translateX(5px);
            }

            /* Prevent accidental text selection */
            .navbar-nav {
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            .navbar-nav .nav-link {
                -webkit-user-select: text;
                -moz-user-select: text;
                -ms-user-select: text;
                user-select: text;
            }
        }

        /* Mobile Navbar Layout Fix */
        @media (max-width: 991.98px) {
            .navbar {
                padding: 0.5rem 1rem;
            }

            .navbar-brand {
                font-size: 1.1rem;
                margin-right: 0.5rem;
                flex: 1;
                min-width: 0;
                display: flex;
                align-items: center;
            }

            .brand-text {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                flex: 1;
                min-width: 0;
            }

            .navbar-toggler {
                border: none;
                background: var(--primary-blue);
                color: white;
                border-radius: 6px;
                padding: 0.375rem 0.5rem;
                margin-left: auto;
                flex-shrink: 0;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .navbar-toggler:focus {
                box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.25);
            }

            .navbar-toggler-icon {
                width: 1rem;
                height: 1rem;
            }

            /* Ensure navbar header stays horizontal */
            .navbar>.container {
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
                padding: 0;
            }

            .navbar-brand,
            .navbar-toggler {
                display: flex;
                align-items: center;
            }
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .hero-section {
                padding: 60px 0;
            }

            .navbar-brand {
                font-size: 1rem;
                max-width: calc(100vw - 80px);
            }

            .btn {
                padding: 10px 20px;
                font-size: 0.9rem;
            }

            .navbar-nav {
                margin-top: 1rem;
                border-top: 1px solid rgba(0, 0, 0, 0.1);
                padding-top: 1rem;
            }

            .navbar-nav .nav-link {
                padding: 0.5rem 0;
            }
        }

        /* Extra small screens */
        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 0.9rem;
                max-width: calc(100vw - 70px);
            }

            .navbar-toggler {
                padding: 0.25rem 0.375rem;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container d-flex align-items-center justify-content-between">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <i class="bi bi-mortarboard-fill me-2"></i>
                <span class="brand-text">{{ $settings['school_name'] ?? 'Sekolah Indonesia' }}</span>
            </a>

            <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                            href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false" id="tentang-dropdown">
                            Tentang Kami
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="tentang-dropdown">
                            <li><a class="dropdown-item {{ request()->routeIs('about') ? 'active' : '' }}"
                                    href="{{ route('about') }}">Profil Sekolah</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('teachers') ? 'active' : '' }}"
                                    href="{{ route('teachers') }}">Tenaga Pengajar</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('students') ? 'active' : '' }}"
                                    href="{{ route('students') }}">Siswa Berprestasi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false" id="akademik-dropdown">
                            Akademik
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="akademik-dropdown">
                            <li><a class="dropdown-item {{ request()->routeIs('facilities') ? 'active' : '' }}"
                                    href="{{ route('facilities') }}">Fasilitas</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('majors') ? 'active' : '' }}"
                                    href="{{ route('majors') }}">Program Studi</a></li>
                            <li><a class="dropdown-item {{ request()->routeIs('events') ? 'active' : '' }}"
                                    href="{{ route('events') }}">Kegiatan</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('news') ? 'active' : '' }}"
                            href="{{ route('news') }}">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                            href="{{ route('contact') }}">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>{{ $settings['school_name'] ?? 'Sekolah Indonesia' }}</h5>
                    <p>{{ $settings['school_description'] ?? 'Sekolah berkualitas dengan pendidikan terbaik untuk masa depan siswa.' }}
                    </p>
                    <div class="social-links">
                        <a href="{{ $settings['social_facebook'] ?? '#' }}" target="_blank"><i
                                class="bi bi-facebook"></i></a>
                        <a href="{{ $settings['social_instagram'] ?? '#' }}" target="_blank"><i
                                class="bi bi-instagram"></i></a>
                        <a href="{{ $settings['social_youtube'] ?? '#' }}" target="_blank"><i
                                class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h5>Kontak</h5>
                    <p><i
                            class="bi bi-geo-alt me-2"></i>{{ $settings['school_address'] ?? 'Alamat sekolah belum diatur' }}
                    </p>
                    <p><i class="bi bi-telephone me-2"></i>{{ $settings['school_phone'] ?? 'Telepon belum diatur' }}
                    </p>
                    <p><i class="bi bi-envelope me-2"></i>{{ $settings['school_email'] ?? 'Email belum diatur' }}</p>
                </div>
                <div class="col-md-4">
                    <h5>Tautan</h5>
                    <ul class="list-unstyled">
                        <li><a href="#tentang" class="text-white text-decoration-none">Tentang Kami</a></li>
                        <li><a href="#fasilitas" class="text-white text-decoration-none">Fasilitas</a></li>
                        <li><a href="#guru" class="text-white text-decoration-none">Tenaga Pengajar</a></li>
                        <li><a href="#berita" class="text-white text-decoration-none">Berita & Pengumuman</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} {{ $settings['school_name'] ?? 'Sekolah Indonesia' }}.
                    All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        // Navbar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.querySelector('.navbar');

            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Handle mobile dropdown menus
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const dropdownMenu = this.nextElementSibling;
                    const isExpanded = this.getAttribute('aria-expanded') === 'true';

                    // On mobile, always handle dropdown manually
                    if (window.innerWidth < 992) {
                        // Close all other dropdowns first
                        document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                            if (menu !== dropdownMenu) {
                                menu.classList.remove('show');
                                const otherToggle = menu.previousElementSibling;
                                if (otherToggle && otherToggle !== this) {
                                    otherToggle.setAttribute('aria-expanded', 'false');
                                }
                            }
                        });

                        // Toggle current dropdown
                        if (isExpanded) {
                            dropdownMenu.classList.remove('show');
                            this.setAttribute('aria-expanded', 'false');
                        } else {
                            dropdownMenu.classList.add('show');
                            this.setAttribute('aria-expanded', 'true');
                        }
                    }
                    // On desktop, let Bootstrap handle it
                });

                // Prevent Bootstrap dropdown on mobile
                if (window.innerWidth < 992) {
                    toggle.removeAttribute('data-bs-toggle');
                }
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                        menu.classList.remove('show');
                        const toggle = menu.previousElementSibling;
                        if (toggle) {
                            toggle.setAttribute('aria-expanded', 'false');
                        }
                    });
                }
            });

            // Close mobile menu when clicking a nav link
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link:not(.dropdown-toggle)');
            const navbarCollapse = document.querySelector('.navbar-collapse');

            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 992 && navbarCollapse.classList.contains('show')) {
                        const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                            hide: true
                        });
                    }
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

                if (window.innerWidth >= 992) {
                    // Reset mobile dropdowns on desktop
                    document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                        menu.classList.remove('show');
                        const toggle = menu.previousElementSibling;
                        if (toggle) {
                            toggle.setAttribute('aria-expanded', 'false');
                        }
                    });

                    // Re-enable Bootstrap dropdown on desktop
                    dropdownToggles.forEach(toggle => {
                        toggle.setAttribute('data-bs-toggle', 'dropdown');
                    });
                } else {
                    // Disable Bootstrap dropdown on mobile
                    dropdownToggles.forEach(toggle => {
                        toggle.removeAttribute('data-bs-toggle');
                    });
                }
            });

            // Initialize mobile dropdowns on page load
            if (window.innerWidth < 992) {
                document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
                    toggle.removeAttribute('data-bs-toggle');
                });
            }

            // Add fade-in animation to sections
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in-up');
                    }
                });
            }, observerOptions);

            // Observe all sections
            document.querySelectorAll('section').forEach(section => {
                observer.observe(section);
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
