<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Veltro</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 10px 15px;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #495057;
        }

        .content {
            padding: 20px;
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
    <div class="d-flex">
        {{-- Sidebar --}}
        <div class="sidebar">
            <a href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                🏠 Dashboard
            </a>
            <a href="{{ route('admin.products.index') }}"
                class="{{ request()->is('admin/products*') ? 'active' : '' }}">
                📦 Produk
            </a>
            <a href="{{ route('admin.orders.index') }}" class="{{ request()->is('admin/orders*') ? 'active' : '' }}">
                🧾 Pesanan
            </a>
            <a href="{{ route('admin.report') }}" class="{{ request()->routeIs('admin.report') ? 'active' : '' }}">
                📈 Laporan
            </a>
        </div>

        {{-- Main Content --}}
        <div class="flex-grow-1 content">
            {{-- Navbar --}}
            <nav class="navbar navbar-expand navbar-light bg-white shadow-sm mb-4">
                <div class="container-fluid">
                    <span class="navbar-brand">Admin Panel - {{ config('app.name') }}</span>
                    <div class="ms-auto">
                        <span class="me-3">👤 {{ Auth::user()->name }}</span>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="btn btn-sm btn-outline-danger">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </nav>

            {{-- Page Content --}}
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>