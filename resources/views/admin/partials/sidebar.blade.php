<aside id="left-sidebar" class="w-auto h-100 d-flex flex-column text-white position-relative d-none d-md-flex">
    {{-- title: top --}}
    <div class="side-header px-5 py-2 d-flex justify-content-center align-items-center">
        PORTFOLIO
    </div>

    {{-- opntions list --}}
    <ul class="navbar-nav mb-auto pt-5">
        {{-- dashboard --}}
        <li class="nav-item px-4 ">
            <a class="nav-link d-flex gap-3 align-items-center" href="{{ url('admin') }}">
                <i class="fa-solid fa-palette"></i>
                {{ __('Dashboard') }}
            </a>
        </li>
        {{-- projects --}}
        <li class="nav-item px-4">
            <a class="nav-link d-flex gap-3 align-items-center" href="{{ route('admin.projects.index') }}">
                <i class="fa-solid fa-swatchbook"></i>
                {{ __('Projects') }}
            </a>
        </li>
        {{-- types --}}
        <li class="nav-item px-4">
            <a class="nav-link d-flex gap-3 align-items-center" href="{{ route('admin.types.index') }}">
                <i class="fa-solid fa-list"></i>
                {{ __('Types') }}
            </a>
        </li>
        {{-- technologies --}}
        <li class="nav-item px-4">
            <a class="nav-link d-flex gap-3 align-items-center" href="{{ route('admin.technologies.index') }}">
                <i class="fa-solid fa-microchip"></i>
                {{ __('Technologies') }}
            </a>
        </li>

    </ul>
    <hr>
    {{-- profile list --}}
    <ul class="navbar-nav pb-3">
        {{-- profile --}}
        <li class="nav-item px-4 ">
            <a class="nav-link d-flex gap-3 align-items-center" href="{{ url('profile') }}">
                <i class="fa-solid fa-circle-user"></i>
                {{ __('Profile') }}
            </a>
        </li>
        {{-- logout --}}
        <li class="nav-item px-4">
            <a class="nav-link d-flex gap-3 align-items-center" href="{{ route('logout') }}">
                <i class="fa-solid fa-right-from-bracket"></i>
                {{ __('Logout') }}
            </a>
        </li>
    </ul>
</aside>
