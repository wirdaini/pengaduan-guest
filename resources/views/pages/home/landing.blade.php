@extends('layouts.guest.app')



@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show auto-dismiss" role="alert"
                        style="position: fixed; top: 80px; right: 20px; z-index: 9999; min-width: 300px;">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="hero-content">
                            <div class="trust-badges mb-4" data-aos="fade-right" data-aos-delay="200">
                                <div class="badge-item">
                                    <i class="bi bi-shield-check"></i>
                                    <span>Terverifikasi</span>
                                </div>
                                <div class="badge-item">
                                    <i class="bi bi-clock"></i>
                                    <span>Layanan 24/7</span>
                                </div>
                                <div class="badge-item">
                                    <i class="bi bi-star-fill"></i>
                                    <span>4.9/5 Rating</span>
                                </div>
                            </div>

                            <h1 data-aos="fade-right" data-aos-delay="300">
                                Membangun <span class="highlight">Desa</span> dengan Partisipasi Aktif Warga
                            </h1>

                            <p class="hero-description" data-aos="fade-right" data-aos-delay="400">
                                Platform pengaduan warga untuk pembangunan desa yang lebih baik. Sampaikan keluhan, usulan,
                                dan aspirasi Anda demi kemajuan desa kita bersama.
                            </p>

                            <div class="hero-stats mb-4" data-aos="fade-right" data-aos-delay="500">
                                <div class="stat-item">
                                    <h3>
                                        <span data-purecounter-start="0" data-purecounter-end="{{ $totalSelesai }}"
                                            data-purecounter-duration="2" class="purecounter">{{ $totalSelesai }}</span>+
                                    </h3>
                                    <p>Pengaduan Diselesaikan</p>
                                </div>
                                <div class="stat-item">
                                    <h3>
                                        <span data-purecounter-start="0" data-purecounter-end="{{ $kepuasan }}"
                                            data-purecounter-duration="2" class="purecounter">{{ $kepuasan }}</span>%
                                    </h3>
                                    <p>Kepuasan Warga</p>
                                </div>
                                <div class="stat-item">
                                    <h3>
                                        <span data-purecounter-start="0" data-purecounter-end="{{ $desaTerlayani }}"
                                            data-purecounter-duration="2" class="purecounter">{{ $desaTerlayani }}</span>+
                                    </h3>
                                    <p>Desa Terlayani</p>
                                </div>
                            </div>

                            <div class="hero-actions" data-aos="fade-right" data-aos-delay="600">
                                <a href="{{ route('pengaduan.create') }}" class="btn btn-primary">Ajukan Pengaduan</a>
                                <a href="{{ route('about') }}" class="btn btn-outline">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Tentang Kami
                                </a>
                            </div>

                            <div class="emergency-contact" data-aos="fade-right" data-aos-delay="700">
                                <div class="emergency-icon">
                                    <i class="bi bi-telephone-fill"></i>
                                </div>
                                <div class="emergency-info">
                                    <small>Hotline Pengaduan</small>
                                    <strong>(021) 1234-5678</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="hero-visual" data-aos="fade-left" data-aos-delay="400">
                            <!-- Slider Container -->
                            <div class="hero-slider-container">
                                <!-- Slider Wrapper -->
                                <div class="hero-slider-wrapper">
                                    @foreach ($heroImages as $index => $image)
                                        <div class="slide {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ asset('assets/img/' . $image) }}" alt="Desa {{ $index + 1 }}"
                                                class="slider-img">
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Floating Cards (Tetap sama) -->
                                {{-- Floating Cards dengan efek melayang --}}
                                <div
                                    class="floating-card appointment-card bg-white p-3 rounded-3 shadow-lg border-0 animate__animated animate__pulse animate__infinite animate__slower">
                                    <div class="d-flex align-items-center gap-3">
                                        <div
                                            class="card-icon bg-primary bg-opacity-10 p-2 rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-calendar-check text-primary fs-5"></i>
                                        </div>
                                        <div class="card-content">
                                            <h6 class="mb-1 fw-semibold text-dark fs-6">Pengaduan Terbaru</h6>
                                            @if ($pengaduanTerbaru->count() > 0)
                                                <p class="mb-1 fw-bold text-primary fs-5">
                                                    {{ $pengaduanTerbaru->first()->created_at->format('H:i') }}</p>
                                                <small
                                                    class="text-muted d-block">{{ Str::limit($pengaduanTerbaru->first()->judul, 20) }}</small>
                                            @else
                                                <p class="mb-1 fw-bold text-secondary fs-5">Belum ada</p>
                                                <small class="text-muted d-block">Pengaduan terbaru</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="floating-card rating-card bg-white p-3 rounded-3 shadow-lg border-0 text-center animate__animated animate__pulse animate__infinite animate__slower">
                                    <div class="card-content">
                                        <div class="rating-stars mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="bi bi-star-fill {{ $i <= round($avgRating ?? 5) ? 'text-warning' : 'text-muted opacity-50' }}"></i>
                                            @endfor
                                        </div>
                                        <h6 class="mb-1 fw-bold text-dark fs-4">{{ $avgRating ?? 4.9 }}/5</h6>
                                        <small class="text-muted">{{ $totalReviews ?? 1234 }} Reviews</small>
                                    </div>
                                </div>

                                <!-- Slider Navigation Dots -->
                                <div class="slider-dots">
                                    @foreach ($heroImages as $index => $image)
                                        <button class="dot {{ $index === 0 ? 'active' : '' }}"
                                            data-slide="{{ $index }}"></button>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Background Elements -->
                            <div class="background-elements">
                                <div class="element element-1"></div>
                                <div class="element element-2"></div>
                                <div class="element element-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- Home About Section -->
        <section id="home-about" class="home-about section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row align-items-center">
                    <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right" data-aos-delay="200">
                        <div class="about-content">
                            <h2 class="section-heading">Pelayanan Terpercaya, Pembangunan Berkualitas</h2>
                            <p class="lead-text">Selama bertahun-tahun, kami berdedikasi memberikan pelayanan terbaik
                                yang menggabungkan teknologi modern dengan pendekatan personal yang
                                diinginkan oleh warga.</p>

                            <p>Tim multidisiplin kami bekerja sama memastikan setiap pengaduan warga
                                mendapat penanganan komprehensif sesuai kebutuhan unik mereka. Dari
                                layanan dasar hingga masalah kompleks, kami menjaga standar tertinggi
                                pelayanan sambil membangun lingkungan kepercayaan dan solusi.</p>

                            <div class="stats-grid">
                                <div class="stat-item">
                                    <div class="stat-number purecounter" data-purecounter-start="0"
                                        data-purecounter-end="{{ $wargaTerdaftar }}" data-purecounter-duration="2">
                                        {{ $wargaTerdaftar }}</div>
                                    <div class="stat-label">Warga Terdaftar</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number purecounter" data-purecounter-start="0"
                                        data-purecounter-end="{{ $tahunBeroperasi }}" data-purecounter-duration="1.5">
                                        {{ $tahunBeroperasi }}</div>
                                    <div class="stat-label">Tahun Beroperasi</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number purecounter" data-purecounter-start="0"
                                        data-purecounter-end="{{ $timTerlatih }}" data-purecounter-duration="1">
                                        {{ $timTerlatih }}</div>
                                    <div class="stat-label">Tim Terlatih</div>
                                </div>
                            </div>

                            <div class="cta-section">
                                <a href="{{ route('about') }}" class="btn-primary">Pelajari Lebih Lanjut</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                        <div class="about-visual">
                            <div class="main-image">
                                <img src="{{ asset('assets/img/desa/home2.jpg') }}" alt="Modern medical facility"
                                    class="img-fluid">
                            </div>
                            <div class="floating-card">
                                <div class="card-content">
                                    <div class="icon">
                                        <i class="bi bi-heart-pulse"></i>
                                    </div>
                                    <div class="card-text">
                                        <h4>Layanan Cepat 24/7</h4>
                                        <p>Selalu siap membantu kapanpun dibutuhkan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="experience-badge">
                                <div class="badge-content">
                                    <span class="years">{{ $totalSelesai }}+</span>
                                    <span class="text">Pengaduan Terselesaikan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Home About Section -->

        <!-- Featured Departments Section -->
        <section id="featured-departments" class="featured-departments section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Layanan Unggulan</h2>
                <p>Berbagai layanan terbaik yang kami sediakan untuk mendukung pembangunan desa secara menyeluruh</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-5">

                    <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="100">
                        <div class="specialty-card">
                            <div class="specialty-content">
                                <div class="specialty-meta">
                                    <span class="specialty-label">Layanan Prioritas</span>
                                </div>
                                <h3>Infrastruktur Desa</h3>
                                <p>Penanganan komprehensif untuk masalah infrastruktur desa seperti jalan, jembatan,
                                    saluran air, dan fasilitas umum dengan pendekatan solutif dan berkelanjutan.</p>
                                <div class="specialty-features">
                                    <span><i class="bi bi-check-circle-fill"></i>Perbaikan Jalan & Jembatan</span>
                                    <span><i class="bi bi-check-circle-fill"></i>Pembangunan Fasilitas Umum</span>
                                </div>
                                <a href="department-details.html" class="specialty-link">
                                    Jelajahi Layanan <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="specialty-visual">
                                <img src="{{ asset('assets/img/desa/home3.jpg') }}" alt="Infrastruktur Desa"
                                    class="img-fluid">
                                <div class="visual-overlay">
                                    <i class="bi bi-tools"></i>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Specialty Card -->

                    <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                        <div class="specialty-card">
                            <div class="specialty-content">
                                <div class="specialty-meta">
                                    <span class="specialty-label">Layanan Terpadu</span>
                                </div>
                                <h3>Lingkungan & Kebersihan</h3>
                                <p>Penanganan masalah lingkungan dan kebersihan desa dengan pendekatan inovatif
                                    untuk menciptakan lingkungan yang sehat dan nyaman bagi warga.</p>
                                <div class="specialty-features">
                                    <span><i class="bi bi-check-circle-fill"></i>Pengelolaan Sampah</span>
                                    <span><i class="bi bi-check-circle-fill"></i>Penghijauan Lingkungan</span>
                                </div>
                                <a href="department-details.html" class="specialty-link">
                                    Jelajahi Layanan <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                            <div class="specialty-visual">
                                <img src="{{ asset('assets/img/desa/home4.jpg') }}" alt="Lingkungan & Kebersihan"
                                    class="img-fluid">
                                <div class="visual-overlay">
                                    <i class="bi bi-tree"></i>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Specialty Card -->

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="department-highlight">
                            <div class="highlight-icon">
                                <i class="bi bi-droplet"></i>
                            </div>
                            <h4>Air Bersih & Sanitasi</h4>
                            <p>Layanan penyediaan air bersih dan sanitasi yang layak untuk mendukung kesehatan
                                dan kenyamanan warga desa.</p>
                            <ul class="highlight-list">
                                <li>Penyediaan Air Bersih</li>
                                <li>Sanitasi Lingkungan</li>
                                <li>Drainase Pemukiman</li>
                            </ul>
                            <a href="department-details.html" class="highlight-cta">Selengkapnya</a>
                        </div>
                    </div><!-- End Department Highlight -->

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="department-highlight">
                            <div class="highlight-icon">
                                <i class="bi bi-lightning-charge"></i>
                            </div>
                            <h4>Energi & Penerangan</h4>
                            <p>Layanan penyediaan energi dan penerangan desa untuk mendukung aktivitas
                                warga di malam hari dan meningkatkan keamanan.</p>
                            <ul class="highlight-list">
                                <li>Penerangan Jalan</li>
                                <li>Energi Terbarukan</li>
                                <li>Listrik Pedesaan</li>
                            </ul>
                            <a href="department-details.html" class="highlight-cta">Selengkapnya</a>
                        </div>
                    </div><!-- End Department Highlight -->

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="department-highlight">
                            <div class="highlight-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <h4>Keamanan & Ketertiban</h4>
                            <p>Layanan penjagaan keamanan dan ketertiban desa untuk menciptakan lingkungan
                                yang aman dan nyaman bagi seluruh warga.</p>
                            <ul class="highlight-list">
                                <li>Patroli Keamanan</li>
                                <li>Sistem Pengawasan</li>
                                <li>Pos Keamanan</li>
                            </ul>
                            <a href="department-details.html" class="highlight-cta">Selengkapnya</a>
                        </div>
                    </div><!-- End Department Highlight -->

                </div>

                <div class="emergency-banner" data-aos="fade-up" data-aos-delay="400">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="emergency-content">
                                <h3>Layanan Darurat Tersedia 24/7</h3>
                                <p>Tim darurat kami siap memberikan penanganan cepat untuk masalah mendesak
                                    yang membutuhkan tindakan segera demi keselamatan warga.</p>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <a href="tel:+15551234567" class="emergency-btn">
                                <i class="bi bi-telephone-fill"></i>
                                Hotline Darurat: (021) 123-4567
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Featured Departments Section -->

        <!-- Featured Testimonials Section -->
        <section id="featured-testimonials" class="testimonials section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Testimoni Warga</h2>
                <p>Apa kata warga tentang pelayanan pengaduan desa kami</p>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                @if ($testimonials->count() > 0)
                    <div class="testimonials-14 swiper init-swiper">
                        <script type="application/json" class="swiper-config">
                {
                    "loop": true,
                    "speed": 600,
                    "autoplay": {
                        "delay": 5000
                    },
                    "slidesPerView": 3,
                    "spaceBetween": 24,
                    "pagination": {
                        "el": ".swiper-pagination",
                        "type": "bullets",
                        "clickable": true
                    },
                    "breakpoints": {
                        "320": {
                            "slidesPerView": 1,
                            "spaceBetween": 16
                        },
                        "768": {
                            "slidesPerView": 2,
                            "spaceBetween": 24
                        },
                        "1200": {
                            "slidesPerView": 3,
                            "spaceBetween": 24
                        }
                    }
                }
            </script>

                        <div class="swiper-wrapper">
                            @foreach ($testimonials as $testimonial)
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <!-- Rating Stars -->
                                        <div class="stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="bi bi-star-fill {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted opacity-50' }}"></i>
                                            @endfor
                                        </div>

                                        <!-- Testimoni Text -->
                                        <p>"{{ \Illuminate\Support\Str::limit($testimonial->komentar, 180) }}"</p>

                                        <!-- Profile Info -->
                                        <div class="testimonial-footer">
                                            <div class="testimonial-author">
                                                @if (isset($testimonial->pengaduan->warga->nama) && !empty($testimonial->pengaduan->warga->nama))
                                                    <div class="avatar-circle">
                                                        {{ strtoupper(substr($testimonial->pengaduan->warga->nama, 0, 1)) }}
                                                    </div>
                                                @else
                                                    <div class="avatar-circle">
                                                        <i class="bi bi-person-circle"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h5>{{ $testimonial->pengaduan->warga->nama ?? 'Warga Desa' }}</h5>
                                                    <span>
                                                        @if (isset($testimonial->pengaduan->warga->dusun) && !empty($testimonial->pengaduan->warga->dusun))
                                                            {{ $testimonial->pengaduan->warga->dusun }}
                                                        @else
                                                            Warga Desa
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="quote-icon">
                                                <i class="bi bi-quote"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End testimonial item -->
                            @endforeach
                        </div>

                        <div class="swiper-pagination"></div>
                    </div>
                @else
                    <!-- Jika belum ada testimoni -->
                    <div class="text-center py-5" data-aos="fade-up">
                        <div class="no-testimonial-box p-5 rounded-3 bg-light border">
                            <div class="icon-placeholder mb-4">
                                <i class="bi bi-chat-square-text display-4 text-muted"></i>
                            </div>
                            <h4 class="mb-3">Belum Ada Testimoni</h4>
                            <p class="text-muted mb-4">
                                Jadilah yang pertama memberikan testimoni! Setelah pengaduan Anda selesai,
                                berikan penilaian dan komentar untuk membantu desa kami berkembang.
                            </p>
                            <div class="d-flex justify-content-center gap-3 flex-wrap">
                                @auth
                                    <a href="{{ route('penilaian_layanan.create') }}" class="btn btn-primary">
                                        <i class="bi bi-pencil-square me-2"></i>
                                        Beri Penilaian
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-outline-primary">
                                        <i class="bi bi-box-arrow-in-right me-2"></i>
                                        Login
                                    </a>
                                    <a href="{{ route('pengaduan.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-circle me-2"></i>
                                        Ajukan Pengaduan
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section><!-- /Featured Testimonials Section -->

        <!-- Profil Pengembang -->
        <section class="profil-pengembang">
            <div class="container">
                <!-- Tambahkan Section Title di sini -->
                <div class="section-title" data-aos="fade-up">
                    <h2>Profil Pengembang Lapor Desa</h2>
                    <p>Seseorang dibalik pembuatan dan pengembangan Lapor Desa</p>
                </div>

                <div class="dev-card" data-aos="fade-up" data-aos-delay="100">
                    <!-- Header -->
                    <div class="dev-header">
                        <div class="dev-profile-area">
                            <div class="dev-avatar-wrapper">
                                <!-- Avatar -->
                                @if (file_exists(public_path('assets/img/developer1.jpg')))
                                    <img src="{{ asset('assets/img/developer1.jpg') }}" alt="Pengembang"
                                        class="dev-avatar">
                                @else
                                    <div class="dev-avatar-default">
                                        <i class="bi bi-person-circle"></i>
                                    </div>
                                @endif
                                <div class="dev-status-online"></div>
                            </div>

                            <div class="dev-profile-info">
                                <h1 class="dev-name">Wirda Aini Maqhfiroh</h1>
                                <p class="dev-username">@wirdaini678</p>
                                <p class="dev-bio">
                                    <i class="bi bi-code-slash"></i>
                                    Full Stack Developer • Sistem Lapor Desa
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Konten Utama -->
                    <div class="dev-content">
                        <!-- Kolom Kiri -->
                        <div class="dev-left-column">
                            <!-- Statistik -->
                            <div class="dev-stats-grid">
                                <div class="dev-stat-item">
                                    <div class="dev-stat-icon">
                                        <i class="bi bi-person-badge"></i>
                                    </div>
                                    <div class="dev-stat-details">
                                        <div class="dev-stat-number">2457301153</div>
                                        <div class="dev-stat-label">NIM</div>
                                    </div>
                                </div>

                                <div class="dev-stat-item">
                                    <div class="dev-stat-icon">
                                        <i class="bi bi-mortarboard"></i>
                                    </div>
                                    <div class="dev-stat-details">
                                        <div class="dev-stat-number">Sistem Informasi</div>
                                        <div class="dev-stat-label">Program Studi</div>
                                    </div>
                                </div>

                                <div class="dev-stat-item">
                                    <div class="dev-stat-icon">
                                        <i class="bi bi-building"></i>
                                    </div>
                                    <div class="dev-stat-details">
                                        <div class="dev-stat-number">Politeknik Caltex Riau</div>
                                        <div class="dev-stat-label">Universitas</div>
                                    </div>
                                </div>

                                <div class="dev-stat-item">
                                    <div class="dev-stat-icon">
                                        <i class="bi bi-gear"></i>
                                    </div>
                                    <div class="dev-stat-details">
                                        <div class="dev-stat-number">Laravel Project</div>
                                        <div class="dev-stat-label">Sistem Lapor Desa</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tentang -->
                            <div class="dev-about-section">
                                <div class="dev-section-title">
                                    <i class="bi bi-person-lines-fill"></i>
                                    <span>Tentang Saya</span>
                                </div>
                                <p class="dev-about-text">
                                    Berfokus pada pengembangan solusi digital untuk
                                    mendukung pelayanan dan pembangunan desa. Mengembangkan Sistem Lapor Desa sebagai
                                    platform pengelolaan layanan dan pengaduan masyarakat desa dengan pendekatan modern,
                                    efisien, dan mudah digunakan. Berkomitmen menciptakan sistem yang fungsional,
                                    user-friendly, dan memberikan dampak nyata bagi masyarakat.
                                </p>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="dev-right-column">
                            <!-- Sosial Media -->
                            <div class="dev-social-section">
                                <div class="dev-section-title">
                                    <i class="bi bi-link-45deg"></i>
                                    <span>Hubungi Saya</span>
                                </div>

                                <div class="dev-social-grid">
                                    <!-- GitHub -->
                                    <a href="https://github.com/wirdaini" class="dev-social-card" target="_blank">
                                        <div class="dev-social-icon dev-github">
                                            <i class="bi bi-github"></i>
                                        </div>
                                        <div class="dev-social-info">
                                            <div class="dev-social-title">GitHub</div>
                                            <div class="dev-social-desc">@wirdaini</div>
                                        </div>
                                        <div class="dev-social-arrow">
                                            <i class="bi bi-arrow-up-right"></i>
                                        </div>
                                    </a>

                                    <!-- LinkedIn -->
                                    <a href="https://linkedin.com/in/username" class="dev-social-card" target="_blank">
                                        <div class="dev-social-icon dev-linkedin">
                                            <i class="bi bi-linkedin"></i>
                                        </div>
                                        <div class="dev-social-info">
                                            <div class="dev-social-title">LinkedIn</div>
                                            <div class="dev-social-desc">Profil Profesional</div>
                                        </div>
                                        <div class="dev-social-arrow">
                                            <i class="bi bi-arrow-up-right"></i>
                                        </div>
                                    </a>

                                    <!-- Instagram -->
                                    <a href="https://instagram.com/wirdainimqh" class="dev-social-card" target="_blank">
                                        <div class="dev-social-icon dev-instagram">
                                            <i class="bi bi-instagram"></i>
                                        </div>
                                        <div class="dev-social-info">
                                            <div class="dev-social-title">Instagram</div>
                                            <div class="dev-social-desc">@wirdainimqh</div>
                                        </div>
                                        <div class="dev-social-arrow">
                                            <i class="bi bi-arrow-up-right"></i>
                                        </div>
                                    </a>

                                    <!-- Email -->
                                    <a href="mailto:wirda24si@mahasiswa.pcr.ac.id" class="dev-social-card">
                                        <div class="dev-social-icon dev-email">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                        <div class="dev-social-info">
                                            <div class="dev-social-title">Email</div>
                                            <div class="dev-social-desc">wirda24si@mahasiswa.pcr.ac.id</div>
                                        </div>
                                        <div class="dev-social-arrow">
                                            <i class="bi bi-arrow-up-right"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <!-- Teknologi -->
                            <div class="dev-tech-section">
                                <div class="dev-section-title">
                                    <i class="bi bi-tools"></i>
                                    <span>Teknologi yang Digunakan</span>
                                </div>
                                <div class="dev-tech-tags">
                                    <span class="dev-tech-tag">Laravel 10</span>
                                    <span class="dev-tech-tag">Bootstrap 5</span>
                                    <span class="dev-tech-tag">MySQL</span>
                                    <span class="dev-tech-tag">JavaScript</span>
                                    <span class="dev-tech-tag">Git & GitHub</span>
                                    <span class="dev-tech-tag">Laravel MVC Architecture
                                    </span>
                                    <span class="dev-tech-tag">PHP 8</span>
                                    <span class="dev-tech-tag">CSS3</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="dev-footer">
                        <div class="dev-footer-content">
                            <div class="dev-footer-icon">
                                <i class="bi bi-heart-fill"></i>
                            </div>
                            <div class="dev-footer-text">
                                <div class="dev-footer-title">Sistem Lapor Desa</div>
                                <div class="dev-footer-subtitle">Solusi digital untuk pelayanan dan pengaduan masyarakat
                                    desa</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <style>
            /* ====== PROFIL PENGEMBANG - DESAIN KOMPAK & PROFESIONAL ====== */
            .profil-pengembang {
                background: #ffffff;
                padding: 60px 0 50px;
                position: relative;
                overflow: hidden;
            }

            .profil-pengembang::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
            }

            /* Section Title Styling */
            .profil-pengembang .section-title {
                margin-bottom: 40px;
                text-align: center;
            }

            .profil-pengembang .section-title h2 {
                color: #1e293b;
                font-weight: 700;
                margin-bottom: 15px;
                font-size: 2.2rem;
            }

            .profil-pengembang .section-title p {
                color: #64748b;
                font-size: 1.1rem;
                max-width: 700px;
                margin: 0 auto;
                line-height: 1.6;
            }

            .dev-card {
                background: #ffffff;
                border-radius: 16px;
                max-width: 900px;
                margin: 0 auto;
                box-shadow: 0 10px 40px rgba(30, 64, 175, 0.1);
                border: 1px solid #e2e8f0;
                overflow: hidden;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .dev-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 50px rgba(30, 64, 175, 0.15);
            }

            /* Header Profil - Compact & Elegant */
            .dev-header {
                background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
                padding: 30px 40px;
                position: relative;
            }



            .dev-profile-area {
                display: flex;
                align-items: center;
                gap: 25px;
            }

            /* Avatar - Professional */
            .dev-avatar-wrapper {
                position: relative;
                width: 120px;
                height: 120px;
                flex-shrink: 0;
            }

            .dev-avatar {
                width: 100%;
                height: 100%;
                border-radius: 50%;
                border: 4px solid rgba(255, 255, 255, 0.2);
                object-fit: cover;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            }

            .dev-avatar-default {
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
                border-radius: 50%;
                border: 4px solid rgba(255, 255, 255, 0.2);
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 3rem;
                box-shadow: 0 10px 30px rgba(59, 130, 246, 0.2);
            }

            .dev-status-online {
                position: absolute;
                bottom: 10px;
                right: 10px;
                width: 16px;
                height: 16px;
                background: #10b981;
                border-radius: 50%;
                border: 2px solid #1e40af;
                box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
            }

            /* Info Profil */
            .dev-profile-info {
                flex: 1;
            }

            .dev-name {
                color: #ffffff;
                font-size: 1.8rem;
                font-weight: 700;
                margin: 0 0 5px 0;
                letter-spacing: -0.3px;
            }

            .dev-username {
                color: rgba(255, 255, 255, 0.85);
                font-size: 0.95rem;
                margin: 0 0 12px 0;
                font-weight: 400;
            }

            .dev-bio {
                color: rgba(255, 255, 255, 0.9);
                font-size: 1rem;
                margin: 0;
                display: flex;
                align-items: center;
                gap: 8px;
                line-height: 1.4;
            }

            .dev-bio i {
                color: #93c5fd;
                font-size: 1.1rem;
            }

            /* Konten Utama - Compact Layout */
            .dev-content {
                padding: 30px 40px;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 30px;
            }

            /* Kolom Kiri */
            .dev-left-column {
                display: flex;
                flex-direction: column;
                gap: 30px;
            }

            /* Statistik Grid - Compact */
            .dev-stats-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .dev-stat-item {
                background: #f8fafc;
                border-radius: 12px;
                padding: 20px;
                text-align: center;
                transition: all 0.3s ease;
                border: 1px solid #e2e8f0;
                position: relative;
                overflow: hidden;
            }

            .dev-stat-item:hover {
                transform: translateY(-3px);
                border-color: #3b82f6;
                box-shadow: 0 8px 20px rgba(59, 130, 246, 0.12);
            }

            .dev-stat-icon {
                width: 48px;
                height: 48px;
                background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 1.4rem;
                margin: 0 auto 12px;
                transition: transform 0.3s ease;
            }

            .dev-stat-item:hover .dev-stat-icon {
                transform: scale(1.05);
            }

            .dev-stat-number {
                color: #1e293b;
                font-size: 1.4rem;
                font-weight: 700;
                margin-bottom: 4px;
                line-height: 1.2;
            }

            .dev-stat-label {
                color: #64748b;
                font-size: 0.8rem;
                font-weight: 500;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            /* Tentang Saya - Compact */
            .dev-about-section {
                background: #f8fafc;
                border-radius: 12px;
                padding: 25px;
                border: 1px solid #e2e8f0;
            }

            .dev-section-title {
                display: flex;
                align-items: center;
                gap: 10px;
                color: #1e293b;
                font-size: 1.1rem;
                font-weight: 600;
                margin-bottom: 15px;
            }

            .dev-section-title i {
                color: #3b82f6;
                font-size: 1.2rem;
            }

            .dev-about-text {
                color: #475569;
                line-height: 1.6;
                font-size: 0.95rem;
                margin: 0;
            }

            /* Kolom Kanan */
            .dev-right-column {
                display: flex;
                flex-direction: column;
                gap: 30px;
            }

            /* Sosial Media - Compact */
            .dev-social-section {
                background: #f8fafc;
                border-radius: 12px;
                padding: 25px;
                border: 1px solid #e2e8f0;
            }

            .dev-social-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .dev-social-card {
                background: #ffffff;
                border: 1px solid #e2e8f0;
                border-radius: 10px;
                padding: 16px;
                display: flex;
                align-items: center;
                gap: 12px;
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .dev-social-card:hover {
                transform: translateX(5px);
                border-color: #3b82f6;
                box-shadow: 0 6px 20px rgba(59, 130, 246, 0.1);
            }

            .dev-social-icon {
                width: 40px;
                height: 40px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
                flex-shrink: 0;
                transition: transform 0.3s ease;
            }

            .dev-social-card:hover .dev-social-icon {
                transform: scale(1.1);
            }

            .dev-github {
                background: rgba(24, 23, 23, 0.06);
                color: #1e293b;
            }

            .dev-linkedin {
                background: rgba(10, 102, 194, 0.06);
                color: #1e293b;
            }

            .dev-instagram {
                background: linear-gradient(45deg, rgba(225, 48, 108, 0.06), rgba(251, 180, 53, 0.06));
                color: #1e293b;
            }

            .dev-email {
                background: rgba(59, 130, 246, 0.06);
                color: #1e293b;
            }

            .dev-social-info {
                flex: 1;
            }

            .dev-social-title {
                color: #1e293b;
                font-weight: 600;
                margin-bottom: 3px;
                font-size: 0.95rem;
            }

            .dev-social-desc {
                color: #64748b;
                font-size: 0.8rem;
            }

            .dev-social-arrow {
                color: #3b82f6;
                font-size: 0.9rem;
                opacity: 0;
                transform: translateX(-3px);
                transition: all 0.3s ease;
            }

            .dev-social-card:hover .dev-social-arrow {
                opacity: 1;
                transform: translateX(0);
            }

            /* Teknologi - Compact */
            .dev-tech-section {
                background: #f8fafc;
                border-radius: 12px;
                padding: 25px;
                border: 1px solid #e2e8f0;
            }

            .dev-tech-tags {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
            }

            .dev-tech-tag {
                background: #ffffff;
                color: #1e40af;
                padding: 8px 16px;
                border-radius: 50px;
                font-size: 0.85rem;
                font-weight: 500;
                border: 1px solid #e2e8f0;
                transition: all 0.3s ease;
            }

            .dev-tech-tag:hover {
                background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 6px 16px rgba(30, 64, 175, 0.15);
                border-color: transparent;
            }

            /* Footer - Simple */
            .dev-footer {
                padding: 20px 40px;
                border-top: 1px solid #e2e8f0;
                text-align: center;
                background: #f8fafc;
            }

            .dev-footer-content {
                display: inline-flex;
                align-items: center;
                gap: 15px;
            }

            .dev-footer-icon {
                width: 40px;
                height: 40px;
                background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 1.2rem;
            }

            .dev-footer-text {
                flex: 1;
            }

            .dev-footer-title {
                color: #1e293b;
                font-weight: 600;
                margin-bottom: 3px;
                font-size: 1rem;
            }

            .dev-footer-subtitle {
                color: #64748b;
                font-size: 0.85rem;
            }

            /* Responsive Design */
            @media (max-width: 992px) {
                .dev-content {
                    grid-template-columns: 1fr;
                    gap: 25px;
                }

                .dev-profile-area {
                    flex-direction: column;
                    text-align: center;
                    gap: 20px;
                }
            }

            @media (max-width: 768px) {
                .profil-pengembang {
                    padding: 50px 0 40px;
                }

                .profil-pengembang .section-title h2 {
                    font-size: 1.8rem;
                }

                .profil-pengembang .section-title p {
                    font-size: 1rem;
                }

                .dev-header {
                    padding: 25px 30px;
                }

                .dev-content {
                    padding: 25px 30px;
                }

                .dev-name {
                    font-size: 1.6rem;
                }

                .dev-stats-grid {
                    grid-template-columns: 1fr;
                }

                .dev-footer {
                    padding: 15px 30px;
                }
            }

            @media (max-width: 576px) {
                .profil-pengembang .section-title h2 {
                    font-size: 1.6rem;
                }

                .dev-avatar-wrapper {
                    width: 100px;
                    height: 100px;
                }

                .dev-avatar-default {
                    font-size: 2.5rem;
                }

                .dev-name {
                    font-size: 1.4rem;
                }

                .dev-bio {
                    font-size: 0.9rem;
                    flex-direction: column;
                    gap: 5px;
                }

                .dev-social-card {
                    padding: 12px;
                }

                .dev-footer-content {
                    flex-direction: column;
                    gap: 10px;
                }
            }

            /* Efek Hover Section */
            .dev-about-section:hover,
            .dev-social-section:hover,
            .dev-tech-section:hover {
                border-color: #93c5fd;
                box-shadow: 0 8px 20px rgba(59, 130, 246, 0.08);
            }

            /* ====== HERO SLIDER & FLOATING CARDS ====== */
            .hero-visual {
                position: relative;
                height: 600px;
            }

            .hero-slider-container {
                position: relative;
                width: 100%;
                height: 100%;
                border-radius: 20px;
                overflow: hidden;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            }

            .hero-slider-wrapper {
                position: relative;
                width: 100%;
                height: 100%;
            }

            .slide {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                opacity: 0;
                transition: opacity 0.8s ease;
            }

            .slide.active {
                opacity: 1;
            }

            .slider-img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center;
                border-radius: 20px;
            }

            /* ====== FLOATING CARDS DENGAN ANIMASI MELAYANG YANG LEBIH BAGUS ====== */
            .floating-card {
                position: absolute;
                background: var(--surface-color, white);
                padding: 1.5rem;
                border-radius: 16px;
                box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                z-index: 10;
                /* ANIMASI MELAYANG YANG LEBIH BAGUS DENGAN ROTASI */
                animation: floatCardAdvanced 4s ease-in-out infinite;
                transition: all 0.3s ease;
            }

            /* ANIMASI YANG LEBIH BAGUS: dengan rotasi ringan */
            @keyframes floatCardAdvanced {

                0%,
                100% {
                    transform: translateY(0px) rotate(0deg);
                }

                25% {
                    transform: translateY(-10px) rotate(0.5deg);
                }

                75% {
                    transform: translateY(-5px) rotate(-0.5deg);
                }
            }

            /* Efek hover yang lebih smooth */
            .floating-card:hover {
                animation-play-state: paused;
                transform: translateY(-8px) rotate(0.5deg) scale(1.03);
                box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
                border-color: rgba(255, 255, 255, 0.3);
            }

            /* Appointment Card */
            .appointment-card {
                top: 30px;
                right: 30px;
                display: flex;
                align-items: center;
                gap: 1rem;
                min-width: 220px;
                animation-delay: 0.2s;
            }

            .appointment-card .card-icon {
                width: 50px;
                height: 50px;
                background: rgba(var(--accent-color-rgb, 13, 110, 253), 0.1);
                color: var(--accent-color, #0d6efd);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.25rem;
                flex-shrink: 0;
                transition: transform 0.3s ease;
            }

            .appointment-card:hover .card-icon {
                transform: scale(1.1) rotate(5deg);
            }

            .appointment-card .card-content h6 {
                margin: 0 0 0.25rem 0;
                color: var(--heading-color, #212529);
                font-weight: 600;
                font-size: 0.875rem;
            }

            .appointment-card .card-content p {
                margin: 0 0 0.25rem 0;
                color: var(--default-color, #495057);
                font-weight: 600;
                font-size: 1rem;
            }

            .appointment-card .card-content small {
                color: color-mix(in srgb, var(--default-color, #495057), transparent 40%);
                font-size: 0.75rem;
            }

            /* Rating Card */
            .rating-card {
                bottom: 30px;
                left: 30px;
                text-align: center;
                min-width: 150px;
                animation-delay: 0.5s;
            }

            .rating-card .rating-stars {
                color: #ffc107;
                margin-bottom: 0.5rem;
                display: flex;
                justify-content: center;
                gap: 2px;
            }

            .rating-card .rating-stars i {
                font-size: 1rem;
                transition: transform 0.3s ease;
            }

            .rating-card:hover .rating-stars i {
                transform: scale(1.2);
            }

            .rating-card:hover .rating-stars i:nth-child(2) {
                transition-delay: 0.1s;
            }

            .rating-card:hover .rating-stars i:nth-child(3) {
                transition-delay: 0.2s;
            }

            .rating-card:hover .rating-stars i:nth-child(4) {
                transition-delay: 0.3s;
            }

            .rating-card:hover .rating-stars i:nth-child(5) {
                transition-delay: 0.4s;
            }

            .rating-card .rating-stars i.text-warning {
                color: #ffc107 !important;
            }

            .rating-card .rating-stars i.text-secondary {
                color: #6c757d !important;
                opacity: 0.5;
            }

            .rating-card .card-content h6 {
                margin: 0 0 0.25rem 0;
                color: var(--heading-color, #212529);
                font-weight: 700;
                font-size: 1.125rem;
                transition: transform 0.3s ease;
            }

            .rating-card:hover .card-content h6 {
                transform: scale(1.1);
            }

            .rating-card .card-content small {
                color: color-mix(in srgb, var(--default-color, #495057), transparent 40%);
                font-size: 0.75rem;
            }

            /* Slider Navigation Dots */
            .slider-dots {
                position: absolute;
                bottom: 20px;
                left: 50%;
                transform: translateX(-50%);
                display: flex;
                gap: 10px;
                z-index: 15;
            }

            .dot {
                width: 12px;
                height: 12px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.5);
                border: 2px solid transparent;
                cursor: pointer;
                transition: all 0.3s ease;
                padding: 0;
            }

            .dot.active {
                background: white;
                transform: scale(1.2);
            }

            .dot:hover {
                background: rgba(255, 255, 255, 0.8);
                transform: scale(1.3);
            }

            /* Background Elements dengan animasi yang lebih halus */
            .background-elements {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: -1;
            }

            .background-elements .element {
                position: absolute;
                border-radius: 50%;
                background: var(--accent-color, #0d6efd);
                opacity: 0.1;
                animation: floatElementAdvanced 8s ease-in-out infinite;
            }

            /* Animasi background yang lebih halus */
            @keyframes floatElementAdvanced {

                0%,
                100% {
                    transform: translateY(0) rotate(0deg) scale(1);
                }

                33% {
                    transform: translateY(-15px) rotate(120deg) scale(1.05);
                }

                66% {
                    transform: translateY(-10px) rotate(240deg) scale(0.95);
                }
            }

            .background-elements .element.element-1 {
                width: 200px;
                height: 200px;
                top: -50px;
                left: -50px;
                animation-delay: 0s;
            }

            .background-elements .element.element-2 {
                width: 150px;
                height: 150px;
                bottom: -30px;
                right: -30px;
                animation-delay: 2.5s;
            }

            .background-elements .element.element-3 {
                width: 100px;
                height: 100px;
                top: 50%;
                left: -25px;
                transform: translateY(-50%);
                animation-delay: 5s;
            }

            /* Responsive */
            @media (max-width: 992px) {
                .hero-visual {
                    height: 400px;
                }

                .appointment-card {
                    top: 20px;
                    right: 20px;
                    padding: 1rem;
                    min-width: 200px;
                }

                .rating-card {
                    bottom: 20px;
                    left: 20px;
                    padding: 1rem;
                    min-width: 140px;
                }

                /* Animasi lebih kecil di tablet */
                @keyframes floatCardAdvanced {

                    0%,
                    100% {
                        transform: translateY(0px) rotate(0deg);
                    }

                    25% {
                        transform: translateY(-8px) rotate(0.3deg);
                    }

                    75% {
                        transform: translateY(-4px) rotate(-0.3deg);
                    }
                }
            }

            @media (max-width: 576px) {
                .hero-visual {
                    height: 300px;
                }

                .appointment-card {
                    top: 15px;
                    right: 15px;
                    padding: 12px;
                    min-width: 180px;
                    flex-direction: column;
                    text-align: center;
                    gap: 0.75rem;
                }

                .appointment-card .card-icon {
                    width: 40px;
                    height: 40px;
                    font-size: 1rem;
                }

                .rating-card {
                    bottom: 15px;
                    left: 15px;
                    padding: 12px;
                    min-width: 130px;
                }

                .slider-dots {
                    bottom: 15px;
                }

                .dot {
                    width: 10px;
                    height: 10px;
                }

                /* Animasi lebih kecil di mobile */
                @keyframes floatCardAdvanced {

                    0%,
                    100% {
                        transform: translateY(0px) rotate(0deg);
                    }

                    25% {
                        transform: translateY(-6px) rotate(0.2deg);
                    }

                    75% {
                        transform: translateY(-3px) rotate(-0.2deg);
                    }
                }
            }

            /* ====== TESTIMONIALS SWIPER STYLES ====== */
            .testimonials {
                padding: 60px 0;
                background: var(--surface-color);
            }

            .testimonials .section-title {
                margin-bottom: 50px;
                text-align: center;
            }

            .testimonials .section-title h2 {
                color: var(--heading-color);
                font-weight: 700;
                margin-bottom: 15px;
            }

            .testimonials .section-title p {
                color: var(--default-color);
                font-size: 1.1rem;
                max-width: 700px;
                margin: 0 auto;
            }

            /* Swiper Container */
            .testimonials-14 {
                position: relative;
                padding-bottom: 40px;
                overflow: visible !important;
            }

            /* Testimonial Item - MENGGUNAKAN STYLE TEMPLATE */
            .testimonial-item {
                background-color: #f4f4f4 !important;
                /* HAPUS INI: border: 1px solid #e5e7eb; */
                border: none;
                /* Atau ganti dengan ini */
                outline: none;
                /* Biar aman */
                padding: 30px;
                margin-bottom: 20px;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
                height: 100%;
                min-height: 280px;
                display: flex;
                flex-direction: column;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .swiper-slide-active .testimonial-item {
                transform: translateY(-5px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            }

            /* Rating Stars */
            .testimonial-item .stars {
                margin-bottom: 15px;
                color: #FFD700;
                display: flex;
            }

            .testimonial-item .stars i {
                margin-right: 2px;
                font-size: 1rem;
            }

            .testimonial-item .stars i.text-warning {
                color: #FFD700;
            }

            .testimonial-item .stars i.text-muted {
                color: color-mix(in srgb, var(--default-color), transparent 70%);
                opacity: 0.5;
            }

            /* Testimoni Text */
            .testimonial-item p {
                font-size: 16px;
                line-height: 1.6;
                margin-bottom: 25px;
                color: var(--default-color);
                font-style: italic;
                flex: 1;
            }

            /* Testimonial Footer */
            .testimonial-item .testimonial-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: auto;
            }

            .testimonial-item .testimonial-footer .testimonial-author {
                display: flex;
                align-items: center;
            }

            /* Avatar Circle */
            .avatar-circle {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                object-fit: cover;
                margin-right: 15px;
                border: 3px solid color-mix(in srgb, var(--accent-color), transparent 80%);
                background: linear-gradient(135deg, var(--accent-color) 0%, color-mix(in srgb, var(--accent-color), var(--surface-color) 30%) 100%);
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 600;
                font-size: 1.2rem;
            }

            .avatar-circle i {
                font-size: 1.5rem;
            }

            .testimonial-item .testimonial-footer .testimonial-author div h5 {
                margin: 0 0 5px;
                font-size: 18px;
                font-weight: 600;
                color: var(--heading-color);
            }

            .testimonial-item .testimonial-footer .testimonial-author div span {
                font-size: 14px;
                color: color-mix(in srgb, var(--default-color), transparent 30%);
            }

            .testimonial-item .testimonial-footer .quote-icon {
                font-size: 36px;
                color: color-mix(in srgb, var(--accent-color), transparent 70%);
                line-height: 1;
            }

            .testimonial-item .testimonial-footer .quote-icon i {
                transform: scaleX(-1);
            }

            /* Swiper Pagination - Versi Fix */
            .swiper-pagination {
                position: relative;
                margin-top: 25px;
                display: flex;
                justify-content: center;
                align-items: center;
                gap: -5px;
                /* JARAK LEBIH DEKAT */
            }

            /* Bullet biasa */
            .swiper-pagination-bullet {
                width: 8px;
                height: 8px;
                border-radius: 50%;
                background: #6c757d;
                /* ABU LEBIH PEKAT */
                opacity: 0.3;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            /* Bullet aktif */
            .swiper-pagination-bullet-active {
                width: 18px;
                /* Agak lonjong */
                height: 6px;
                border-radius: 3px;
                /* Sedikit lonjong */
                background: var(--accent-color, #0d6efd);
                /* Biru template */
                opacity: 1;
            }

            /* Empty Testimonial State */
            .no-testimonial-box {
                background: linear-gradient(135deg,
                        color-mix(in srgb, var(--accent-color), transparent 95%) 0%,
                        color-mix(in srgb, var(--surface-color), transparent 10%) 100%);
                border: 2px dashed color-mix(in srgb, var(--accent-color), transparent 70%);
                border-radius: 12px;
                max-width: 600px;
                margin: 0 auto;
            }

            .icon-placeholder i {
                color: color-mix(in srgb, var(--accent-color), transparent 40%);
                opacity: 0.7;
            }

            .no-testimonial-box h4 {
                color: var(--heading-color);
                font-weight: 700;
            }

            .no-testimonial-box p {
                color: var(--default-color);
                max-width: 500px;
                margin: 0 auto;
                opacity: 0.8;
            }

            /* Responsive Styles */
            @media (max-width: 768px) {
                .testimonials {
                    padding: 40px 0;
                }

                .testimonial-item {
                    padding: 25px 20px;
                    min-height: 260px;
                }

                .testimonial-item p {
                    font-size: 15px;
                    margin-bottom: 20px;
                }

                .avatar-circle {
                    width: 45px;
                    height: 45px;
                    font-size: 1.1rem;
                }

                .testimonial-item .testimonial-footer .testimonial-author div h5 {
                    font-size: 16px;
                }

                .testimonial-item .testimonial-footer .testimonial-author div span {
                    font-size: 13px;
                }

                .testimonial-item .testimonial-footer .quote-icon {
                    font-size: 30px;
                }
            }

            @media (max-width: 576px) {
                .testimonial-item {
                    padding: 20px 15px;
                    min-height: 240px;
                }

                .avatar-circle {
                    width: 40px;
                    height: 40px;
                    margin-right: 10px;
                    font-size: 1rem;
                }

                .testimonial-item .stars i {
                    font-size: 0.9rem;
                }
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Hero Slider
                const slides = document.querySelectorAll('.slide');
                const dots = document.querySelectorAll('.dot');

                if (slides.length === 0) return;

                let currentSlide = 0;
                let slideInterval;

                function showSlide(index) {
                    // Sembunyikan semua slides
                    slides.forEach(slide => slide.classList.remove('active'));

                    // Non-aktifkan semua dots
                    dots.forEach(dot => dot.classList.remove('active'));

                    // Tampilkan slide yang dipilih
                    currentSlide = index;
                    slides[currentSlide].classList.add('active');

                    // Aktifkan dot yang sesuai
                    if (dots[currentSlide]) {
                        dots[currentSlide].classList.add('active');
                    }
                }

                function nextSlide() {
                    let nextIndex = (currentSlide + 1) % slides.length;
                    showSlide(nextIndex);
                }

                function startAutoSlide() {
                    if (slides.length > 1) {
                        slideInterval = setInterval(nextSlide, 5000); // Ganti setiap 5 detik
                    }
                }

                // Dot click event
                dots.forEach((dot, index) => {
                    dot.addEventListener('click', function() {
                        clearInterval(slideInterval);
                        showSlide(index);
                        startAutoSlide();
                    });
                });

                // Pause on hover
                const sliderContainer = document.querySelector('.hero-slider-container');
                if (sliderContainer) {
                    sliderContainer.addEventListener('mouseenter', function() {
                        clearInterval(slideInterval);
                    });

                    sliderContainer.addEventListener('mouseleave', startAutoSlide);
                }

                // Initialize
                showSlide(0);
                startAutoSlide();

                console.log('Slider initialized with', slides.length, 'images');
            });
        </script>
    @endsection
