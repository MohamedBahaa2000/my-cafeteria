<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My Cafeteria')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">My Cafeteria</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item"><a href="{{ route('shop') }}" class="nav-link">🏪 Shop</a></li>
                        <li class="nav-item"><a href="{{ route('cart.view') }}" class="nav-link">🛒 Cart</a></li>
                        <li class="nav-item"><a href="{{ route('myorders.index') }}" class="nav-link">🧾 My Orders</a></li>
                        
                       @if(auth()->user()->is_admin)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">👥 Users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('products.index') }}">📦 Products</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
    </li>
@endif
                    @endauth
                </ul>
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <span class="navbar-text text-white me-3">👋 {{ auth()->user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-sm btn-outline-light">Logout</button>
                            </form>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        © {{ date('Y') }} Cafeteria — All rights reserved.
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
