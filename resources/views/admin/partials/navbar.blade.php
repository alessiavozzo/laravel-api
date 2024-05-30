<nav id="top-bar" class="navbar navbar-expand-md px-4">

    <a class="navbar-brand d-none d-md-flex align-items-center text-white home-btn" href="{{ url('/') }}">
        <i class="fa-solid fa-house"></i>
        {{-- config('app.name', 'Laravel') --}}
    </a>
    @auth
        <div class="logo-sm px-3 text-white d-flex justify-content-center align-items-center d-md-none">
            PORTFOLIO
        </div>
    @endauth

    <button id="hamburger-btn" class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse pt-2 justify-content-end" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        @auth
            <ul class="navbar-nav me-auto d-md-none">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ url('admin') }}">{{ __('Dashboard') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.projects.index') }}">{{ __('Projects') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.types.index') }}">{{ __('Types') }}</a>
                </li>
            </ul>
        @endauth


        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link text-white login-btn" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link text-white register-btn"
                            href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white auth" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a>
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

</nav>
