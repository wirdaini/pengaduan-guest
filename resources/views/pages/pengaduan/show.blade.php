@extends('layouts.guest.app')

@section('title', 'Detail Pengaduan - Bina Desa')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Detail Pengaduan</h1>
                            <p class="mb-0">Informasi lengkap tentang pengaduan warga</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('pengaduan.index') }}">Data Pengaduan</a></li>
                        <li class="current">Detail Pengaduan</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Detail Pengaduan Section -->
        <section id="detail-pengaduan" class="detail-pengaduan section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-lg-10">

                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h4 class="card-title mb-0">
                                    <i class="fas fa-info-circle me-2"></i>Informasi Pengaduan
                                </h4>
                            </div>
                            <div class="card-body">
                                <!-- Action Buttons -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('pengaduan.edit', $pengaduan->pengaduan_id) }}"
                                                class="btn btn-warning">
                                                <i class="fas fa-edit me-2"></i>Edit Pengaduan
                                            </a>
                                            <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">
                                                <i class="fas fa-arrow-left me-2"></i>Kembali
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Kolom Kiri - Informasi Pengaduan -->
                                    <div class="col-md-6">
                                        <div class="info-section mb-4">
                                            <h5 class="section-title text-primary mb-3">
                                                <i class="fas fa-ticket-alt me-2"></i>Informasi Tiket
                                            </h5>
                                            <div class="info-item">
                                                <label class="fw-bold">No Tiket</label>
                                                <p class="info-value">{{ $pengaduan->nomor_tiket }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Status</label>
                                                <p class="info-value">
                                                    @if ($pengaduan->status == 'menunggu')
                                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                                    @elseif($pengaduan->status == 'diproses')
                                                        <span class="badge bg-primary">Diproses</span>
                                                    @elseif($pengaduan->status == 'selesai')
                                                        <span class="badge bg-success">Selesai</span>
                                                    @elseif($pengaduan->status == 'ditolak')
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Kategori</label>
                                                <p class="info-value">{{ $pengaduan->kategori }}</p>
                                            </div>
                                        </div>

                                        <div class="info-section mb-4">
                                            <h5 class="section-title text-primary mb-3">
                                                <i class="fas fa-user me-2"></i>Informasi Pengajuan
                                            </h5>
                                            <div class="info-item">
                                                <label class="fw-bold">Nama Warga</label>
                                                <p class="info-value">{{ $pengaduan->warga->nama }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">NIK</label>
                                                <p class="info-value">{{ $pengaduan->warga->no_ktp }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Telepon</label>
                                                <p class="info-value">{{ $pengaduan->warga->telp }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Email</label>
                                                <p class="info-value">{{ $pengaduan->warga->email }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan - Informasi Lokasi & Deskripsi -->
                                    <div class="col-md-6">
                                        <div class="info-section mb-4">
                                            <h5 class="section-title text-primary mb-3">
                                                <i class="fas fa-map-marker-alt me-2"></i>Informasi Lokasi
                                            </h5>
                                            <div class="info-item">
                                                <label class="fw-bold">Lokasi Kejadian</label>
                                                <p class="info-value">{{ $pengaduan->lokasi_text }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">RT</label>
                                                <p class="info-value">{{ $pengaduan->rt }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">RW</label>
                                                <p class="info-value">{{ $pengaduan->rw }}</p>
                                            </div>
                                        </div>

                                        <div class="info-section mb-4">
                                            <h5 class="section-title text-primary mb-3">
                                                <i class="fas fa-file-alt me-2"></i>Deskripsi Pengaduan
                                            </h5>
                                            <div class="info-item">
                                                <label class="fw-bold">Judul Pengaduan</label>
                                                <p class="info-value">{{ $pengaduan->judul }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Deskripsi Lengkap</label>
                                                <div class="description-box p-3 bg-light rounded">
                                                    <p class="mb-0">{{ $pengaduan->deskripsi }}</p>
                                                </div>
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
                                                        <label class="fw-bold">Tanggal Diajukan</label>
                                                        <p class="info-value">
                                                            {{ $pengaduan->created_at->format('d/m/Y H:i') }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="fw-bold">Terakhir Diupdate</label>
                                                        <p class="info-value">
                                                            {{ $pengaduan->updated_at->format('d/m/Y H:i') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($pengaduan->tanggal_pengaduan)
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="info-item">
                                                            <label class="fw-bold">Tanggal Kejadian</label>
                                                            <p class="info-value">
                                                                {{ $pengaduan->tanggal_pengaduan->format('d/m/Y') }}</p>
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
        </section><!-- /Detail Pengaduan Section -->

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

        .description-box {
            background: #f8f9fa !important;
            border: 1px solid #e9ecef;
            border-radius: 8px;
        }
    </style>
@endsection
