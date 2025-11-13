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

    <div class="branding d-flex align-items-cente">

        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.webp" alt=""> -->
                <h1 class="sitename">Lapor Desa</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('about') }}" class="{{ request()->is('about') ? 'active' : '' }}">About</a>
                    </li>
                    <li><a href="{{ route('services') }}"
                            class="{{ request()->is('services') ? 'active' : '' }}">Services</a></li>
                    <li
                        class="dropdown {{ request()->is('pengaduan*') || request()->is('warga*') || request()->is('users*') ? 'active' : '' }}">
                        <a href="#"
                            class="{{ request()->is('pengaduan*') || request()->is('warga*') || request()->is('users*') ? 'active' : '' }}">
                            <span>Data</span>
                            <i class="bi bi-chevron-down toggle-dropdown"></i>
                        </a>
                        <ul>
                            <li><a href="{{ route('pengaduan.index') }}"
                                    class="{{ request()->is('pengaduan*') ? 'active' : '' }}">Pengaduan</a></li>
                            <li><a href="{{ route('warga.index') }}"
                                    class="{{ request()->is('warga*') ? 'active' : '' }}">Warga</a></li>
                            <li><a href="{{ route('user.index') }}"
                                    class="{{ request()->is('user*') ? 'active' : '' }}">User</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('contact') }}"
                            class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a></li>
                    <li><a href="{{ route('login') }}" class="{{ request()->is('login') ? 'active' : '' }}">Login</a>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>

    </div>

</header>
