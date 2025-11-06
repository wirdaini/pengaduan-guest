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
                        <h1 class="heading-title">Layanan Kami</h1>
                        <p class="mb-0">
                            Berbagai layanan yang kami sediakan untuk mendukung pembangunan desa
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
    <section class="section">
        <div class="container">
            <!-- Main Services -->
            <div class="row mb-5">
                <div class="col-12 text-center mb-4">
                    <h2>Layanan Utama</h2>
                    <p class="text-muted">Fitur utama yang membuat pengelolaan desa lebih efektif</p>
                </div>

                <!-- Service 1 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-card text-center p-4">
                        <div class="service-icon mb-3">
                            <i class="bi bi-megaphone display-4"></i>
                        </div>
                        <h4>Pengaduan Warga</h4>
                        <p class="text-muted">
                            Saluran resmi untuk menyampaikan keluhan, aspirasi, dan masukan
                            terkait pembangunan desa secara online.
                        </p>
                        <ul class="text-start text-muted">
                            <li>Pengaduan infrastruktur</li>
                            <li>Aspirasi pembangunan</li>
                            <li>Laporan lingkungan</li>
                            <li>Keluhan pelayanan</li>
                        </ul>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-card text-center p-4">
                        <div class="service-icon mb-3">
                            <i class="bi bi-clock-history display-4"></i>
                        </div>
                        <h4>Tracking Pengaduan</h4>
                        <p class="text-muted">
                            Pantau progress pengaduan Anda secara real-time dari proses hingga penyelesaian.
                        </p>
                        <ul class="text-start text-muted">
                            <li>Status real-time</li>
                            <li>Notifikasi update</li>
                            <li>Histori lengkap</li>
                            <li>Estimasi waktu</li>
                        </ul>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-card text-center p-4">
                        <div class="service-icon mb-3">
                            <i class="bi bi-graph-up display-4"></i>
                        </div>
                        <h4>Data & Analytics</h4>
                        <p class="text-muted">
                            Dashboard lengkap untuk memantau perkembangan pembangunan desa
                            berdasarkan data pengaduan.
                        </p>
                        <ul class="text-start text-muted">
                            <li>Statistik pengaduan</li>
                            <li>Trend pembangunan</li>
                            <li>Area prioritas</li>
                            <li>Laporan periodik</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Additional Services -->
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h2>Layanan Pendukung</h2>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="support-service text-center p-3">
                        <div class="support-icon mb-2">
                            <i class="bi bi-phone display-6"></i>
                        </div>
                        <h5>Akses Mobile</h5>
                        <p class="text-muted small">Akses layanan melalui smartphone dimanapun</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="support-service text-center p-3">
                        <div class="support-icon mb-2">
                            <i class="bi bi-shield-check display-6"></i>
                        </div>
                        <h5>Keamanan Data</h5>
                        <p class="text-muted small">Data pribadi warga terlindungi dengan aman</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="support-service text-center p-3">
                        <div class="support-icon mb-2">
                            <i class="bi bi-headset display-6"></i>
                        </div>
                        <h5>Bantuan 24/7</h5>
                        <p class="text-muted small">Tim support siap membantu kapan saja</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="support-service text-center p-3">
                        <div class="support-icon mb-2">
                            <i class="bi bi-file-text display-6"></i>
                        </div>
                        <h5>Dokumentasi</h5>
                        <p class="text-muted small">Arsip lengkap semua pengaduan dan solusi</p>
                    </div>
                </div>
            </div>

            <!-- How It Works -->
            <div class="row bg-light rounded p-5 mt-4">
                <div class="col-12 text-center mb-4">
                    <h3>Cara Kerja Layanan</h3>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-3">
                    <div class="step-number">1</div>
                    <h5>Ajukan Pengaduan</h5>
                    <p class="text-muted small">Isi form pengaduan dengan detail lengkap</p>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-3">
                    <div class="step-number">2</div>
                    <h5>Verifikasi Data</h5>
                    <p class="text-muted small">Tim verifikasi memvalidasi kelayakan pengaduan</p>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-3">
                    <div class="step-number">3</div>
                    <h5>Proses Penanganan</h5>
                    <p class="text-muted small">Pengaduan ditangani oleh unit terkait</p>
                </div>
                <div class="col-lg-3 col-md-6 text-center mb-3">
                    <div class="step-number">4</div>
                    <h5>Selesai & Feedback</h5>
                    <p class="text-muted small">Pengaduan selesai dan feedback diberikan</p>
                </div>
            </div>
        </div>
    </section><!-- /Services Section -->

</main>

<style>
.service-card {
    border: 1px solid #e9ecef;
    border-radius: 10px;
    transition: transform 0.3s ease;
    height: 100%;
    background: white;
}
.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
.support-service {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    transition: all 0.3s ease;
}
.support-service:hover {
    background: white;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.step-number {
    width: 50px;
    height: 50px;
    background: #6c757d;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    font-size: 1.5rem;
    font-weight: bold;
}
.service-icon, .support-icon {
    color: #6c757d;
}
</style>
@endsection
