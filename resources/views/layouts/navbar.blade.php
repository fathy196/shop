<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #f4f4f4; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand fw-bold" href="#!" style="color: #333;">Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active fw-semibold" aria-current="page" href="{{ route('home') }}" style="color: #333;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="{{ route('aboutus') }}" style="color: #333;">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false" style="color: #333;">
                        Shop
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('products.index') }}">All Products</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                        <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Cart and Search Section (Visible Only for Authenticated Users) -->
            @auth
                <div class="d-flex align-items-center me-3">
                    <!-- Search Form -->
                    <form action="{{ route('products.search') }}" method="GET" class="d-flex me-2">
                        <input class="form-control me-2" type="search" name="query" placeholder="Search products..." aria-label="Search" required>
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>

                    <!-- Cart Button -->
                    <a href="{{ route('cart.view') }}" class="btn btn-outline-dark btn-sm position-relative">
                        <i class="bi bi-cart-fill me-1"></i>
                        Cart
                        <span class="position-absolute top-0 start-100 translate-middle badge bg-danger rounded-pill">
                            {{ auth()->user()->cartItems->count() }}
                            <span class="visually-hidden">items in cart</span>
                        </span>
                    </a>
                </div>
            @endauth

            <!-- Authentication Section -->
            <ul class="navbar-nav">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
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