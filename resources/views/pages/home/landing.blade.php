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

    </main>
@endsection
