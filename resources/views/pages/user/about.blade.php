@extends('layouts.app')

@section('title', 'Tentang Kami - Bina Desa')

@section('content')
<main class="main">
    <!-- Page Title -->
    <div class="page-title" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title text-white">Tentang Bina Desa</h1>
                        <p class="mb-0 text-light">
                            Platform inovasi untuk memberdayakan partisipasi warga dalam pembangunan desa
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Page Title -->

    <!-- About Content Section -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <h2 class="mb-4">Membangun Desa Lebih Baik Bersama</h2>
                    <p class="lead">
                        Bina Desa adalah platform digital yang menghubungkan warga dengan pemerintah desa
                        dalam proses pembangunan yang transparan dan partisipatif.
                    </p>
                    <p>
                        Melalui sistem pengaduan yang terintegrasi, setiap warga dapat berkontribusi
                        aktif dalam mengawal pembangunan desa menuju kesejahteraan bersama.
                    </p>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    {{-- <div class="about-image text-center">
                        <img src="{{ asset('assets/img/desa-illustration.svg') }}" alt="Desa Illustration"
                             class="img-fluid" style="max-height: 300px;">
                        <small class="text-muted">Ilustrasi Gotong Royong Desa</small>
                    </div> --}}
                </div>
            </div>

            <!-- Features Grid -->
            <div class="row mb-5">
                <div class="col-12 text-center mb-4">
                    <h3>Mengapa Memilih Bina Desa?</h3>
                    <p class="text-muted">Fitur unggulan yang membuat pengaduan lebih efektif</p>
                </div>

                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-megaphone display-4 text-primary"></i>
                        </div>
                        <h5>Aspirasi Terdengar</h5>
                        <p class="text-muted">Setiap suara warga memiliki tempat dan diperhatikan</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-clock-history display-4 text-success"></i>
                        </div>
                        <h5>Proses Cepat</h5>
                        <p class="text-muted">Pengaduan ditindaklanjuti dalam waktu singkat</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-graph-up display-4 text-warning"></i>
                        </div>
                        <h5>Transparan</h5>
                        <p class="text-muted">Progress pengaduan dapat dipantau secara real-time</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-shield-check display-4 text-info"></i>
                        </div>
                        <h5>Aman & Terpercaya</h5>
                        <p class="text-muted">Data warga terlindungi dan terjamin keamanannya</p>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="row bg-light rounded p-5" data-aos="fade-up">
                <div class="col-12 text-center mb-4">
                    <h3>Dampak Positif Kami</h3>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <h2 class="text-primary">500+</h2>
                    <p class="text-muted">Pengaduan Terselesaikan</p>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <h2 class="text-success">95%</h2>
                    <p class="text-muted">Tingkat Kepuasan Warga</p>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <h2 class="text-warning">24/7</h2>
                    <p class="text-muted">Layanan Pelaporan</p>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <h2 class="text-info">15+</h2>
                    <p class="text-muted">Desa Terlayani</p>
                </div>
            </div>
        </div>
    </section><!-- /About Content Section -->

</main>

<style>
.feature-card {
    border: 1px solid #e9ecef;
    border-radius: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
}
.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(255, 255, 255, 0.1);
}
.feature-icon {
    color: #667eea;
}
</style>
@endsection


