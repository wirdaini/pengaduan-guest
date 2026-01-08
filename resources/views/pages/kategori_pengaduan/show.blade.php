@extends('layouts.guest.app')

@section('title', 'Detail Kategori Pengaduan - Bina Desa')

@section('content')
<main class="main">
    <!-- Page Title -->
    <div class="page-title">
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
                    <li><a href="{{ route('kategori_pengaduan.index') }}">Kategori Pengaduan</a></li>
                    <li class="current">Detail Kategori</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Detail Kategori Section -->
    <section id="detail-kategori_pengaduan" class="detail-kategori_pengaduan section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <!-- Header Section -->
            <div class="detail-header mb-3">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="detail-icon-circle">
                            <div class="detail-icon">
                                <i class="bi bi-tags"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <h2 class="detail-title mb-1">{{ $kategori->nama }}</h2>
                        <div class="detail-subtitle">
                            <span class="badge prioritas-{{ strtolower($kategori->prioritas) }} me-2">
                                {{ $kategori->prioritas }}
                            </span>
                            <span class="text-muted">
                                <i class="bi bi-clock me-1"></i>SLA: {{ $kategori->sla_hari }} hari
                            </span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="action-buttons">
                            <a href="{{ route('kategori_pengaduan.edit', $kategori->kategori_id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil me-1"></i>Edit
                            </a>
                            <a href="{{ route('kategori_pengaduan.index') }}"
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
                    <!-- Kolom Kiri: Informasi Dasar -->
                    <div class="col-lg-6">
                        <!-- Informasi Dasar -->
                        <div class="info-section mb-3">
                            <h5 class="section-title mb-2">
                                <i class="bi bi-info-circle me-2"></i>Informasi Dasar
                            </h5>
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-hash me-1"></i>ID Kategori
                                    </div>
                                    <div class="info-value">{{ $kategori->kategori_id }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-card-text me-1"></i>Nama Kategori
                                    </div>
                                    <div class="info-value">{{ $kategori->nama }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-exclamation-circle me-1"></i>Prioritas
                                    </div>
                                    <div class="info-value">
                                        <span class="badge prioritas-{{ strtolower($kategori->prioritas) }}">
                                            {{ $kategori->prioritas }}
                                        </span>
                                    </div>
                                </div>
                                @if($kategori->deskripsi)
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-text-paragraph me-1"></i>Deskripsi
                                    </div>
                                    <div class="info-value">{{ $kategori->deskripsi }}</div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Informasi SLA -->
                        <div class="info-section mb-3">
                            <h5 class="section-title mb-2">
                                <i class="bi bi-clock-history me-2"></i>Informasi SLA
                            </h5>
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-calendar-check me-1"></i>Durasi SLA
                                    </div>
                                    <div class="info-value">
                                        <span class="sla-value">{{ $kategori->sla_hari }} hari</span>
                                        <small class="text-muted">
                                            Waktu maksimal penanganan
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Detail Prioritas & Status -->
                    <div class="col-lg-6">
                        <!-- Detail Prioritas -->
                        <div class="info-section mb-3">
                            <h5 class="section-title mb-2">
                                <i class="bi bi-speedometer2 me-2"></i>Detail Prioritas
                            </h5>
                            <div class="priority-detail">
                                @if($kategori->prioritas == 'Kritis')
                                <div class="priority-level kritis">
                                    <div class="priority-header">
                                        <i class="bi bi-exclamation-triangle"></i>
                                        <h6 class="mb-0">Level: Sangat Mendesak</h6>
                                    </div>
                                    <p class="priority-desc mb-2">
                                        Harus ditangani segera, maksimal 24 jam pertama.
                                    </p>
                                    <div class="priority-tags">
                                        <span class="tag">Tim Khusus</span>
                                        <span class="tag">Eskalasi Pimpinan</span>
                                    </div>
                                </div>
                                @elseif($kategori->prioritas == 'Tinggi')
                                <div class="priority-level tinggi">
                                    <div class="priority-header">
                                        <i class="bi bi-exclamation-circle"></i>
                                        <h6 class="mb-0">Level: Mendesak</h6>
                                    </div>
                                    <p class="priority-desc mb-2">
                                        Ditangani dalam 48 jam, monitoring intensif.
                                    </p>
                                    <div class="priority-tags">
                                        <span class="tag">Tim Respons Cepat</span>
                                        <span class="tag">Monitoring Ketat</span>
                                    </div>
                                </div>
                                @elseif($kategori->prioritas == 'Sedang')
                                <div class="priority-level sedang">
                                    <div class="priority-header">
                                        <i class="bi bi-info-circle"></i>
                                        <h6 class="mb-0">Level: Biasa</h6>
                                    </div>
                                    <p class="priority-desc mb-2">
                                        Ditangani sesuai alur normal.
                                    </p>
                                    <div class="priority-tags">
                                        <span class="tag">Tim Reguler</span>
                                        <span class="tag">Follow Up Mingguan</span>
                                    </div>
                                </div>
                                @else
                                <div class="priority-level rendah">
                                    <div class="priority-header">
                                        <i class="bi bi-check-circle"></i>
                                        <h6 class="mb-0">Level: Rendah</h6>
                                    </div>
                                    <p class="priority-desc mb-2">
                                        Ditangani sesuai waktu yang tersedia.
                                    </p>
                                    <div class="priority-tags">
                                        <span class="tag">Tim Standar</span>
                                        <span class="tag">Penanganan Normal</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Status & Timeline -->
                        <div class="info-section">
                            <h5 class="section-title mb-2">
                                <i class="bi bi-clock-history me-2"></i>Status & Riwayat
                            </h5>
                            <div class="status-timeline">
                                <div class="status-item mb-3">
                                    <div class="status-badge active">
                                        <i class="bi bi-check-circle me-1"></i>
                                        <span>Aktif</span>
                                    </div>
                                    <p class="status-desc mt-1 mb-0">Tersedia untuk form pengaduan</p>
                                </div>
                                <div class="timeline-compact">
                                    <div class="timeline-item">
                                        <i class="bi bi-plus-circle timeline-icon-sm"></i>
                                        <div class="timeline-content">
                                            <span class="timeline-title">Dibuat</span>
                                            <span class="timeline-date">{{ $kategori->created_at->format('d M Y, H:i') }}</span>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <i class="bi bi-arrow-repeat timeline-icon-sm"></i>
                                        <div class="timeline-content">
                                            <span class="timeline-title">Diperbarui</span>
                                            <span class="timeline-date">{{ $kategori->updated_at->format('d M Y, H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Detail Kategori Section -->
</main>

<style>
    /* ===========================================
       STYLING DETAIL PAGE - KONSISTEN & KOMPAK
       =========================================== */

    /* Detail Header - Lebih kompak */
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

    /* Icon Circle - Lebih kecil */
    .detail-icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #175cdd 0%, #0e3d8b 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid #f0f5ff;
        box-shadow: 0 2px 8px rgba(23, 92, 221, 0.2);
        transition: all 0.3s ease;
    }

    .detail-header:hover .detail-icon-circle {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(23, 92, 221, 0.3);
    }

    .detail-icon {
        color: white;
        font-size: 1.8rem;
        transition: transform 0.3s ease;
    }

    .detail-header:hover .detail-icon {
        transform: rotate(10deg);
    }

    /* Title - Lebih kompak */
    .detail-title {
        color: #2c3e50;
        font-size: 1.5rem;
        font-weight: 700;
        transition: color 0.3s ease;
    }

    .detail-header:hover .detail-title {
        color: #175cdd;
    }

    /* Subtitle - Lebih rapat */
    .detail-subtitle {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    /* Badge Prioritas - Sama dengan index */
    .badge.prioritas-rendah,
    .badge.prioritas-sedang,
    .badge.prioritas-tinggi,
    .badge.prioritas-kritis {
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.3s ease;
    }

    .badge.prioritas-rendah {
        background: #e8f5e9;
        color: #28a745;
        border: 1px solid #c3e6cb;
    }

    .badge.prioritas-sedang {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .badge.prioritas-tinggi {
        background: #ffe5d0;
        color: #d35400;
        border: 1px solid #fdbe74;
    }

    .badge.prioritas-kritis {
        background: #f8d7da;
        color: #c62828;
        border: 1px solid #f5c6cb;
    }

    .badge:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Action Buttons - Lebih kecil */
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
        position: relative;
        overflow: hidden;
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

    /* Detail Card - Padding lebih kecil */
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

    /* Info Sections - Lebih kompak */
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

    /* Section Title - Lebih kecil */
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

    /* Info Grid - Gap lebih kecil */
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

    /* SLA Value - Lebih kecil */
    .sla-value {
        font-size: 1.25rem;
        font-weight: 700;
        color: #175cdd;
        display: inline-block;
        padding: 3px 10px;
        background: rgba(23, 92, 221, 0.1);
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .info-item:hover .sla-value {
        background: rgba(23, 92, 221, 0.2);
        transform: scale(1.05);
    }

    /* Priority Detail - Lebih padat */
    .priority-detail {
        padding: 0;
    }

    .priority-level {
        padding: 1rem;
        border-radius: 10px;
        border-left: 4px solid transparent;
        transition: all 0.3s ease;
    }

    .priority-level:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .priority-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
    }

    .priority-level:hover .priority-header i {
        transform: rotate(15deg);
    }

    .priority-header i {
        font-size: 1.25rem;
        transition: all 0.3s ease;
    }

    .priority-header h6 {
        margin: 0;
        font-weight: 600;
        font-size: 0.95rem;
        color: #2c3e50;
    }

    .priority-level:hover .priority-header h6 {
        color: #000;
    }

    .priority-desc {
        color: #495057;
        margin-bottom: 0.5rem;
        font-size: 0.85rem;
        line-height: 1.4;
        transition: color 0.3s ease;
    }

    .priority-level:hover .priority-desc {
        color: #000;
    }

    .priority-tags {
        display: flex;
        gap: 0.375rem;
        flex-wrap: wrap;
    }

    .priority-tags .tag {
        background: rgba(255, 255, 255, 0.9);
        padding: 0.2rem 0.6rem;
        border-radius: 10px;
        font-size: 0.7rem;
        font-weight: 500;
        border: 1px solid rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .priority-level:hover .priority-tags .tag {
        background: rgba(255, 255, 255, 1);
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Status & Timeline Compact */
    .status-timeline {
        padding: 0.5rem 0;
    }

    .status-item {
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .status-item:hover {
        border-bottom-color: #175cdd;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.3s ease;
    }

    .status-item:hover .status-badge {
        transform: scale(1.05);
    }

    .status-badge.active {
        background: #e8f5e9;
        color: #28a745;
        border: 1px solid #c3e6cb;
    }

    .status-badge.active i {
        color: #28a745;
        font-size: 0.9rem;
        transition: transform 0.3s ease;
    }

    .status-item:hover .status-badge.active i {
        transform: rotate(360deg);
    }

    .status-desc {
        color: #6c757d;
        font-size: 0.8rem;
        line-height: 1.3;
        transition: color 0.3s ease;
    }

    .status-item:hover .status-desc {
        color: #175cdd;
    }

    /* Timeline Compact */
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

    /* Responsive Design - Lebih baik untuk mobile */
    @media (max-width: 768px) {
        .detail-header {
            padding: 1rem;
        }

        .detail-title {
            font-size: 1.25rem;
        }

        .detail-icon-circle {
            width: 50px;
            height: 50px;
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

        /* Disable complex hover effects on mobile for better performance */
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

        .priority-level {
            padding: 0.75rem;
        }

        .priority-header h6 {
            font-size: 0.9rem;
        }

        .priority-desc {
            font-size: 0.8rem;
        }

        .sla-value {
            font-size: 1.1rem;
        }

        .col-lg-6 {
            margin-bottom: 0.5rem;
        }

        .detail-subtitle {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
    }
</style>
@endsection
