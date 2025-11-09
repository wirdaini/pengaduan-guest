@extends('layouts.app')

@section('title', 'Layanan - Bina Desa')

@section('content')

    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Layanan</h1>
                            <p class="mb-0">
                                Berbagai layanan unggulan yang kami sediakan untuk mendukung pembangunan desa
                                dan kesejahteraan masyarakat. Setiap layanan dirancang untuk memenuhi kebutuhan
                                warga secara komprehensif.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="current">Layanan</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Services Section -->
        <section id="services" class="services section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item">
                            <div class="service-image">
                                <img src="{{asset('assets/img/desa/services1.jpg')}}" alt="Layanan Infrastruktur" class="img-fluid">
                                <div class="service-overlay">
                                    <i class="fas fa-tools"></i>
                                </div>
                            </div>
                            <div class="service-content">
                                <h3>Infrastruktur Desa</h3>
                                <p>Penanganan komprehensif untuk masalah infrastruktur desa seperti jalan,
                                    jembatan, dan fasilitas umum dengan pendekatan solutif.</p>
                                <div class="service-features">
                                    <span class="feature-item"><i class="fas fa-check"></i> Perbaikan Jalan</span>
                                    <span class="feature-item"><i class="fas fa-check"></i> Pembangunan Fasilitas</span>
                                </div>
                                <a href="service-details.html" class="service-btn">
                                    <span>Selengkapnya</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="service-item">
                            <div class="service-image">
                                <img src="{{asset('assets/img/desa/services2.jpg')}}" alt="Layanan Lingkungan" class="img-fluid">
                                <div class="service-overlay">
                                    <i class="fas fa-tree"></i>
                                </div>
                            </div>
                            <div class="service-content">
                                <h3>Lingkungan & Kebersihan</h3>
                                <p>Penanganan masalah lingkungan dan kebersihan desa dengan pendekatan
                                    inovatif untuk lingkungan yang sehat.</p>
                                <div class="service-features">
                                    <span class="feature-item"><i class="fas fa-check"></i> Pengelolaan Sampah</span>
                                    <span class="feature-item"><i class="fas fa-check"></i> Penghijauan</span>
                                </div>
                                <a href="service-details.html" class="service-btn">
                                    <span>Selengkapnya</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item">
                            <div class="service-image">
                                <img src="{{asset('assets/img/desa/services3.jpg')}}" alt="Layanan Air Bersih"
                                    class="img-fluid">
                                <div class="service-overlay">
                                    <i class="fas fa-tint"></i>
                                </div>
                            </div>
                            <div class="service-content">
                                <h3>Air Bersih & Sanitasi</h3>
                                <p>Layanan penyediaan air bersih dan sanitasi yang layak untuk mendukung
                                    kesehatan dan kenyamanan warga.</p>
                                <div class="service-features">
                                    <span class="feature-item"><i class="fas fa-check"></i> Penyediaan Air</span>
                                    <span class="feature-item"><i class="fas fa-check"></i> Sanitasi Lingkungan</span>
                                </div>
                                <a href="service-details.html" class="service-btn">
                                    <span>Selengkapnya</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="350">
                        <div class="service-item">
                            <div class="service-image">
                                <img src="{{asset('assets/img/desa/services4.jpg')}}" alt="Layanan Energi" class="img-fluid">
                                <div class="service-overlay">
                                    <i class="fas fa-bolt"></i>
                                </div>
                            </div>
                            <div class="service-content">
                                <h3>Energi & Penerangan</h3>
                                <p>Layanan penyediaan energi dan penerangan desa untuk mendukung aktivitas
                                    warga dan meningkatkan keamanan.</p>
                                <div class="service-features">
                                    <span class="feature-item"><i class="fas fa-check"></i> Penerangan Jalan</span>
                                    <span class="feature-item"><i class="fas fa-check"></i> Energi Terbarukan</span>
                                </div>
                                <a href="service-details.html" class="service-btn">
                                    <span>Selengkapnya</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item">
                            <div class="service-image">
                                <img src="{{asset('assets/img/desa/services5.jpg')}}" alt="Layanan Darurat" class="img-fluid">
                                <div class="service-overlay">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                            </div>
                            <div class="service-content">
                                <h3>Keamanan & Ketertiban</h3>
                                <p>Layanan penjagaan keamanan dan ketertiban desa untuk menciptakan lingkungan
                                    yang aman dan nyaman.
                                </p>
                                <div class="service-features">
                                    <span class="feature-item"><i class="fas fa-check"></i> Patroli Keamanan</span>
                                    <span class="feature-item"><i class="fas fa-check"></i> Sistem Pengawasan</span>
                                </div>
                                <a href="service-details.html" class="service-btn">
                                    <span>Selengkapnya</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="450">
                        <div class="service-item">
                            <div class="service-image">
                                <img src="{{asset('assets/img/desa/services6.jpg')}}" alt="Layanan Administrasi"
                                    class="img-fluid">
                                <div class="service-overlay">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                            </div>
                            <div class="service-content">
                                <h3>Pelayanan Administrasi</h3>
                                <p>Layanan administrasi dan dokumen kependudukan dengan proses yang cepat
                                    dan pelayanan yang ramah.</p>
                                <div class="service-features">
                                    <span class="feature-item"><i class="fas fa-check"></i> Surat Menyurat</span>
                                    <span class="feature-item"><i class="fas fa-check"></i> Dokumen Kependudukan</span>
                                </div>
                                <a href="service-details.html" class="service-btn">
                                    <span>Selengkapnya</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>

        </section><!-- /Services Section -->

    </main>

    @endsection
