<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('templates/assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('templates/assets/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('templates/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/assets/css/app.css') }}">
    {{-- <link rel="shortcut icon" href="{{ asset('templates/assets/images/favicon.svg') }}" type="image/x-icon"> --}}
    @yield('css')
</head>



<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{ route('dashboard') }}"><img src="{{ asset('templates/assets/images/logo/logo.png') }}"
                                    alt="Logo" style="height:2rem;" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i
                                    class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
                            <a href="/dashboard" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        @if (Request::is('surat/*'))
                        <li class="sidebar-item has-sub active">
                            <a href="" class='sidebar-link'>
                                <span>Pengajuan Surat</span>
                            </a>
                            <ul class="submenu active submenu-open">
                                @if (Request::is('surat/skma*'))
                                <li class="submenu-item active">
                                    <a href="" class='submenu-link'>
                                        <span>SKMA <br>(Sedang Diisi)</span>
                                    </a>
                                </li>
                                @endif
                                @if (Request::is('surat/sp*'))
                                <li class="submenu-item active">
                                    <a href="" class='submenu-link has-sub'>
                                        <span>Surat Pengantar <br> (Sedang Diisi)</span>
                                    </a>
                                </li>
                                @endif
                            </ul>

                        </li>
                        @endif
                        {{-- @if (Request::is('surat/skma*'))
                        <li class="sidebar-item active">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-file-earmark-text-fill"></i>
                                <span>SKMA (Sedang Diisi)</span>
                            </a>
                        </li>
                        @endif --}}

                            {{--                         
                        <li class="sidebar-item {{ Request::is('surat.sp.create') ? 'active' : '' }}">
                            <a href="/pengantar-tugas" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Surat Pengantar Tugas</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-item {{ Request::is('surat-keterangan-mahasiswa-aktif') ? 'active' : '' }}">
                            <a href="/surat-keterangan-mahasiswa-aktif" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Surat Keterangan Mahasiswa Aktif</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-item {{ Request::is('surat-keterangan-lulus') ? 'active' : '' }}">
                            <a href="/surat-keterangan-lulus" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Surat Keterangan Lulus</span>
                            </a>
                        </li> --}}

                            <li class="sidebar-title">Account</li>
                            <a href="/logout" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Log Out</span>
                            </a>
                        </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            {{-- 
            <div class="page-heading">
                <h3> @yield('page-title') </h3>
            </div> --}}
            <div class="page-content">
                @yield('content')
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2025 &copy; - made with Mazer Template</p>
                    </div>
                    <div class="float-end">
                        <p> <a href="https://github.com/ncil27/PWL">2372061- Cecilia Anna Hartanti Naibaho & 2372060 -
                                Laura Puspa Ameliana </a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('templates/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('templates/assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('templates/assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('templates/assets/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('templates/assets/js/main.js') }}"></script>
    @yield('js_bwh')
</body>

</html>
