<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Veltro') }}</title>

    <!-- Bootstrap & Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9f9f9;
        }

        nav.navbar {
            transition: box-shadow .3s;
        }

        nav.navbar.scrolled {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar .nav-link.active {
            font-weight: 600;
            color: #0d6efd !important;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .card {
            border-radius: 12px;
        }

        .btn {
            border-radius: 8px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .alert {
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('homepage') }}">
                {{ config('app.name', 'Veltro') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse w-100 flex-wrap" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('homepage') ? 'active' : '' }}"
                            href="{{ route('homepage') }}">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}"
                            href="{{ route('products.index') }}">
                            Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.best-sellers') ? 'active' : '' }}"
                            href="{{ route('products.best-sellers') }}">
                            🔥 Terlaris
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                            href="{{ route('contact') }}">
                            Kontak
                        </a>
                    </li>
                </ul>

                <form class="d-flex me-3" action="{{ route('products.search') }}" method="GET">
                    <input class="form-control form-control-sm me-2" type="search" name="q" placeholder="Cari produk..."
                        value="{{ request('q') }}">
                    <button class="btn btn-sm btn-outline-secondary" type="submit">Cari</button>
                </form>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cart.index') ? 'active' : '' }}"
                            href="{{ route('cart.index') }}">
                            🛒 Keranjang
                            @php $cartCount = session('cart') ? count(session('cart')) : 0; @endphp
                            @if($cartCount > 0)
                                <span class="badge bg-danger">{{ $cartCount }}</span>
                            @endif
                        </a>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('order.history') }}">Riwayat</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div style="margin-top: 80px;"></div> <!-- Spacer for sticky navbar -->

    <div class="container mt-3">
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif
    </div>

    <main class="py-4">
        <div class="container-sm px-4">
            @yield('content')
        </div>
    </main>

    <footer class="bg-dark text-white py-5 mt-5 shadow-sm">
        <div class="container text-center">
            <p class="mb-1">&copy; {{ date('Y') }} <strong>Veltro</strong>. Semua Hak Dilindungi.</p>
            <div class="mb-2">
                <a href="https://instagram.com/veltro.official" target="_blank" class="text-white mx-2"><i
                        class="bi bi-instagram"></i></a>
                <a href="https://facebook.com/veltro.official" target="_blank" class="text-white mx-2"><i
                        class="bi bi-facebook"></i></a>
                <a href="https://wa.me/6281234567890" target="_blank" class="text-white mx-2"><i
                        class="bi bi-whatsapp"></i></a>
            </div>
            <p class="mb-0">
                <a href="{{ route('contact') }}" class="text-white text-decoration-underline">Hubungi Kami</a>
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('nav.navbar');
            if (window.scrollY > 30) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>