<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin | Laboratorium FTI</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/img/fti-ukdw.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/datatables.min.css') }}" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ route('admin.index') }}">
                    <span class="align-middle">LabFTI</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-item <?=(isset($page) && $page == 'index') ? 'active': '';?>">
                        <a class="sidebar-link" href="{{ route('admin.index') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Beranda</span>
                        </a>
                    </li>
                    <li class="sidebar-header">
                        Ruangan
                    </li>
                    <li class="sidebar-item <?=(isset($page) && $page == 'daftar_ruang') ? 'active': '';?>">
                        <a class="sidebar-link" href="{{ route('admin.daftar_ruang') }}">
                            <i class="align-middle" data-feather="square"></i> <span class="align-middle">Daftar
                                Ruangan</span>
                        </a>
                    </li>
                    <li class="sidebar-item <?=(isset($page) && $page == 'daftar_peminjaman_ruang') ? 'active': '';?>">
                        <a class="sidebar-link" href="{{ route('admin.daftar_peminjaman_ruang') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Peminjaman Ruangan</span>
                        </a>
                    </li>
                    <li class="sidebar-item <?=(isset($page) && $page == 'riwayat_peminjaman_ruang') ? 'active': '';?>">
                        <a class="sidebar-link" href="{{ route('admin.riwayat_peminjaman_ruang') }}">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Riwayat Peminjaman</span>
                        </a>
                    </li>
                    <li class="sidebar-header">
                        Alat
                    </li>
                    <li class="sidebar-item <?=(isset($page) && $page == 'daftar_alat') ? 'active': '';?>">
                        <a class="sidebar-link" href="{{ route('admin.daftar_alat') }}">
                            <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Daftar
                                Alat</span>
                        </a>
                    </li>
                    <li class="sidebar-item <?=(isset($page) && $page == 'daftar_peminjaman_alat') ? 'active': '';?>">
                        <a class="sidebar-link" href="{{ route('admin.daftar_peminjaman_alat') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span
                                class="align-middle">Peminjaman Alat</span>
                        </a>
                    </li>
                    <li class="sidebar-item <?=(isset($page) && $page == 'riwayat_peminjaman_alat') ? 'active': '';?>">
                        <a class="sidebar-link" href="{{ route('admin.riwayat_peminjaman_alat') }}">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Riwayat Peminjaman</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-bs-toggle="dropdown">
                                <img src="{{ asset('img/avatars/avatar.jpg') }}" class="avatar img-fluid rounded me-1"
                                    alt="{{ Auth::user()->name }}" /> <span
                                    class="text-dark">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="align-middle me-1"
                                        data-feather="user"></i> Profile</a>
                                <div class="dropdown-divider"></div>
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
                    </ul>
                </div>
            </nav>
            <main class="content">
                <div class="container-fluid p-0">
                    @yield('content')
                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0 text-muted">
                                <strong>Laboratorium FTI</strong> &copy; <strong>2023</strong>
                            </p>
                        </div>
                        <div class="col-6 text-end">
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('/js/app.js') }}" defer></script>
    <script src="{{ asset('/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('/js/datatables.min.js') }}"></script>
    @yield('script')
</body>

</html>
