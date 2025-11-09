@extends('layouts.app')

@section('title', 'Detail Warga - Bina Desa')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Detail Warga</h1>
                            <p class="mb-0">Informasi lengkap tentang data warga</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('warga.index') }}">Data Warga</a></li>
                        <li class="current">Detail Warga</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Detail Warga Section -->
        <section id="detail-warga" class="detail-warga section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-lg-10">

                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h4 class="card-title mb-0">
                                    <i class="fas fa-user me-2"></i>Informasi Warga
                                </h4>
                            </div>
                            <div class="card-body">
                                <!-- Action Buttons -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-warning">
                                                <i class="fas fa-edit me-2"></i>Edit Data
                                            </a>
                                            <a href="{{ route('warga.index') }}" class="btn btn-secondary">
                                                <i class="fas fa-arrow-left me-2"></i>Kembali
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Kolom Kiri - Informasi Pribadi -->
                                    <div class="col-md-6">
                                        <div class="info-section mb-4">
                                            <h5 class="section-title text-primary mb-3">
                                                <i class="fas fa-id-card me-2"></i>Informasi Pribadi
                                            </h5>
                                            <div class="info-item">
                                                <label class="fw-bold">Nama Lengkap</label>
                                                <p class="info-value">{{ $warga->nama }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">NIK</label>
                                                <p class="info-value">{{ $warga->no_ktp }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Jenis Kelamin</label>
                                                <p class="info-value">
                                                    @if ($warga->jenis_kelamin == 'L')
                                                        <span class="badge bg-primary">Laki-laki</span>
                                                    @else
                                                        <span class="badge bg-pink">Perempuan</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Agama</label>
                                                <p class="info-value">{{ $warga->agama }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan - Informasi Kontak -->
                                    <div class="col-md-6">
                                        <div class="info-section mb-4">
                                            <h5 class="section-title text-primary mb-3">
                                                <i class="fas fa-address-book me-2"></i>Informasi Kontak
                                            </h5>
                                            <div class="info-item">
                                                <label class="fw-bold">Email</label>
                                                <p class="info-value">{{ $warga->email }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Telepon</label>
                                                <p class="info-value">{{ $warga->telp }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Pekerjaan</label>
                                                <p class="info-value">{{ $warga->pekerjaan }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Warga ID</label>
                                                <p class="info-value">#{{ $warga->warga_id }}</p>
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
                                                        <label class="fw-bold">Tanggal Dibuat</label>
                                                        <p class="info-value">{{ $warga->created_at->format('d/m/Y H:i') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="fw-bold">Terakhir Update</label>
                                                        <p class="info-value">{{ $warga->updated_at->format('d/m/Y H:i') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($warga->user_id)
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="info-item">
                                                            <label class="fw-bold">User ID Terkait</label>
                                                            <p class="info-value">#{{ $warga->user_id }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section><!-- /Detail Warga Section -->

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
        }

        .info-value {
            margin: 0;
            padding: 0.5rem 0;
            color: #2c3e50;
            font-size: 1rem;
        }

        .badge {
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
        }

        .bg-pink {
            background-color: #e83e8c !important;
        }
    </style>
@endsection
