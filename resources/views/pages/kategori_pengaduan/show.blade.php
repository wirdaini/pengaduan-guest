@extends('layouts.guest.app')

@section('title', 'Detail Kategori Pengaduan - Bina Desa')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Detail Kategori Pengaduan</h1>
                            <p class="mb-0">Informasi lengkap tentang kategori pengaduan</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('kategori_pengaduan.index') }}">Kategori Pengaduan</a></li>
                        <li class="current">Detail Kategori</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Detail Kategori Pengaduan Section -->
        <section id="detail-kategori_pengaduan" class="detail-kategori_pengaduan section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-lg-10">

                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h4 class="card-title mb-0">
                                    <i class="fas fa-tags me-2"></i>Informasi Kategori Pengaduan
                                </h4>
                            </div>
                            <div class="card-body">
                                <!-- Action Buttons -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('kategori_pengaduan.edit', $kategori->kategori_id) }}"
                                                class="btn btn-warning">
                                                <i class="fas fa-edit me-2"></i>Edit Kategori
                                            </a>
                                            <a href="{{ route('kategori_pengaduan.index') }}" class="btn btn-secondary">
                                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Kolom Kiri - Informasi Utama -->
                                    <div class="col-md-6">
                                        <div class="info-section mb-4">
                                            <h5 class="section-title text-primary mb-3">
                                                <i class="fas fa-info-circle me-2"></i>Informasi Utama
                                            </h5>
                                            <div class="info-item">
                                                <label class="fw-bold">ID Kategori</label>
                                                <p class="info-value">{{ $kategori->kategori_id }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Nama Kategori</label>
                                                <p class="info-value">{{ $kategori->nama }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Prioritas</label>
                                                <p class="info-value">
                                                    @if ($kategori->prioritas == 'Rendah')
                                                        <span class="badge bg-success">Rendah</span>
                                                    @elseif($kategori->prioritas == 'Sedang')
                                                        <span class="badge bg-warning text-dark">Sedang</span>
                                                    @elseif($kategori->prioritas == 'Tinggi')
                                                        <span class="badge bg-orange text-white">Tinggi</span>
                                                    @elseif($kategori->prioritas == 'Kritis')
                                                        <span class="badge bg-danger">Kritis</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>

                                        <div class="info-section mb-4">
                                            <h5 class="section-title text-primary mb-3">
                                                <i class="fas fa-clock me-2"></i>Informasi SLA
                                            </h5>
                                            <div class="info-item">
                                                <label class="fw-bold">SLA (Hari)</label>
                                                <p class="info-value">{{ $kategori->sla_hari }} hari</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Deskripsi SLA</label>
                                                <p class="info-value">
                                                    Pengaduan dengan kategori ini harus diselesaikan dalam
                                                    <strong>{{ $kategori->sla_hari }} hari</strong> kerja.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan - Statistik & Informasi Tambahan -->
                                    <div class="col-md-6">
                                        <div class="info-section mb-4">
                                            <h5 class="section-title text-primary mb-3">
                                                <i class="fas fa-chart-bar me-2"></i>Informasi Prioritas
                                            </h5>
                                            <div class="info-item">
                                                <label class="fw-bold">Level Prioritas</label>
                                                <p class="info-value">
                                                    @if($kategori->prioritas == 'Kritis')
                                                        <span class="text-danger fw-bold">Sangat Mendesak</span> - Harus ditangani segera
                                                    @elseif($kategori->prioritas == 'Tinggi')
                                                        <span class="text-warning fw-bold">Mendesak</span> - Ditangani dalam 24 jam
                                                    @elseif($kategori->prioritas == 'Sedang')
                                                        <span class="text-info fw-bold">Biasa</span> - Ditangani dalam 3 hari
                                                    @else
                                                        <span class="text-success fw-bold">Rendah</span> - Ditangani sesuai SLA
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Rekomendasi Penanganan</label>
                                                <p class="info-value">
                                                    @if($kategori->prioritas == 'Kritis')
                                                        Tim khusus, eskakasi ke pimpinan
                                                    @elseif($kategori->prioritas == 'Tinggi')
                                                        Tim respons cepat, monitoring ketat
                                                    @elseif($kategori->prioritas == 'Sedang')
                                                        Tim reguler, follow up berkala
                                                    @else
                                                        Tim standar, penanganan normal
                                                    @endif
                                                </p>
                                            </div>
                                        </div>

                                        <div class="info-section mb-4">
                                            <h5 class="section-title text-primary mb-3">
                                                <i class="fas fa-cube me-2"></i>Penggunaan Kategori
                                            </h5>
                                            <div class="info-item">
                                                <label class="fw-bold">Status Kategori</label>
                                                <p class="info-value">
                                                    <span class="badge bg-success">Aktif</span>
                                                    <small class="text-muted ms-2">Dapat digunakan untuk pengaduan baru</small>
                                                </p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Ketersediaan</label>
                                                <p class="info-value">
                                                    Tersedia di dropdown form pengaduan warga
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Riwayat Sistem -->
                                    <div class="col-12">
                                        <div class="info-section">
                                            <h5 class="section-title text-primary mb-3">
                                                <i class="fas fa-history me-2"></i>Riwayat Sistem
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="fw-bold">Dibuat Pada</label>
                                                        <p class="info-value">
                                                            {{ $kategori->created_at->format('d/m/Y H:i') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="fw-bold">Terakhir Diupdate</label>
                                                        <p class="info-value">
                                                            {{ $kategori->updated_at->format('d/m/Y H:i') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section><!-- /Detail Kategori Pengaduan Section -->

    </main>

    <style>
        .info-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            border-left: 4px solid #0d6efd;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .info-item {
            margin-bottom: 1rem;
        }

        .info-item:last-child {
            margin-bottom: 0;
        }

        .info-item label {
            display: block;
            margin-bottom: 0.25rem;
            color: #495057;
            font-weight: 500;
        }

        .info-value {
            margin: 0;
            padding: 0.5rem 0;
            color: #2c3e50;
            font-size: 1rem;
            line-height: 1.5;
        }

        .badge {
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
            font-weight: 500;
        }

        .bg-orange {
            background-color: #fd7e14 !important;
        }

        .description-box {
            background: #f8f9fa !important;
            border: 1px solid #e9ecef;
            border-radius: 8px;
        }
    </style>
@endsection
