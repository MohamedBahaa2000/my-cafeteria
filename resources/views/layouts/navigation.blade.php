<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">My Cafeteria</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

               @auth
    <li class="nav-item">
        <a class="nav-link" href="{{ route('shop') }}">🏪 Shop</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('cart.view') }}">🛒 Cart</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('myorders.index') }}">🧾 My Orders</a>
    </li>

    @if(auth()->user()->is_admin)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
        </li>
    @endif
@endauth

            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item">
                        <span class="navbar-text text-white me-3">
                            👤 {{ auth()->user()->name }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-sm btn-outline-light">Logout</button>
                        </form>
                    </li>
                @endauth

                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
