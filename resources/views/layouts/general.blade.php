<!DOCTYPE html>
<html lang="en"
    style="--bs-secondary: #B7E917;--bs-secondary-rgb: 183,233,23;--bs-primary: #2F4858;--bs-primary-rgb: 47,72,88;--bs-success: #65C728;--bs-success-rgb: 101,199,40;--bs-info: #009EFF;--bs-info-rgb: 0,158,255;--bs-warning: #FFC800;--bs-warning-rgb: 255,200,0;--bs-danger: #E31A1C;--bs-danger-rgb: 227,26,28;--bs-body-color: #2F4858;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('/fonts/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/home.css') }}">
    <title>Home | LABORATORIUM</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/img/fti-ukdw.png') }}">

</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md py-3" id="navigasi"style="background-color: #046742;">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/" style="color: white;">
                <span>Laboratorium FTI</span>
            </a>
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-2">
                <span class="visually-hidden">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-2">
                <ul class="navbar-nav ms-auto">
                    
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.daftar_alat') }}" style="color: white;">
                            Peralatan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.daftar_ruang') }}" style="color: white;">
                            Ruangan
                        </a>
                    </li>
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}" style="color: white;">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}" style="color: white;">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white;">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->is_admin == 1)
                                    <a class="dropdown-item" href="{{ route('admin.index') }}">Admin Area</a>
                                @else
                                    <a class="dropdown-item" href="{{ route('pengguna.index') }}">Client Area</a>
                                @endif
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
    @yield('content')
    <footer id="footer">
        <div class="container py-3">
            <h4 class="fw-bold" style="color: var(--primary-color);margin-bottom: 26px;">Contact</h4>
            <div class="row">
                <div class="col-12 col-md-3">
                    <img src="/img/fti-ukdw.png" width="250px" height="auto">
                </div>
                <div class="col-12 col-md-9 text-center text-lg-start d-flex flex-column item">
                    <h3 class="fs-5 fw-bold">Lab FTI</h3>
                    <div class="">
                        <p><i class="fas fa-phone-alt" style="margin-right: 12px;"></i>0274-563929</p>
                        <p><i class="fas fa-map-marker-alt" style="margin-right: 12px;"></i>Gedung Agape Lantai 2,3,4
                            Jl.
                            dr. Wahidin Sudirohusodo No 5-25</p>
                        <p><i class="fas fa-clock" style="margin-right: 12px;"></i>07.30 – 15.00 WIB</p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">

                    <div class="float-end">
                        <span class="mb-0">Copyright © 2023 Lab FTI</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/bs-init.js') }}"></script>
    <script src="{{ asset('/js/Lightbox-Gallery.js') }}"></script>
    <script src="{{ asset('/js/Simple-Slider.js') }}"></script>
    <script src="{{ asset('/js/jquery-3.6.0.min.js') }}"></script>
</body>

</html>
