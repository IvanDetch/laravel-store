<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">

        <a class="navbar-brand waves-effect" href="{{ route('index') }}">
            <img src="{{ asset('img/logo.png') }}" alt="" style="width: 50px">
        </a>

        <span class="navbar-brand waves-effect">
            <a href="{{ route('index') }}" style="color: black">Laravel-Shop</a>
        </span>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link waves-effect" href="{{ route('catalog.index') }}">Catalog</a>
                </li>
            </ul>
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link waves-effect" href="{{ route('categories.index') }}">Category</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto" style="margin-left: auto; margin-right: 0;">
                @if(Cart::count() > 0)
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="{{ route('cart.index') }}">
                            <span class="badge red z-depth-1 mr-1"> {{ Cart::count() }} </span>
                            <i class="fa fa-shopping-cart"></i>
                            <span class="clearfix d-none d-sm-inline-block">Cart</span>
                        </a>
                    </li>
                @endif
                <!-- Authentication Links -->
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
<!-- /.Navbar -->
