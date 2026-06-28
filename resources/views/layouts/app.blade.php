<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom Theme CSS -->
    <style>
        :root {
            --cedila-navy: #1a1a2e;
            --cedila-title: var(--cedila-navy);
            --cedila-bg: #f8f9fa;
            --cedila-card: #ffffff;
            --cedila-text: #333333;
        }
        [data-bs-theme="dark"] {
            --cedila-bg: #121212;
            --cedila-card: #1e1e1e;
            --cedila-text: #e0e0e0;
            --cedila-title: #ffffff;
            --bs-body-bg: var(--cedila-bg);
            --bs-body-color: var(--cedila-text);
        }
        [data-bs-theme="dark"] .navbar {
            background-color: var(--cedila-card) !important;
            border-bottom: 1px solid #333 !important;
        }
        [data-bs-theme="dark"] .navbar-brand, [data-bs-theme="dark"] .nav-link {
            color: #ffffff !important;
        }
        [data-bs-theme="dark"] .card {
            border-color: #333 !important;
        }
        [data-bs-theme="dark"] .bg-white {
            background-color: var(--cedila-card) !important;
        }
        [data-bs-theme="dark"] .bg-light {
            background-color: #2b2b2b !important;
        }
        [data-bs-theme="dark"] .text-dark {
            color: #ffffff !important;
        }
        [data-bs-theme="dark"] .text-muted {
            color: #adb5bd !important;
        }
        [data-bs-theme="dark"] .btn-outline-primary {
            color: #ffd700;
            border-color: #ffd700;
        }
        [data-bs-theme="dark"] .btn-outline-primary:hover {
            background-color: #ffd700;
            color: #121212;
        }
        [data-bs-theme="dark"] .btn-primary {
            background-color: #ffd700;
            border-color: #ffd700;
            color: #121212;
            font-weight: bold;
        }
        [data-bs-theme="dark"] .btn-primary:hover {
            background-color: #e6c200;
            border-color: #e6c200;
            color: #121212;
        }
        body {
            background-color: var(--cedila-bg);
            color: var(--cedila-text);
            font-family: 'Nunito', sans-serif;
        }
        .navbar {
            background-color: var(--cedila-card) !important;
            border-bottom: 1px solid #e0e0e0;
        }
        .navbar-brand, .nav-link {
            color: var(--cedila-navy) !important;
            font-weight: 600;
        }
        .nav-link:hover {
            color: #666 !important;
        }
        .card {
            background-color: var(--cedila-card);
            border: 1px solid #e0e0e0;
            color: var(--cedila-text);
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .btn-primary {
            background-color: var(--cedila-navy);
            border-color: var(--cedila-navy);
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #2a2a4a;
            border-color: #2a2a4a;
        }
        .text-primary {
            color: var(--cedila-navy) !important;
        }
        
        /* Card Hover Effects */
        .hover-shadow-lg {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-shadow-lg:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
        }
        .menu-card-wrapper .card-img-top {
            transition: transform 0.5s ease;
        }
        .menu-card-wrapper:hover .card-img-top {
            transform: scale(1.08);
        }
        
        .logo-circle {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            object-fit: cover;
            padding: 3px;
            background: linear-gradient(135deg, #28a745 0%, #ffc107 50%, #dc3545 100%);
        }
    </style>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Check for saved theme preference or use system preference
        const storedTheme = localStorage.getItem('theme');
        const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        const currentTheme = storedTheme || systemTheme;
        
        if (currentTheme === 'dark') {
            document.documentElement.setAttribute('data-bs-theme', 'dark');
        }
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="CEDILA Logo" class="me-2 logo-circle shadow-sm">
                    <span class="fw-bold" style="background: linear-gradient(135deg, #28a745, #ffc107, #dc3545); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-size: 1.4rem; letter-spacing: 1px;">
                        CEDILA FAMILLY
                    </span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        @if(!request()->routeIs('accueil'))
                        <li class="nav-item me-3">
                            <a class="nav-link" href="{{ route('accueil') }}">Accueil</a>
                        </li>
                        @endif
                        
                        @if(!request()->routeIs('bar.*'))
                        <li class="nav-item me-3">
                            <a class="nav-link" href="{{ route('bar.accueil') }}">Le Bar</a>
                        </li>
                        @endif
                        
                        @if(!request()->routeIs('restaurant.*'))
                        <li class="nav-item me-3">
                            <a class="nav-link" href="{{ route('restaurant.accueil') }}">Restaurant</a>
                        </li>
                        @endif
                        
                        @auth
                            @if(request()->routeIs('restaurant.*'))
                            <li class="nav-item my-2 my-md-0">
                                <a class="btn btn-primary fw-bold shadow-sm" href="#" data-bs-toggle="modal" data-bs-target="#globalReservationModal">
                                    <i class="fa-regular fa-calendar-check me-1"></i> Réserver une table
                                </a>
                            </li>
                            @endif
                        @endauth

                        <!-- Dark Mode Toggle -->
                        <li class="nav-item me-3 d-flex align-items-center">
                            <button id="darkModeToggle" class="btn btn-outline-secondary btn-sm rounded-circle" style="width: 36px; height: 36px;">
                                <i class="fa-solid fa-moon"></i>
                            </button>
                        </li>

                        <!-- Auth Links -->
                        @guest
                            <li class="nav-item mt-2 mt-md-0 ms-md-3">
                                <a class="btn btn-dark fw-bold px-4 rounded-pill shadow-sm" href="{{ route('login') }}">
                                    <i class="fa-solid fa-user me-1"></i> Connexion
                                </a>
                            </li>
                        @else
                            <li class="nav-item mt-2 mt-md-0 ms-md-3">
                                <a class="btn btn-danger fw-bold px-4 rounded-pill shadow-sm" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-power-off me-1"></i> Déconnexion
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Modal Global Réservation -->
    <div class="modal fade" id="globalReservationModal" tabindex="-1" aria-labelledby="globalReservationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark" id="globalReservationModalLabel"><i class="fa-regular fa-calendar-check text-primary me-2"></i> Réserver une table</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('reserve.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Personnes</label>
                            <input type="number" name="guests_count" class="form-control form-control-lg bg-light border-0" required min="1" value="2">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Date</label>
                            <input type="date" name="reservation_date" class="form-control form-control-lg bg-light border-0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Heure</label>
                            <input type="time" name="reservation_time" class="form-control form-control-lg bg-light border-0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Préférences (Optionnel)</label>
                            <textarea name="notes" class="form-control bg-light border-0" rows="2" placeholder="Ex: table près de la fenêtre"></textarea>
                        </div>
                        @auth
                            <button type="submit" class="btn btn-primary btn-lg w-100 mt-2 fw-bold rounded-pill">Valider la réservation</button>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg w-100 mt-2 fw-bold rounded-pill">Se connecter pour réserver</a>
                        @endauth
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('darkModeToggle');
            const icon = toggleBtn.querySelector('i');
            
            // Set initial icon state based on current theme
            if (document.documentElement.getAttribute('data-bs-theme') === 'dark') {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }
            
            toggleBtn.addEventListener('click', () => {
                const currentTheme = document.documentElement.getAttribute('data-bs-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                document.documentElement.setAttribute('data-bs-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                
                if (newTheme === 'dark') {
                    icon.classList.remove('fa-moon');
                    icon.classList.add('fa-sun');
                } else {
                    icon.classList.remove('fa-sun');
                    icon.classList.add('fa-moon');
                }
            });
        });
    </script>
</body>
</html>
