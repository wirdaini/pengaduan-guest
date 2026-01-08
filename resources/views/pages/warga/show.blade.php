@extends('layouts.guest.app')

@section('title', 'Detail Warga - Bina Desa')

@section('content')
<main class="main">
    <!-- Page Title -->
    <div class="page-title">
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
                    <li><a href="{{ route('warga.index') }}">Data Warga</a></li>
                    <li class="current">Detail Warga</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Detail Warga Section -->
    <section id="detail-warga" class="detail-warga section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <!-- Header Section -->
            <div class="detail-header mb-3">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="detail-icon-circle">
                            <div class="detail-icon {{ $warga->jenis_kelamin == 'L' ? 'male-bg' : 'female-bg' }}">
                                {{ strtoupper(substr($warga->nama, 0, 2)) }}
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <h2 class="detail-title mb-1">{{ $warga->nama }}</h2>
                        <div class="detail-subtitle">
                            <span class="badge gender-{{ $warga->jenis_kelamin }} me-2">
                                {{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                            <span class="text-muted">
                                <i class="bi bi-card-text me-1"></i>{{ $warga->no_ktp }}
                            </span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="action-buttons">
                            <a href="{{ route('warga.edit', $warga->warga_id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil me-1"></i>Edit
                            </a>
                            <a href="{{ route('warga.index') }}"
                               class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-arrow-left me-1"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Card -->
            <div class="detail-card">
                <div class="row">
                    <!-- Kolom Kiri - Informasi Pribadi -->
                    <div class="col-lg-6">
                        <!-- Informasi Pribadi -->
                        <div class="info-section mb-3">
                            <h5 class="section-title mb-2">
                                <i class="bi bi-person-vcard me-2"></i>Informasi Pribadi
                            </h5>
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-person me-1"></i>Nama Lengkap
                                    </div>
                                    <div class="info-value">{{ $warga->nama }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-card-text me-1"></i>NIK
                                    </div>
                                    <div class="info-value">{{ $warga->no_ktp }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-gender-ambiguous me-1"></i>Jenis Kelamin
                                    </div>
                                    <div class="info-value">
                                        <span class="badge gender-{{ $warga->jenis_kelamin }}">
                                            {{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-heart me-1"></i>Agama
                                    </div>
                                    <div class="info-value">{{ $warga->agama }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Alamat (jika ada) -->
                        @if($warga->alamat)
                        <div class="info-section mb-3">
                            <h5 class="section-title mb-2">
                                <i class="bi bi-geo-alt me-2"></i>Informasi Alamat
                            </h5>
                            <div class="description-box">
                                <p class="mb-0">{{ $warga->alamat }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Kolom Kanan - Informasi Kontak & Pekerjaan -->
                    <div class="col-lg-6">
                        <!-- Informasi Kontak -->
                        <div class="info-section mb-3">
                            <h5 class="section-title mb-2">
                                <i class="bi bi-telephone me-2"></i>Informasi Kontak
                            </h5>
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-envelope me-1"></i>Email
                                    </div>
                                    <div class="info-value">{{ $warga->email ?? '-' }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-telephone me-1"></i>Telepon
                                    </div>
                                    <div class="info-value">{{ $warga->telp ?? '-' }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-briefcase me-1"></i>Pekerjaan
                                    </div>
                                    <div class="info-value">{{ $warga->pekerjaan }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-hash me-1"></i>Warga ID
                                    </div>
                                    <div class="info-value">#{{ $warga->warga_id }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi User Terkait -->
                        @if($warga->user_id && $warga->user)
                        <div class="info-section mb-3">
                            <h5 class="section-title mb-2">
                                <i class="bi bi-person-check me-2"></i>Akun Terkait
                            </h5>
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-person-circle me-1"></i>Username
                                    </div>
                                    <div class="info-value">{{ $warga->user->name }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-person-badge me-1"></i>Role
                                    </div>
                                    <div class="info-value">
                                        <span class="badge role-{{ $warga->user->role }}">
                                            {{ ucfirst($warga->user->role) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Riwayat Sistem -->
                <div class="info-section timeline-section">
                    <h5 class="section-title mb-2">
                        <i class="bi bi-clock-history me-2"></i>Riwayat Sistem
                    </h5>
                    <div class="timeline-compact">
                        <div class="timeline-item">
                            <i class="bi bi-plus-circle timeline-icon-sm"></i>
                            <div class="timeline-content">
                                <span class="timeline-title">Dibuat</span>
                                <span class="timeline-date">{{ $warga->created_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <i class="bi bi-arrow-repeat timeline-icon-sm"></i>
                            <div class="timeline-content">
                                <span class="timeline-title">Diperbarui</span>
                                <span class="timeline-date">{{ $warga->updated_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Detail Warga Section -->
</main>

<style>
    /* ===========================================
       STYLING DETAIL WARGA - KONSISTEN
       =========================================== */

    /* Detail Header */
    .detail-header {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        margin-bottom: 1.5rem;
        border: 1px solid #f0f0f0;
        transition: all 0.3s ease;
    }

    .detail-header:hover {
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12);
        transform: translateY(-2px);
    }

    /* Icon Circle dengan Gender Color */
    .detail-icon-circle {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid #f0f5ff;
        background: #f8f9fa;
        position: relative;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .detail-header:hover .detail-icon-circle {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .detail-icon {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .male-bg {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    }

    .female-bg {
        background: linear-gradient(135deg, #e84393 0%, #d63031 100%);
    }

    /* Title */
    .detail-title {
        color: #2c3e50;
        font-size: 1.5rem;
        font-weight: 700;
        transition: color 0.3s ease;
    }

    .detail-header:hover .detail-title {
        color: #175cdd;
    }

    /* Subtitle */
    .detail-subtitle {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    /* Badge Gender (sama dengan index) */
    .badge.gender-L,
    .badge.gender-P {
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.3s ease;
    }

    .badge.gender-L {
        background: #e3f2fd;
        color: #1565c0;
        border: 1px solid #bbdefb;
    }

    .badge.gender-P {
        background: #fce4ec;
        color: #c2185b;
        border: 1px solid #f8bbd0;
    }

    .badge.role-admin,
    .badge.role-petugas,
    .badge.role-warga {
        padding: 0.25rem 0.6rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .badge.role-admin {
        background: #dc3545;
        color: white;
    }

    .badge.role-petugas {
        background: #ffc107;
        color: #212529;
    }

    .badge.role-warga {
        background: #28a745;
        color: white;
    }

    .badge:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-warning,
    .btn-outline-secondary {
        border-radius: 50px;
        padding: 6px 12px;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .btn-warning {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        border: none;
        color: #fff;
        font-weight: 500;
    }

    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 152, 0, 0.3);
        background: linear-gradient(135deg, #ffb300 0%, #f57c00 100%);
    }

    .btn-outline-secondary {
        border-color: #dee2e6;
        color: #6c757d;
    }

    .btn-outline-secondary:hover {
        border-color: #175cdd;
        color: #175cdd;
        background: rgba(23, 92, 221, 0.05);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(23, 92, 221, 0.1);
    }

    /* Detail Card */
    .detail-card {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        border: 1px solid #f0f0f0;
        transition: all 0.3s ease;
    }

    .detail-card:hover {
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12);
    }

    /* Info Sections */
    .info-section {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .info-section:hover {
        border-color: #175cdd;
        box-shadow: 0 4px 15px rgba(23, 92, 221, 0.1);
        transform: translateY(-2px);
    }

    .info-section:hover::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: #175cdd;
    }

    /* Section Title */
    .section-title {
        color: #2c3e50;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid rgba(23, 92, 221, 0.1);
        transition: all 0.3s ease;
    }

    .info-section:hover .section-title {
        color: #175cdd;
        border-bottom-color: rgba(23, 92, 221, 0.3);
    }

    .section-title i {
        color: #175cdd;
        font-size: 1rem;
        width: 20px;
        transition: all 0.3s ease;
    }

    .info-section:hover .section-title i {
        transform: scale(1.2);
        color: #175cdd;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        gap: 0.75rem;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem;
        background: #fff;
        border-radius: 8px;
        border: 1px solid #e9ecef;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        position: relative;
    }

    .info-item:hover {
        border-color: #175cdd;
        box-shadow: 0 2px 8px rgba(23, 92, 221, 0.1);
        transform: translateX(5px);
        background: #fff;
    }

    .info-item:hover .info-label i {
        transform: scale(1.2);
    }

    .info-label {
        flex: 0 0 120px;
        color: #495057;
        font-weight: 500;
        display: flex;
        align-items: center;
        font-size: 0.875rem;
        transition: color 0.3s ease;
    }

    .info-item:hover .info-label {
        color: #175cdd;
    }

    .info-label i {
        color: #175cdd;
        margin-right: 0.5rem;
        font-size: 0.9rem;
        width: 16px;
        transition: all 0.3s ease;
    }

    .info-value {
        flex: 1;
        color: #2c3e50;
        font-size: 0.875rem;
        transition: color 0.3s ease;
    }

    .info-item:hover .info-value {
        color: #175cdd;
        font-weight: 500;
    }

    /* Description Box */
    .description-box {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 1rem;
        font-size: 0.9rem;
        line-height: 1.5;
        color: #495057;
        transition: all 0.3s ease;
    }

    .info-section:hover .description-box {
        border-color: #175cdd;
        background: #f8f9fa;
    }

    /* Timeline Section */
    .timeline-section {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
    }

    .timeline-compact {
        margin-top: 0.75rem;
    }

    .timeline-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem;
        border-bottom: 1px solid #f0f0f0;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .timeline-item:hover {
        background: rgba(23, 92, 221, 0.05);
        border-bottom-color: #175cdd;
        transform: translateX(5px);
    }

    .timeline-item:last-child {
        border-bottom: none;
    }

    .timeline-icon-sm {
        color: #175cdd;
        font-size: 0.9rem;
        width: 20px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .timeline-item:hover .timeline-icon-sm {
        transform: scale(1.3);
        color: #175cdd;
    }

    .timeline-content {
        flex: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .timeline-title {
        color: #2c3e50;
        font-size: 0.85rem;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .timeline-item:hover .timeline-title {
        color: #175cdd;
        font-weight: 600;
    }

    .timeline-date {
        color: #6c757d;
        font-size: 0.8rem;
        font-weight: 400;
        transition: color 0.3s ease;
    }

    .timeline-item:hover .timeline-date {
        color: #175cdd;
        font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .detail-header {
            padding: 1rem;
        }

        .detail-title {
            font-size: 1.25rem;
        }

        .detail-icon-circle {
            width: 60px;
            height: 60px;
        }

        .detail-icon {
            font-size: 1.5rem;
        }

        .action-buttons {
            flex-direction: column;
            width: 100%;
        }

        .btn-warning,
        .btn-outline-secondary {
            width: 100%;
            justify-content: center;
        }

        .detail-card {
            padding: 1rem;
        }

        .info-section {
            padding: 1rem;
        }

        .info-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.25rem;
            padding: 0.5rem;
        }

        .info-label {
            flex: none;
            width: 100%;
            font-size: 0.8rem;
        }

        .info-value {
            font-size: 0.85rem;
            width: 100%;
        }

        /* Disable complex hover effects on mobile */
        .info-section:hover::before {
            display: none;
        }

        .info-item:hover {
            transform: translateX(0);
        }

        .timeline-item:hover {
            transform: translateX(0);
        }
    }

    @media (max-width: 576px) {
        .section-title {
            font-size: 0.95rem;
        }

        .detail-subtitle {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .col-lg-6 {
            margin-bottom: 0.5rem;
        }

        .description-box {
            padding: 0.75rem;
            font-size: 0.85rem;
        }
    }
</style>
@endsection
