<header id="header" class="header fixed-top">

    {{-- <div class="topbar d-flex align-items-center dark-background">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a
                        href="mailto:contact@example.com">lapor@desa.com</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div><!-- End Top Bar --> --}}

    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-between">
            <!-- Logo dengan class khusus -->
            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/img/logobdhorizontal2.png') }}" alt="Bina Desa Logo" class="header-logo">
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <!-- Menu untuk semua (guest & login) -->
                    <li><a href="{{ url('/') }}" class="{{ request()->routeIs('/') ? 'active' : '' }}">
                            <i class="bi bi-house"></i>
                        </a></li>
                    <li><a href="{{ route('about') }}"
                            class="{{ request()->routeIs('about') ? 'active' : '' }}">Tentang Kami</a>
                    </li>
                    <li><a href="{{ route('services') }}"
                            class="{{ request()->routeIs('services') ? 'active' : '' }}">Layanan</a></li>

                    <li><a href="{{ route('contact') }}"
                            class="{{ request()->routeIs('contact') ? 'active' : '' }}">Kontak</a></li>

                    <!-- ========== MY ACCOUNT MENU ========== -->
                    <li class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle">
                            <i class="bi bi-person-circle me-1"></i>
                            @auth
                                {{ auth()->user()->name }}
                            @else
                                Akun Saya
                            @endauth
                            <i class="bi bi-chevron-down toggle-dropdown"></i>
                        </a>
                        <ul class="dropdown-menu account-dropdown dropdown-menu-end">
                            @auth
                                <!-- Header dengan foto dan info user -->
                                <li>
                                    <div class="user-info p-3 border-bottom">
                                        <div class="d-flex align-items-center">
                                            @if (auth()->user()->profile_picture)
                                                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                                                    alt="{{ auth()->user()->name }}" class="rounded-circle me-3"
                                                    width="50" height="50">
                                            @else
                                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-3"
                                                    style="width: 50px; height: 50px;">
                                                    <i class="bi bi-person text-white fs-4"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <small class="text-muted">
                                                    @if (auth()->user()->role == 'warga')
                                                        Role: Warga
                                                    @elseif(auth()->user()->role == 'admin')
                                                        Role: Admin
                                                    @elseif(auth()->user()->role == 'petugas')
                                                        Role: Petugas
                                                    @else
                                                        {{ auth()->user()->role }}
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <!-- Menu untuk Warga -->
                                @if (auth()->user()->role == 'warga')
                                    <li><a class="dropdown-item" href="{{ route('pengaduan.index') }}">
                                            <i class="bi bi-clipboard-check me-2"></i>Pengaduan Saya
                                        </a></li>

                                    <li><a class="dropdown-item" href="{{ route('penilaian_layanan.index') }}">
                                            <i class="bi bi-star me-2"></i>Penilaian Layanan
                                        </a></li>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>

                                    <li><a class="dropdown-item" href="{{ route('home') }}">
                                            <i class="bi bi-gear me-2"></i>Pengaturan
                                        </a></li>

                                <!-- Menu untuk Admin Desa -->
                                @elseif(auth()->user()->role == 'admin')
                                    <li><a class="dropdown-item" href="{{ route('pengaduan.index') }}">
                                            <i class="bi bi-inbox me-2"></i>Kelola Pengaduan
                                        </a></li>

                                    <li><a class="dropdown-item" href="{{ route('tindak_lanjut.index') }}">
                                            <i class="bi bi-check-circle me-2"></i>Kelola Tindak Lanjut
                                        </a></li>

                                    <li><a class="dropdown-item" href="{{ route('penilaian_layanan.index') }}">
                                            <i class="bi bi-star me-2"></i>Lihat Penilaian Layanan
                                        </a></li>

                                    <li><a class="dropdown-item" href="{{ route('kategori_pengaduan.index') }}">
                                            <i class="bi bi-tags me-2"></i>Kelola Kategori
                                        </a></li>

                                    <li><a class="dropdown-item" href="{{ route('warga.index') }}">
                                            <i class="bi bi-people me-2"></i>Kelola Data Warga
                                        </a></li>

                                    <li><a class="dropdown-item" href="{{ route('user.index') }}">
                                            <i class="bi bi-person-badge me-2"></i>Kelola User
                                        </a></li>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>

                                    <li><a class="dropdown-item" href="{{ route('home') }}">
                                            <i class="bi bi-gear me-2"></i>Pengaturan
                                        </a></li>

                                <!-- Menu untuk Petugas -->
                                @elseif(auth()->user()->role == 'petugas')
                                    <li><a class="dropdown-item" href="{{ route('pengaduan.index') }}">
                                            <i class="bi bi-inbox me-2"></i>Daftar Pengaduan Warga
                                        </a></li>

                                    <li><a class="dropdown-item" href="{{ route('tindak_lanjut.index') }}">
                                            <i class="bi bi-check-circle me-2"></i>Kelola Tindak Lanjut
                                        </a></li>

                                    <li><a class="dropdown-item" href="{{ route('penilaian_layanan.index') }}">
                                            <i class="bi bi-star me-2"></i>Lihat Penilaian Layanan
                                        </a></li>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>

                                    <li><a class="dropdown-item" href="{{ route('home') }}">
                                            <i class="bi bi-gear me-2"></i>Pengaturan
                                        </a></li>
                                @endif

                                <!-- Logout - FIXED SEJAJAR -->
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="logout-item">
                                    <a href="#" class="dropdown-item text-danger"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @else
                                <!-- Jika belum login -->
                                <li>
                                    <div class="p-3 border-bottom">
                                        <h6 class="mb-0 fw-bold">Selamat Datang di Bina Desa</h6>
                                        <small class="text-muted">Akses akun dan kelola layanan</small>
                                    </div>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('login') }}">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                                    </a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}">
                                        <i class="bi bi-person-plus me-2"></i>Daftar
                                    </a></li>
                            @endauth
                        </ul>
                    </li>
                    <!-- ========== END MY ACCOUNT MENU ========== -->
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </div>
</header>

<style>
    /* CSS untuk dropdown My Account */
    .dropdown-menu.account-dropdown {
        min-width: 280px;
        max-width: 320px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 0;
        overflow: hidden;
        z-index: 1050 !important;
    }

    /* Untuk Bootstrap 5 - dropdown rata kanan */
    .dropdown-menu.account-dropdown.dropdown-menu-end {
        right: 0 !important;
        left: auto !important;
    }

    /* Style untuk semua dropdown items */
    .account-dropdown .dropdown-item {
        padding: 10px 15px;
        font-size: 14px;
        color: #333;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .account-dropdown .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
    }

    /* Logout khusus */
    .account-dropdown .logout-item .dropdown-item {
        color: #dc3545 !important;
    }

    .account-dropdown .logout-item .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #c82333 !important;
    }

    /* User info section */
    .user-info {
        background-color: #f8f9fa;
    }

    /* Icons alignment */
    .account-dropdown .dropdown-item i {
        width: 20px;
        text-align: center;
        margin-right: 8px;
        font-size: 16px;
    }

    /* Divider */
    .dropdown-divider {
        margin: 0.5rem 0;
        border-color: rgba(0, 0, 0, 0.1);
    }

    /* Responsive untuk mobile */
    @media (max-width: 768px) {
        .dropdown-menu.account-dropdown {
            position: fixed !important;
            left: 10px !important;
            right: 10px !important;
            width: calc(100% - 20px) !important;
            max-width: none !important;
        }

        .dropdown-menu.account-dropdown.dropdown-menu-end {
            right: 10px !important;
            left: 10px !important;
        }

        .account-dropdown .dropdown-item {
            padding: 12px 15px;
        }
    }
</style>
