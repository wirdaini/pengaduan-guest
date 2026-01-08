@extends('layouts.guest.app')

@section('title', 'Tentang Kami - Bina Desa')

@section('content')

    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
                        <li class="current">Tentang Kami</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row align-items-center">
                    <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                        <div class="about-content">
                            <h2>Pelayanan Terpercaya untuk Setiap Warga</h2>
                            <p class="lead">Selama bertahun-tahun, kami berdedikasi memberikan pelayanan terbaik
                                yang menggabungkan teknologi modern dengan pendekatan personal yang
                                diinginkan oleh warga.</p>

                            <p>Tim multidisiplin kami bekerja sama memastikan setiap pengaduan warga
                                mendapat penanganan komprehensif sesuai kebutuhan unik mereka. Dari
                                layanan dasar hingga masalah kompleks, kami menjaga standar tertinggi
                                pelayanan sambil membangun lingkungan kepercayaan dan solusi.</p>

                            <div class="stats-grid">
                                <div class="stat-item">
                                    <span class="stat-number" data-purecounter-start="0" data-purecounter-end="15000"
                                        data-purecounter-duration="2">15000</span>
                                    <span class="stat-label">Warga Terlayani</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number" data-purecounter-start="0" data-purecounter-end="25"
                                        data-purecounter-duration="2">25</span>
                                    <span class="stat-label">Tahun Pengalaman</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number" data-purecounter-start="0" data-purecounter-end="50"
                                        data-purecounter-duration="2">50</span>
                                    <span class="stat-label">Tim Terlatih</span>
                                </div>
                            </div><!-- End Stats Grid -->
                        </div><!-- End About Content -->
                    </div>

                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                        <div class="image-wrapper">
                            <img src="{{ asset('assets/img/desa/about1.jpg') }}" class="img-fluid main-image"
                                alt="Fasilitas Desa">
                            <div class="floating-image" data-aos="zoom-in" data-aos-delay="400">
                                <img src="{{ asset('assets/img/desa/about2.jpg') }}" class="img-fluid" alt="Tim Desa">
                            </div>
                        </div><!-- End Image Wrapper -->
                    </div>
                </div>

                <div class="values-section" data-aos="fade-up" data-aos-delay="300">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h3>Nilai Inti Kami</h3>
                            <p class="section-description">Prinsip-prinsip ini memandu segala yang kami lakukan
                                dalam komitmen untuk pelayanan terbaik</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="value-item">
                                <div class="value-icon">
                                    <i class="bi bi-heart-pulse"></i>
                                </div>
                                <h4>Peduli</h4>
                                <p>Memberikan pelayanan dengan empati dan pemahaman terhadap kebutuhan
                                    unik setiap warga dan kondisi mereka.</p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="value-item">
                                <div class="value-icon">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <h4>Profesional</h4>
                                <p>Mempertahankan standar tertinggi pelayanan melalui pembelajaran
                                    berkelanjutan dan inovasi.
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="value-item">
                                <div class="value-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <h4>Integritas</h4>
                                <p>Membangun kepercayaan melalui komunikasi jujur dan praktik etis
                                    dalam semua interaksi kami.
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                            <div class="value-item">
                                <div class="value-icon">
                                    <i class="bi bi-lightbulb"></i>
                                </div>
                                <h4>Inovasi</h4>
                                <p>Mengadopsi teknologi dan pendekatan terkini untuk meningkatkan
                                    hasil pembangunan desa.</p>
                            </div>
                        </div>
                    </div><!-- End Values Row -->
                </div><!-- End Values Section -->

                <!-- Logo Meaning Section -->
                <div class="logo-meaning-section section" data-aos="fade-up" data-aos-delay="300">
                    <div class="row align-items-center">
                        <div class="col-lg-12 text-center mb-4">
                            <h3>Makna Logo Sistem Bina Desa</h3>
                            <p class="section-description">
                                Logo Sistem Bina Desa merepresentasikan komitmen terhadap pelayanan publik,
                                keadilan, dan suara masyarakat desa yang disalurkan melalui teknologi.
                            </p>
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-lg-4 text-center mb-4" data-aos="zoom-in">
                            <img src="{{ asset('assets/img/logobdvertikal3.png') }}" class="img-fluid"
                                style="max-width: 250px;" alt="Logo Sistem Bina Desa">
                        </div>

                        <!-- Makna -->
                        <div class="col-lg-8" data-aos="fade-left">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <strong>🔹 Pilar:</strong>
                                    Melambangkan fondasi hukum, stabilitas, dan tata kelola desa yang kokoh
                                    sebagai dasar pelayanan kepada masyarakat.
                                </li>

                                <li class="mb-3">
                                    <strong>🔹 Pena:</strong>
                                    Mewakili suara rakyat, aspirasi warga, serta pengaduan yang disampaikan
                                    secara tertulis dan tercatat secara resmi melalui sistem.
                                </li>

                                <li class="mb-3">
                                    <strong>🔹 Kombinasi Pilar & Pena:</strong>
                                    Menunjukkan sinergi antara kekuatan hukum dan kebebasan masyarakat
                                    dalam menyampaikan pendapat secara bertanggung jawab.
                                </li>

                                <li class="mb-3">
                                    <strong>🔹 Warna Biru & Emas:</strong>
                                    Biru mencerminkan kepercayaan, profesionalisme, dan teknologi,
                                    sementara emas melambangkan nilai, keadilan, dan harapan bagi warga desa.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Logo Meaning Section -->

                <div class="certifications-section" data-aos="fade-up" data-aos-delay="400">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h3>Penghargaan & Sertifikasi</h3>
                            <p class="section-description">Diakui oleh organisasi terkemuka untuk
                                komitmen kami terhadap kualitas pelayanan</p>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-6" data-aos="zoom-in" data-aos-delay="100">
                            <div class="certification-item">
                                <img src="assets/img/clients/clients-1.webp" class="img-fluid" alt="Sertifikasi Desa">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-6" data-aos="zoom-in" data-aos-delay="200">
                            <div class="certification-item">
                                <img src="assets/img/clients/clients-2.webp" class="img-fluid"
                                    alt="Akreditasi Pelayanan">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-6" data-aos="zoom-in" data-aos-delay="300">
                            <div class="certification-item">
                                <img src="assets/img/clients/clients-3.webp" class="img-fluid"
                                    alt="Sertifikasi Pembangunan">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-6" data-aos="zoom-in" data-aos-delay="400">
                            <div class="certification-item">
                                <img src="assets/img/clients/clients-4.webp" class="img-fluid"
                                    alt="Sertifikasi Desa Mandiri">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4 col-6" data-aos="zoom-in" data-aos-delay="500">
                            <div class="certification-item">
                                <img src="assets/img/clients/clients-5.webp" class="img-fluid"
                                    alt="Akreditasi Pelayanan Publik">
                            </div>
                        </div>
                    </div><!-- End Certifications Row -->
                </div><!-- End Certifications Section -->

            </div>

        </section><!-- /About Section -->

    </main>

@endsection

<style>
    /* ===============================
   Logo Meaning Section - Bina Desa
================================= */

    .logo-meaning-section {
        padding: 60px 0;
        background-color: #f8f9fa;
        /* abu lembut khas template */
    }

    .logo-meaning-section h3 {
        font-weight: 700;
        color: #1f2c5c;
        /* biru utama */
        margin-bottom: 10px;
    }

    .logo-meaning-section .section-description {
        max-width: 700px;
        margin: 0 auto 40px;
        color: #6c757d;
        font-size: 16px;
    }

    /* Logo */
    .logo-meaning-section img {
        transition: transform 0.3s ease;
    }

    .logo-meaning-section img:hover {
        transform: scale(1.05);
    }

    /* List Makna */
    .logo-meaning-section ul li {
        background: #ffffff;
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 15px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
        font-size: 15px;
        line-height: 1.6;
    }

    .logo-meaning-section ul li strong {
        color: #1f2c5c;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .logo-meaning-section {
            text-align: center;
        }

        .logo-meaning-section ul {
            padding-left: 0;
        }
    }
</style>
