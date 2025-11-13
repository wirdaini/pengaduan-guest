@extends('layouts.guest.app')

@section('title', 'Tentang Kami - Bina Desa')

@section('content')

    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Tentang Kami</h1>
                            <p class="mb-0">
                                Platform pengaduan warga untuk pembangunan desa yang lebih baik.
                                Kami hadir sebagai jembatan antara masyarakat dan pemerintah desa
                                dalam menciptakan perubahan positif.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
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
