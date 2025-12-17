@extends('layouts.guest.app')

@include('layouts.guest.css')

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
                                    <h3><span data-purecounter-start="0" data-purecounter-end="500"
                                            data-purecounter-duration="2" class="purecounter"></span>+</h3>
                                    <p>Pengaduan Diselesaikan</p>
                                </div>
                                <div class="stat-item">
                                    <h3><span data-purecounter-start="0" data-purecounter-end="95"
                                            data-purecounter-duration="2" class="purecounter"></span>%</h3>
                                    <p>Kepuasan Warga</p>
                                </div>
                                <div class="stat-item">
                                    <h3><span data-purecounter-start="0" data-purecounter-end="15"
                                            data-purecounter-duration="2" class="purecounter"></span>+</h3>
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
                            <div class="main-image">
                                <img src="{{ asset('assets/img/desa/home1.jpg') }}" alt="Modern Healthcare Facility"
                                    class="img-fluid">
                                <div class="floating-card appointment-card">
                                    <div class="card-icon">
                                        <i class="bi bi-calendar-check"></i>
                                    </div>
                                    <div class="card-content">
                                        <h6>Pengaduan Terbaru</h6>
                                        <p>Hari Ini 14:30</p>
                                        <small>Jalan Rusak RT 05</small>
                                    </div>
                                </div>
                                <div class="floating-card rating-card">
                                    <div class="card-content">
                                        <div class="rating-stars">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                        </div>
                                        <h6>4.9/5</h6>
                                        <small>1,234 Reviews</small>
                                    </div>
                                </div>
                            </div>
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
                                        data-purecounter-end="15000" data-purecounter-duration="1"></div>
                                    <div class="stat-label">Warga Terlayani</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number purecounter" data-purecounter-start="0"
                                        data-purecounter-end="25" data-purecounter-duration="1"></div>
                                    <div class="stat-label">Tahun Pengalaman</div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-number purecounter" data-purecounter-start="0"
                                        data-purecounter-end="50" data-purecounter-duration="1"></div>
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
                                    <span class="years">25+</span>
                                    <span class="text">Tahun Terpercaya</span>
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



        <!-- Call To Action Section -->
        <section id="call-to-action" class="call-to-action section light-background">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="hero-content">
                    <div class="row align-items-center">

                        <div class="col-lg-6">
                            <div class="content-wrapper" data-aos="fade-up" data-aos-delay="200">
                                <h1>Komitmen untuk Pembangunan Desa yang Lebih Baik</h1>
                                <p>Kami berdedikasi memberikan pelayanan terbaik untuk kemajuan desa. Setiap pengaduan
                                    warga menjadi prioritas kami dalam menciptakan lingkungan yang lebih sejahtera dan
                                    nyaman.
                                </p>

                                <div class="cta-wrapper">
                                    <a href="{{ route('pengaduan.create') }}" class="primary-cta">
                                        <span>Ajukan Pengaduan</span>
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                    <a href="{{ route('services') }}" class="secondary-cta">
                                        <span>Lihat Layanan</span>
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="image-container" data-aos="fade-left" data-aos-delay="300">
                                <img src="{{ asset('assets/img/desa/home2.jpg') }}" alt="Pembangunan Desa"
                                    class="img-fluid">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="features-section">

                    <div class="row g-0">

                        <div class="col-lg-4">
                            <div class="feature-block" data-aos="fade-up" data-aos-delay="200">
                                <div class="feature-icon">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <h3>Pelayanan Terpercaya</h3>
                                <p>Setiap pengaduan ditangani dengan serius dan transparan untuk memastikan
                                    solusi terbaik bagi warga dan pembangunan desa.</p>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="feature-block" data-aos="fade-up" data-aos-delay="300">
                                <div class="feature-icon">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <h3>Layanan 24/7</h3>
                                <p>Tim kami siap membantu kapan saja untuk menangani pengaduan darurat
                                    dan masalah mendesak yang membutuhkan penanganan cepat.</p>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="feature-block" data-aos="fade-up" data-aos-delay="400">
                                <div class="feature-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <h3>Tim Berpengalaman</h3>
                                <p>Didukung oleh tim profesional yang berpengalaman dalam menangani
                                    berbagai masalah pembangunan dan pelayanan desa.</p>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="contact-block">
                    <div class="row">

                        <div class="col-lg-8">
                            <div class="contact-content" data-aos="fade-up" data-aos-delay="200">
                                <h2>Butuh Bantuan Segera?</h2>
                                <p>Tim darurat kami siap memberikan penanganan cepat untuk masalah mendesak
                                    yang membutuhkan tindakan segera demi kenyamanan warga.</p>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="contact-actions" data-aos="fade-up" data-aos-delay="300">
                                <a href="tel:0211234567" class="emergency-call">
                                    <i class="bi bi-telephone"></i>
                                    <span>(021) 123-4567</span>
                                </a>
                                <a href="{{ route('contact') }}" class="contact-link">Hubungi Kami</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </section><!-- /Call To Action Section -->

        <!-- Profil Pengembang -->
        <section class="profil-pengembang py-5">
            <div class="container">
                <div class="dev-card">
                    <!-- Header -->
                    <div class="dev-header">
                        <div class="dev-header-pattern"></div>

                        <!-- Area Profil -->
                        <div class="dev-profile-area">
                            <!-- Foto Profil -->
                            <div class="dev-avatar-wrapper">
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

                            <!-- Info -->
                            <div class="dev-profile-info">
                                <h1 class="dev-name">Wirda Aini Maqhfiroh</h1>
                                <p class="dev-username">@wirdaini678</p>
                                <p class="dev-bio">
                                    <i class="bi bi-code-slash"></i>
                                    Full Stack Developer • Sistem Bina Desa
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Konten Utama -->
                    <div class="dev-content">
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
                        </div>

                        <!-- Tentang -->
                        <div class="dev-about-section">
                            <div class="dev-section-title">
                                <i class="bi bi-person-lines-fill"></i>
                                <span>Tentang Saya</span>
                            </div>
                            <p class="dev-about-text">
                                Pengembang yang passionate dalam menciptakan solusi digital untuk pembangunan desa.
                                Membangun Sistem Bina Desa untuk meningkatkan pelayanan desa melalui teknologi.
                            </p>
                        </div>

                        <!-- Link Sosial Media -->
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

                                <!-- Twitter/X -->
                                <a href="https://twitter.com/wirdaa123" class="dev-social-card" target="_blank">
                                    <div class="dev-social-icon dev-twitter">
                                        <i class="bi bi-twitter-x"></i>
                                    </div>
                                    <div class="dev-social-info">
                                        <div class="dev-social-title">Twitter/X</div>
                                        <div class="dev-social-desc">@wirdaa123</div>
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
                                <span class="dev-tech-tag">Laravel</span>
                                <span class="dev-tech-tag">Bootstrap</span>
                                <span class="dev-tech-tag">MySQL</span>
                                <span class="dev-tech-tag">JavaScript</span>
                                <span class="dev-tech-tag">Git</span>
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
                                <div class="dev-footer-title">Sistem Bina Desa</div>
                                <div class="dev-footer-subtitle">Dibangun dengan passion untuk pembangunan desa</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <style>
            /* ====== HANYA UNTUK PROFIL PENGEMBANG ====== */
            .profil-pengembang {
                background: #0d1117;
                padding: 80px 0;
            }

            .dev-card {
                background: #161b22;
                border-radius: 16px;
                border: 1px solid #30363d;
                overflow: hidden;
                max-width: 900px;
                margin: 0 auto;
            }

            /* Header */
            .dev-header {
                background: #0d1117;
                padding: 40px;
                position: relative;
                border-bottom: 1px solid #30363d;
            }

            .dev-header-pattern {
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                opacity: 0.1;
                background:
                    radial-gradient(circle at 20% 80%, rgba(88, 166, 255, 0.3) 0%, transparent 50%),
                    radial-gradient(circle at 80% 20%, rgba(247, 129, 102, 0.3) 0%, transparent 50%);
            }

            .dev-profile-area {
                display: flex;
                align-items: center;
                gap: 30px;
                position: relative;
                z-index: 2;
            }

            .dev-avatar-wrapper {
                position: relative;
                width: 140px;
                height: 140px;
                flex-shrink: 0;
            }

            .dev-avatar {
                width: 100%;
                height: 100%;
                border-radius: 50%;
                border: 4px solid #30363d;
                background: #161b22;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            }

            .dev-avatar-default {
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, #21262d 0%, #0d1117 100%);
                border-radius: 50%;
                border: 4px solid #30363d;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #58a6ff;
                font-size: 3.5rem;
            }

            .dev-status-online {
                position: absolute;
                bottom: 10px;
                right: 10px;
                width: 20px;
                height: 20px;
                background: #238636;
                border-radius: 50%;
                border: 3px solid #161b22;
            }

            .dev-profile-info {
                flex: 1;
            }

            .dev-name {
                color: #f0f6fc;
                font-size: 2.2rem;
                font-weight: 700;
                margin: 0 0 5px 0;
            }

            .dev-username {
                color: #8b949e;
                font-size: 1.2rem;
                margin: 0 0 15px 0;
                font-weight: 400;
            }

            .dev-bio {
                color: #c9d1d9;
                font-size: 1.1rem;
                margin: 0;
                display: flex;
                align-items: center;
                gap: 8px;
            }

            .dev-bio i {
                color: #58a6ff;
            }

            /* Konten */
            .dev-content {
                padding: 40px;
            }

            /* Statistik */
            .dev-stats-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 20px;
                margin-bottom: 40px;
            }

            .dev-stat-item {
                background: #0d1117;
                border: 1px solid #30363d;
                border-radius: 12px;
                padding: 20px;
                display: flex;
                align-items: center;
                gap: 15px;
            }

            .dev-stat-icon {
                width: 50px;
                height: 50px;
                background: #21262d;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #58a6ff;
                font-size: 1.5rem;
                flex-shrink: 0;
            }

            .dev-stat-details {
                flex: 1;
            }

            .dev-stat-number {
                color: #f0f6fc !important;
                font-size: 1.4rem !important;
                font-weight: 600 !important;
                margin-bottom: 5px !important;
            }

            .dev-stat-label {
                color: #8b949e !important;
                font-size: 0.9rem !important;
            }

            /* Section Title */
            .dev-section-title {
                display: flex;
                align-items: center;
                gap: 10px;
                color: #f0f6fc;
                font-size: 1.2rem;
                font-weight: 600;
                margin-bottom: 20px;
            }

            .dev-section-title i {
                color: #58a6ff;
                font-size: 1.3rem;
            }

            /* Tentang */
            .dev-about-section {
                margin-bottom: 40px;
            }

            .dev-about-text {
                color: #c9d1d9;
                line-height: 1.7;
                font-size: 1.05rem;
                padding: 20px;
                background: rgba(13, 17, 23, 0.5);
                border-radius: 12px;
                border: 1px solid #30363d;
            }

            /* Sosial Media */
            .dev-social-section {
                margin-bottom: 40px;
            }

            .dev-social-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 15px;
            }

            .dev-social-card {
                background: #0d1117;
                border: 1px solid #30363d;
                border-radius: 12px;
                padding: 20px;
                display: flex;
                align-items: center;
                gap: 15px;
                text-decoration: none;
            }

            .dev-social-icon {
                width: 50px;
                height: 50px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.5rem;
                flex-shrink: 0;
            }

            .dev-github {
                background: rgba(88, 166, 255, 0.1);
                color: #58a6ff;
            }

            .dev-linkedin {
                background: rgba(10, 102, 194, 0.1);
                color: #0a66c2;
            }

            .dev-instagram {
                background: linear-gradient(45deg, rgba(225, 48, 108, 0.1), rgba(251, 180, 53, 0.1));
                color: #e1306c;
            }

            .dev-twitter {
                background: rgba(0, 0, 0, 0.1);
                color: #000;
            }

            .dev-email {
                background: rgba(234, 67, 53, 0.1);
                color: #ea4335;
            }

            .dev-social-info {
                flex: 1;
            }

            .dev-social-title {
                color: #f0f6fc;
                font-weight: 600;
                margin-bottom: 5px;
                font-size: 1.1rem;
            }

            .dev-social-desc {
                color: #8b949e;
                font-size: 0.9rem;
            }

            .dev-social-arrow {
                color: #58a6ff;
            }

            /* Teknologi */
            .dev-tech-section {
                margin-bottom: 30px;
            }

            .dev-tech-tags {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }

            .dev-tech-tag {
                background: rgba(88, 166, 255, 0.1);
                color: #58a6ff;
                padding: 8px 16px;
                border-radius: 20px;
                font-size: 0.9rem;
                font-weight: 500;
                border: 1px solid rgba(88, 166, 255, 0.2);
            }

            /* Footer */
            .dev-footer {
                background: #0d1117;
                padding: 25px 40px;
                border-top: 1px solid #30363d;
                text-align: center;
            }

            .dev-footer-content {
                display: inline-flex;
                align-items: center;
                gap: 15px;
            }

            .dev-footer-icon {
                width: 40px;
                height: 40px;
                background: rgba(247, 129, 102, 0.1);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #f78166;
                font-size: 1.2rem;
            }

            .dev-footer-text {
                flex: 1;
            }

            .dev-footer-title {
                color: #f0f6fc;
                font-weight: 600;
                margin-bottom: 5px;
            }

            .dev-footer-subtitle {
                color: #8b949e;
                font-size: 0.9rem;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .dev-profile-area {
                    flex-direction: column;
                    text-align: center;
                    gap: 20px;
                }

                .dev-content {
                    padding: 30px 20px;
                }

                .dev-stats-grid,
                .dev-social-grid {
                    grid-template-columns: 1fr;
                }

                .dev-name {
                    font-size: 1.8rem;
                }

                .dev-avatar-wrapper {
                    width: 120px;
                    height: 120px;
                }
            }
        </style>
    </main>
@endsection
