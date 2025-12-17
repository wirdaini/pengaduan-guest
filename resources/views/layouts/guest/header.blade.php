<header id="header" class="header fixed-top">

    <div class="topbar d-flex align-items-center dark-background">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a
                        href="mailto:contact@example.com">contact@example.com</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-between">
            <!-- Logo dengan class khusus -->
            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/img/logobdvertikal.png') }}" alt="Bina Desa Logo" class="header-logo">
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <!-- Menu untuk semua (guest & login) -->
                    <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('about') }}" class="{{ request()->is('about') ? 'active' : '' }}">About</a>
                    </li>
                    <li><a href="{{ route('services') }}"
                            class="{{ request()->is('services') ? 'active' : '' }}">Services</a></li>

                    <!-- ========== MENU DATA (HANYA TAMPIL JIKA LOGIN) ========== -->
                    @auth
                        <li
                            class="dropdown {{ request()->is('pengaduan*') || request()->is('warga*') || request()->is('users*') ? 'active' : '' }}">
                            <a href="#"
                                class="{{ request()->is('pengaduan*') || request()->is('warga*') || request()->is('users*') ? 'active' : '' }}">
                                <span>Data</span>
                                <i class="bi bi-chevron-down toggle-dropdown"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Menu akan tampil, tapi nanti di routes dibatasi -->
                                <li><a href="{{ route('kategori_pengaduan.index') }}"
                                        class="{{ request()->is('kategori_pengaduan*') ? 'active' : '' }}">Kategori
                                        Pengaduan</a></li>
                                <li><a href="{{ route('pengaduan.index') }}"
                                        class="{{ request()->is('pengaduan*') ? 'active' : '' }}">Pengaduan</a></li>
                                <li><a href="{{ route('tindak_lanjut.index') }}"
                                        class="{{ request()->is('tindak_lanjut*') ? 'active' : '' }}">Tindak Lanjut</a>
                                </li>
                                <li><a href="{{ route('penilaian_layanan.index') }}"
                                        class="{{ request()->is('penilaian_layanan*') ? 'active' : '' }}">Penilaian
                                        Layanan</a></li>
                                <li><a href="{{ route('warga.index') }}"
                                        class="{{ request()->is('warga*') ? 'active' : '' }}">Warga</a></li>
                                <li><a href="{{ route('user.index') }}"
                                        class="{{ request()->is('user*') ? 'active' : '' }}">User</a></li>
                            </ul>
                        </li>
                    @endauth
                    <!-- ========== END MENU DATA ========== -->

                    <li><a href="{{ route('contact') }}"
                            class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a></li>

                    <!-- ========== LOGIN/USER MENU ========== -->
                    @auth
                        <!-- JIKA SUDAH LOGIN: Tampilkan NAMA USER dengan dropdown -->
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle">
                                <i class="bi bi-person-circle me-1"></i>
                                {{ auth()->user()->name }}
                                <i class="bi bi-chevron-down toggle-dropdown"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                    </a>
                                </li>
                                @if (auth()->user()->role == 'warga')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('pengaduan.saya') }}">
                                            <i class="bi bi-list me-2"></i>Pengaduan Saya
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a class="dropdown-item" href="{{ route('profil') }}">
                                        <i class="bi bi-person me-2"></i>Profil Saya
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="dropdown-item p-0">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-link text-danger text-decoration-none w-100 text-start p-2">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <!-- JIKA BELUM LOGIN: Tampilkan "Login" -->
                        <li>
                            <a href="{{ route('login') }}" class="{{ request()->is('login') ? 'active' : '' }}">
                                <i class="bi bi-person-circle me-1"></i> Login
                            </a>
                        </li>
                    @endauth
                    <!-- ========== END LOGIN/USER MENU ========== -->
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </div>
</header>
