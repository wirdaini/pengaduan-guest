@extends('layouts.guest.app')

@section('title', 'Detail Penilaian Layanan - Bina Desa')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Detail Penilaian Layanan</h1>
                            <p class="mb-0">Informasi lengkap tentang penilaian yang diberikan</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('penilaian_layanan.index') }}">Data Penilaian</a></li>
                        <li class="current">Detail Penilaian</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Detail Penilaian Section -->
        <section id="detail-penilaian" class="detail-penilaian section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-lg-10">

                        <div class="card shadow-sm">
                            <div class="card-header" style="background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%); color: white;">
                                <h4 class="card-title mb-0">
                                    <i class="fas fa-star me-2"></i>Detail Penilaian Layanan
                                </h4>
                            </div>
                            <div class="card-body">
                                <!-- Action Buttons -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-2">
                                            @if ($penilaian->created_at->diffInHours(now()) <= 24)
                                            <a href="{{ route('penilaian_layanan.edit', $penilaian->penilaian_id) }}"
                                                class="btn btn-warning">
                                                <i class="fas fa-edit me-2"></i>Edit Penilaian
                                            </a>
                                            @endif
                                            <a href="{{ route('penilaian_layanan.index') }}" class="btn btn-secondary">
                                                <i class="fas fa-arrow-left me-2"></i>Kembali
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Kolom Kiri - Informasi Rating -->
                                    <div class="col-md-6">
                                        <div class="info-section mb-4">
                                            <h5 class="section-title" style="color: #27ae60;">
                                                <i class="fas fa-chart-bar me-2"></i>Informasi Rating
                                            </h5>
                                            <div class="info-item">
                                                <label class="fw-bold">Rating</label>
                                                <div class="rating-display-large">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $penilaian->rating)
                                                            <i class="bi bi-star-fill" style="color: #ffc107; font-size: 2rem;"></i>
                                                        @else
                                                            <i class="bi bi-star" style="color: #ddd; font-size: 2rem;"></i>
                                                        @endif
                                                    @endfor
                                                    <span class="ms-3" style="font-size: 1.5rem; font-weight: bold;">
                                                        {{ $penilaian->rating }}/5
                                                    </span>
                                                </div>
                                                <p class="mt-2 fw-bold">{{ $penilaian->ratingText }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Tanggal Penilaian</label>
                                                <p class="info-value">{{ $penilaian->created_at->format('d/m/Y H:i') }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Status</label>
                                                <p class="info-value">
                                                    @if ($penilaian->created_at->diffInHours(now()) <= 24)
                                                        <span class="badge bg-warning">Dapat Diedit</span>
                                                    @else
                                                        <span class="badge bg-secondary">Terkunci</span>
                                                    @endif
                                                    <small class="text-muted ms-2">
                                                        (Hanya dapat diedit dalam 24 jam)
                                                    </small>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="info-section mb-4">
                                            <h5 class="section-title" style="color: #27ae60;">
                                                <i class="fas fa-user me-2"></i>Informasi Warga
                                            </h5>
                                            <div class="info-item">
                                                <label class="fw-bold">Nama Warga</label>
                                                <p class="info-value">{{ $penilaian->pengaduan->warga->nama }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">NIK</label>
                                                <p class="info-value">{{ $penilaian->pengaduan->warga->no_ktp }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Telepon</label>
                                                <p class="info-value">{{ $penilaian->pengaduan->warga->telp }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan - Informasi Pengaduan & Komentar -->
                                    <div class="col-md-6">
                                        <div class="info-section mb-4">
                                            <h5 class="section-title" style="color: #27ae60;">
                                                <i class="fas fa-ticket-alt me-2"></i>Informasi Pengaduan
                                            </h5>
                                            <div class="info-item">
                                                <label class="fw-bold">No Tiket</label>
                                                <p class="info-value">{{ $penilaian->pengaduan->nomor_tiket }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Judul Pengaduan</label>
                                                <p class="info-value">{{ $penilaian->pengaduan->judul }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Tanggal Pengaduan</label>
                                                <p class="info-value">{{ $penilaian->pengaduan->created_at->format('d/m/Y') }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Status Pengaduan</label>
                                                <p class="info-value">
                                                    <span class="badge bg-success">Selesai</span>
                                                </p>
                                            </div>
                                        </div>

                                        @if ($penilaian->komentar)
                                        <div class="info-section mb-4">
                                            <h5 class="section-title" style="color: #27ae60;">
                                                <i class="fas fa-comment me-2"></i>Komentar Warga
                                            </h5>
                                            <div class="info-item">
                                                <div class="comment-box p-3 bg-light rounded">
                                                    <p class="mb-0">{{ $penilaian->komentar }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Riwayat Sistem -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="info-section">
                                            <h5 class="section-title" style="color: #27ae60;">
                                                <i class="fas fa-history me-2"></i>Riwayat Sistem
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="fw-bold">Dibuat Pada</label>
                                                        <p class="info-value">{{ $penilaian->created_at->format('d/m/Y H:i') }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="fw-bold">Terakhir Diupdate</label>
                                                        <p class="info-value">{{ $penilaian->updated_at->format('d/m/Y H:i') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="info-item">
                                                        <label class="fw-bold">Waktu Berlalu</label>
                                                        <p class="info-value">{{ $penilaian->created_at->diffForHumans() }}</p>
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
        </section><!-- /Detail Penilaian Section -->

    </main>

    <style>
        .info-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            border-left: 4px solid #27ae60;
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
        }

        .info-value {
            margin: 0;
            padding: 0.5rem 0;
            color: #2c3e50;
            font-size: 1rem;
        }

        .rating-display-large {
            display: flex;
            align-items: center;
        }

        .badge {
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
        }

        .comment-box {
            background: #f8f9fa !important;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            font-style: italic;
        }
    </style>
@endsection
