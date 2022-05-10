<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Vegefoods</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('shop') }}" id="dropdown04" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Shop</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="{{ route('shop') }}">Shop</a>
                        @if(Auth::check())
                        <a class="dropdown-item" href="{{ route('product.favorite') }}">Favorite</a>
                        @endif
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Contact & Support</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="{{ route('about') }}">About</a>
                        <a class="dropdown-item" href="{{ route('contact') }}">Contact</a>
                        <a class="dropdown-item" href="{{ route('blog.single') }}">Blog Single</a>
                        <a class="dropdown-item" href="{{ route('cart') }}">Cart</a>
                        <a class="dropdown-item" href="{{ route('checkout') }}">Checkout</a>
                    </div>
                </li>
                <li class="nav-item"><a href="{{ route('blog') }}" class="nav-link">Blog</a></li>
                @if (Auth::user())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            @if(Auth::user()->role == 'admin')
                            <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('profile', Auth::user()->slug) }}">Profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>


                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">
                            Login
                        </a>
                    </li>
                    <li class="nav-item cta-colored active">
                        <a href="{{ route('register') }}" class="nav-link">
                            Register
                        </a>
                    </li>
                @endif
                <li class="nav-item cta cta-colored"><a href="cart.html" class="nav-link"><span
                            class="icon-shopping_cart"></span>[0]</a></li>
            </ul>
        </div>
    </div>
</nav>
