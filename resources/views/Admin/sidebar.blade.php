<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <style>
        .sidebar-brand-logo {
            width: 150px;
            height: auto;
            margin: 0 auto;
            display: block;
        }

        .sidebar-brand-logomini {
            width: 70px;
            height: auto;
            margin: 5px auto;
            display: none;
        }

        @media (max-width: 768px) {
            .sidebar-brand-logo {
                display: none;
            }

            .sidebar-brand-logomini {
                display: block;
            }
        }

        .nav-profile-text span {
            font-size: 1rem;
            display: block;
        }

        .nav-profile-text small {
            font-size: 0.8rem;
        }

        #profileDropdown {
            font-size: 0.9rem;
        }

        #profileDropdown p {
            margin-bottom: 0.3rem;
        }

        .nav-profile .mdi-chevron-down {
            font-size: 18px;
            color: #999;
        }
    </style>

    <ul class="nav">
        <!-- PROFIL -->
        <li class="nav-item nav-profile border-bottom">
            <a href="#profileDropdown" class="nav-link d-flex flex-column align-items-center text-center" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="profileDropdown">
                <div class="nav-profile-image">
                    <img src="{{ asset('assets/images/faces/woman.png') }}" alt="profile" />
                </div>
                <div class="nav-profile-text mt-2">
                    <span class="font-weight-semibold">Intan Widara</span>
                    <small class="text-muted">Admin</small>
                </div>
                <i class="mdi mdi-chevron-down mt-1"></i>
            </a>

            <div class="collapse mt-2 px-3" id="profileDropdown">
                <div class="text-left">
                    <p class="mb-1"><strong>Nama:</strong> Intan Widara</p>
                    <p class="mb-0"><strong>Username:</strong> intan_admin</p>
                </div>
            </div>
        </li>

        <!-- LOGO -->
        <li class="nav-item pt-3">
            <a class="nav-link d-block text-center" href="{{ url('/admin.beranda') }}">
                <img class="sidebar-brand-logo" src="{{ asset('assets/images/logo1.png') }}" alt="Logo Utama" />
                <img class="sidebar-brand-logomini" src="{{ asset('assets/images/logo_trash_mini.svg') }}" alt="Logo Mini" />
                <div class="small font-weight-light pt-1">Responsive Dashboard</div>
            </a>

            <!-- Search (Opsional) -->
            <form class="d-flex align-items-center" action="#">
                <div class="input-group mt-2">
                    <div class="input-group-prepend">
                        <i class="input-group-text border-0 mdi mdi-magnify"></i>
                    </div>
                    <input type="text" class="form-control border-0" placeholder="Search" />
                </div>
            </form>
        </li>

        <!-- MENU -->
        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin.beranda') ? 'active' : '' }}" href="{{ route('admin.beranda') }}">
                <i class="mdi mdi-compass-outline menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin.nasabah') ? 'active' : '' }}" href="{{ route('nasabah.index') }}">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">Data Nasabah</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('jenis') ? 'active' : '' }}" href="{{ route('jenis.index') }}">
                <i class="mdi mdi-recycle menu-icon"></i>
                <span class="menu-title">Data Jenis Sampah</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('penjemputan') ? 'active' : '' }}" href="{{ route('penjemputan.index') }}">
                <i class="mdi mdi-truck menu-icon"></i>
                <span class="menu-title">Data Jadwal Jemput</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link {{ Request::is('pesanan') ? 'active' : '' }}" href="{{ route('pesanan.index') }}">
                <i class="mdi mdi-package-variant menu-icon"></i>
                <span class="menu-title">Data Pesanan</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('riwayat') ? 'active' : '' }}" href="{{ route('riwayat.index') }}">
                <i class="mdi mdi-history menu-icon"></i>
                <span class="menu-title">Data Riwayat</span>
            </a>
        </li>

        <!-- LOGOUT -->
        <li class="nav-item pt-3">
            <a class="nav-link" href="{{ route('logout') }}" onclick="return confirm('Apakah kamu yakin ingin keluar?')">
                <i class="mdi mdi-logout menu-icon"></i>
                <span class="menu-title">Log out</span>
            </a>
        </li>
    </ul>
</nav>
