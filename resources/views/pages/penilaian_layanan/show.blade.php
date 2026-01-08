@extends('layouts.guest.app')

@section('title', 'Detail Penilaian Layanan - Bina Desa')

@section('content')
<main class="main">
    <!-- Page Title -->
    <div class="page-title">
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
                    <li><a href="{{ route('penilaian_layanan.index') }}">Data Penilaian</a></li>
                    <li class="current">Detail Penilaian</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Detail Penilaian Section -->
    <section id="detail-penilaian" class="detail-penilaian section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <!-- Header Section -->
            <div class="detail-header mb-3">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="detail-icon-circle rating-{{ $penilaian->rating }}">
                            <div class="detail-icon">
                                @if ($penilaian->rating == 5)
                                    <i class="bi bi-emoji-laughing"></i>
                                @elseif($penilaian->rating == 4)
                                    <i class="bi bi-emoji-smile"></i>
                                @elseif($penilaian->rating == 3)
                                    <i class="bi bi-emoji-neutral"></i>
                                @elseif($penilaian->rating == 2)
                                    <i class="bi bi-emoji-frown"></i>
                                @else
                                    <i class="bi bi-emoji-angry"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <h2 class="detail-title mb-1">Penilaian Pengaduan</h2>
                        <div class="detail-subtitle">
                            <span class="badge rating-{{ $penilaian->rating }}-badge me-2">
                                @if ($penilaian->rating == 5)
                                    <i class="bi bi-emoji-laughing me-1"></i>Sangat Puas
                                @elseif($penilaian->rating == 4)
                                    <i class="bi bi-emoji-smile me-1"></i>Puas
                                @elseif($penilaian->rating == 3)
                                    <i class="bi bi-emoji-neutral me-1"></i>Cukup
                                @elseif($penilaian->rating == 2)
                                    <i class="bi bi-emoji-frown me-1"></i>Tidak Puas
                                @else
                                    <i class="bi bi-emoji-angry me-1"></i>Sangat Tidak Puas
                                @endif
                            </span>
                            <span class="text-muted">
                                <i class="bi bi-calendar-event me-1"></i>
                                {{ $penilaian->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="action-buttons">
                            @if ($penilaian->created_at->diffInHours(now()) <= 24)
                            <a href="{{ route('penilaian_layanan.edit', $penilaian->penilaian_id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil me-1"></i>Edit
                            </a>
                            @endif
                            <a href="{{ route('penilaian_layanan.index') }}"
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
                    <!-- Kolom Kiri - Rating & Informasi -->
                    <div class="col-lg-6">
                        <!-- Rating Display -->
                        <div class="info-section mb-3">
                            <h5 class="section-title mb-2">
                                <i class="bi bi-star me-2"></i>Informasi Rating
                            </h5>
                            <div class="rating-display-main mb-3">
                                <div class="rating-stars-large">
                                    @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $penilaian->rating)
                                    <i class="bi bi-star-fill"></i>
                                    @else
                                    <i class="bi bi-star"></i>
                                    @endif
                                    @endfor
                                </div>
                                <div class="rating-value">
                                    <h3 class="mb-0">{{ $penilaian->rating }}/5</h3>
                                    <small class="text-muted">
                                        @if ($penilaian->rating == 5) ⭐⭐⭐⭐⭐ Sangat Baik
                                        @elseif($penilaian->rating == 4) ⭐⭐⭐⭐ Baik
                                        @elseif($penilaian->rating == 3) ⭐⭐⭐ Cukup
                                        @elseif($penilaian->rating == 2) ⭐⭐ Buruk
                                        @else ⭐ Sangat Buruk
                                        @endif
                                    </small>
                                </div>
                            </div>
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-clock-history me-1"></i>Status
                                    </div>
                                    <div class="info-value">
                                        @if ($penilaian->created_at->diffInHours(now()) <= 24)
                                        <span class="badge bg-success">Dapat Diedit</span>
                                        @else
                                        <span class="badge bg-secondary">Terkunci</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-calendar me-1"></i>Tanggal Penilaian
                                    </div>
                                    <div class="info-value">{{ $penilaian->created_at->format('d M Y, H:i') }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Warga -->
                        <div class="info-section mb-3">
                            <h5 class="section-title mb-2">
                                <i class="bi bi-person me-2"></i>Informasi Warga
                            </h5>
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-person-circle me-1"></i>Nama
                                    </div>
                                    <div class="info-value">{{ $penilaian->pengaduan->warga->nama }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-card-text me-1"></i>NIK
                                    </div>
                                    <div class="info-value">{{ $penilaian->pengaduan->warga->no_ktp }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-telephone me-1"></i>Telepon
                                    </div>
                                    <div class="info-value">{{ $penilaian->pengaduan->warga->telp }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan - Pengaduan & Komentar -->
                    <div class="col-lg-6">
                        <!-- Informasi Pengaduan -->
                        <div class="info-section mb-3">
                            <h5 class="section-title mb-2">
                                <i class="bi bi-inbox me-2"></i>Informasi Pengaduan
                            </h5>
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-ticket me-1"></i>No Tiket
                                    </div>
                                    <div class="info-value">{{ $penilaian->pengaduan->nomor_tiket }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-card-text me-1"></i>Judul
                                    </div>
                                    <div class="info-value">{{ $penilaian->pengaduan->judul }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-calendar me-1"></i>Tanggal
                                    </div>
                                    <div class="info-value">{{ $penilaian->pengaduan->created_at->format('d M Y') }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-tags me-1"></i>Kategori
                                    </div>
                                    <div class="info-value">{{ $penilaian->pengaduan->kategori->nama }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Komentar -->
                        @if ($penilaian->komentar)
                        <div class="info-section mb-3">
                            <h5 class="section-title mb-2">
                                <i class="bi bi-chat-left-text me-2"></i>Komentar Warga
                            </h5>
                            <div class="comment-box">
                                <i class="bi bi-quote text-muted me-2"></i>
                                {{ $penilaian->komentar }}
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
                            <i class="bi bi-star timeline-icon-sm"></i>
                            <div class="timeline-content">
                                <span class="timeline-title">Diberikan</span>
                                <span class="timeline-date">{{ $penilaian->created_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <i class="bi bi-arrow-repeat timeline-icon-sm"></i>
                            <div class="timeline-content">
                                <span class="timeline-title">Diperbarui</span>
                                <span class="timeline-date">{{ $penilaian->updated_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <i class="bi bi-clock timeline-icon-sm"></i>
                            <div class="timeline-content">
                                <span class="timeline-title">Waktu Berlalu</span>
                                <span class="timeline-date">{{ $penilaian->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Detail Penilaian Section -->
</main>

<style>
    /* ===========================================
       STYLING DETAIL PENILAIAN - KONSISTEN
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

    /* Icon Circle dengan Gradien Rating */
    .detail-icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    /* Gradien warna berdasarkan rating */
    .rating-5 { background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%); }
    .rating-4 { background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); }
    .rating-3 { background: linear-gradient(135deg, #f1c40f 0%, #f39c12 100%); }
    .rating-2 { background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); }
    .rating-1 { background: linear-gradient(135deg, #7f8c8d 0%, #34495e 100%); }

    .detail-header:hover .detail-icon-circle {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .detail-icon {
        color: white;
        font-size: 2rem;
        transition: transform 0.3s ease;
    }

    .detail-header:hover .detail-icon {
        transform: rotate(15deg);
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

    /* Badge Rating (sama dengan index) */
    .badge.rating-5-badge,
    .badge.rating-4-badge,
    .badge.rating-3-badge,
    .badge.rating-2-badge,
    .badge.rating-1-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.3s ease;
    }

    .badge.rating-5-badge {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .badge.rating-4-badge {
        background: #cce5ff;
        color: #004085;
        border: 1px solid #b8daff;
    }

    .badge.rating-3-badge {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .badge.rating-2-badge {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .badge.rating-1-badge {
        background: #e2e3e5;
        color: #383d41;
        border: 1px solid #d6d8db;
    }

    .badge.bg-success,
    .badge.bg-secondary {
        padding: 0.25rem 0.6rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 500;
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

    /* Rating Display Main */
    .rating-display-main {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 1rem;
        padding: 1rem;
        background: white;
        border-radius: 10px;
        border: 1px solid #e9ecef;
    }

    .rating-stars-large {
        display: flex;
        gap: 0.5rem;
    }

    .rating-stars-large .bi-star-fill {
        color: #ffc107;
        font-size: 2.5rem;
        filter: drop-shadow(0 2px 3px rgba(0,0,0,0.1));
    }

    .rating-stars-large .bi-star {
        color: #e0e0e0;
        font-size: 2.5rem;
    }

    .rating-value h3 {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .rating-value small {
        color: #6c757d;
        font-size: 0.9rem;
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

    /* Comment Box */
    .comment-box {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 1rem;
        font-size: 0.9rem;
        line-height: 1.5;
        color: #495057;
        font-style: italic;
        position: relative;
        transition: all 0.3s ease;
    }

    .comment-box:before {
        content: '"';
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 2rem;
        color: rgba(23, 92, 221, 0.1);
        font-family: serif;
        line-height: 1;
    }

    .info-section:hover .comment-box {
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

        .rating-display-main {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }

        .rating-stars-large .bi-star-fill,
        .rating-stars-large .bi-star {
            font-size: 2rem;
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

        .comment-box {
            padding: 0.75rem;
            font-size: 0.85rem;
        }

        .rating-stars-large .bi-star-fill,
        .rating-stars-large .bi-star {
            font-size: 1.75rem;
        }
    }
</style>
@endsection
