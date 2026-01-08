@extends('layouts.guest.app')

@section('title', 'Detail Pengaduan - Bina Desa')

@section('content')
<main class="main">
    <!-- Page Title -->
    <div class="page-title">
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
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
                    <!-- Header Section -->
                    <div class="detail-header mb-3">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="detail-icon-circle">
                                    <div class="detail-icon">
                                        <i class="bi bi-inbox"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <h2 class="detail-title mb-1">{{ $pengaduan->judul }}</h2>
                                <div class="detail-subtitle">
                                    <span class="badge status-{{ $pengaduan->status }} me-2">
                                        @if ($pengaduan->status == 'menunggu')
                                            <i class="bi bi-clock me-1"></i>Menunggu
                                        @elseif($pengaduan->status == 'diproses')
                                            <i class="bi bi-gear me-1"></i>Diproses
                                        @elseif($pengaduan->status == 'selesai')
                                            <i class="bi bi-check-circle me-1"></i>Selesai
                                        @elseif($pengaduan->status == 'ditolak')
                                            <i class="bi bi-x-circle me-1"></i>Ditolak
                                        @endif
                                    </span>
                                    <span class="text-muted">
                                        <i class="bi bi-ticket me-1"></i>{{ $pengaduan->nomor_tiket }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="action-buttons">
                                    @if(auth()->check() && $pengaduan->status == 'menunggu')
                                        @if(auth()->user()->role != 'warga' ||
                                            (auth()->user()->role == 'warga' && auth()->user()->warga->warga_id == $pengaduan->warga_id))
                                        <a href="{{ route('pengaduan.edit', $pengaduan->pengaduan_id) }}"
                                           class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil me-1"></i>Edit
                                        </a>
                                        @endif
                                    @endif
                                    <a href="{{ route('pengaduan.index') }}"
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
                            <!-- Kolom Kiri - Informasi Dasar -->
                            <div class="col-lg-6">
                                <!-- Informasi Tiket & Kategori -->
                                <div class="info-section mb-3">
                                    <h5 class="section-title mb-2">
                                        <i class="bi bi-info-circle me-2"></i>Informasi Dasar
                                    </h5>
                                    <div class="info-grid">
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-ticket me-1"></i>No Tiket
                                            </div>
                                            <div class="info-value">{{ $pengaduan->nomor_tiket }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-tags me-1"></i>Kategori
                                            </div>
                                            <div class="info-value">{{ $pengaduan->kategori->nama }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-clock me-1"></i>Prioritas
                                            </div>
                                            <div class="info-value">
                                                <span class="badge prioritas-{{ strtolower($pengaduan->kategori->prioritas) }}">
                                                    {{ $pengaduan->kategori->prioritas }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Pengadu -->
                                <div class="info-section mb-3">
                                    <h5 class="section-title mb-2">
                                        <i class="bi bi-person me-2"></i>Informasi Pengadu
                                    </h5>
                                    <div class="info-grid">
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-person-circle me-1"></i>Nama
                                            </div>
                                            <div class="info-value">{{ $pengaduan->warga->nama }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-card-text me-1"></i>NIK
                                            </div>
                                            <div class="info-value">{{ $pengaduan->warga->no_ktp }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-telephone me-1"></i>Telepon
                                            </div>
                                            <div class="info-value">{{ $pengaduan->warga->telp }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-envelope me-1"></i>Email
                                            </div>
                                            <div class="info-value">{{ $pengaduan->warga->email }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan - Informasi Lokasi & Deskripsi -->
                            <div class="col-lg-6">
                                <!-- Informasi Lokasi -->
                                <div class="info-section mb-3">
                                    <h5 class="section-title mb-2">
                                        <i class="bi bi-geo-alt me-2"></i>Informasi Lokasi
                                    </h5>
                                    <div class="info-grid">
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-map me-1"></i>Lokasi
                                            </div>
                                            <div class="info-value">{{ $pengaduan->lokasi_text }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-house-door me-1"></i>RT
                                            </div>
                                            <div class="info-value">{{ $pengaduan->rt }}</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="bi bi-building me-1"></i>RW
                                            </div>
                                            <div class="info-value">{{ $pengaduan->rw }}</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Deskripsi Pengaduan -->
                                <div class="info-section mb-3">
                                    <h5 class="section-title mb-2">
                                        <i class="bi bi-card-text me-2"></i>Deskripsi Pengaduan
                                    </h5>
                                    <div class="description-box">
                                        <p class="mb-0">{{ $pengaduan->deskripsi }}</p>
                                    </div>
                                </div>
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
                                        <span class="timeline-title">Diajukan</span>
                                        <span class="timeline-date">{{ $pengaduan->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <i class="bi bi-arrow-repeat timeline-icon-sm"></i>
                                    <div class="timeline-content">
                                        <span class="timeline-title">Diperbarui</span>
                                        <span class="timeline-date">{{ $pengaduan->updated_at->format('d M Y, H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- File Attachments -->
                    @if ($mediaFiles && $mediaFiles->count() > 0)
                    <div class="info-section files-section mt-3">
                        <h5 class="section-title mb-2">
                            <i class="bi bi-paperclip me-2"></i>Bukti Pendukung
                            <span class="badge bg-175cdd ms-2">{{ $mediaFiles->count() }} file</span>
                        </h5>
                        <div class="row">
                            @foreach ($mediaFiles as $media)
                            <div class="col-md-4 col-lg-3 mb-3">
                                <div class="file-card">
                                    @if (str_starts_with($media->mime_type, 'image/'))
                                    <div class="file-image">
                                        <img src="{{ asset('storage/' . $media->file_name) }}"
                                             class="file-preview"
                                             onclick="openImageModal('{{ asset('storage/' . $media->file_name) }}')"
                                             alt="{{ basename($media->file_name) }}">
                                        <span class="file-badge badge-image">Gambar</span>
                                    </div>
                                    @elseif($media->mime_type == 'application/pdf')
                                    <div class="file-icon pdf-icon">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                        <span class="file-badge badge-pdf">PDF</span>
                                    </div>
                                    <div class="file-name">{{ Str::limit(basename($media->file_name), 20) }}</div>
                                    @else
                                    <div class="file-icon doc-icon">
                                        <i class="bi bi-file-earmark-text"></i>
                                        <span class="file-badge badge-doc">Dokumen</span>
                                    </div>
                                    <div class="file-name">{{ Str::limit(basename($media->file_name), 20) }}</div>
                                    @endif

                                    @if($media->caption)
                                    <div class="file-caption">{{ $media->caption }}</div>
                                    @endif

                                    <div class="file-actions">
                                        <a href="{{ asset('storage/' . $media->file_name) }}"
                                           target="_blank" class="file-action-btn view-btn">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('pengaduan.download.media', [$pengaduan->pengaduan_id, $media->media_id]) }}"
                                           class="file-action-btn download-btn">
                                            <i class="bi bi-download"></i>
                                        </a>
                                        @if(auth()->check() && $pengaduan->status == 'menunggu')
                                            @if(auth()->user()->role != 'warga' ||
                                                (auth()->user()->role == 'warga' && auth()->user()->warga->warga_id == $pengaduan->warga_id))
                                            <form action="{{ route('pengaduan.destroy.media', [$pengaduan->pengaduan_id, $media->media_id]) }}"
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Hapus file ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="file-action-btn delete-btn">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="info-section files-empty-section mt-3">
                        <h5 class="section-title mb-2">
                            <i class="bi bi-paperclip me-2"></i>Bukti Pendukung
                        </h5>
                        <div class="empty-state text-center py-4">
                            <i class="bi bi-folder-x display-4 text-muted mb-3"></i>
                            <h6 class="text-muted">Belum Ada Bukti Pendukung</h6>
                            <p class="text-muted mb-3">Belum ada file yang diupload untuk pengaduan ini</p>
                            @if(auth()->check() && $pengaduan->status == 'menunggu')
                                @if(auth()->user()->role != 'warga' ||
                                    (auth()->user()->role == 'warga' && auth()->user()->warga->warga_id == $pengaduan->warga_id))
                                <a href="{{ route('pengaduan.edit', $pengaduan->pengaduan_id) }}"
                                   class="btn btn-primary btn-sm">
                                    <i class="bi bi-plus-circle me-1"></i>Tambah File
                                </a>
                                @endif
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Penilaian Layanan -->
                    @if(auth()->check() && auth()->user()->role == 'warga' && $pengaduan->status == 'selesai')
                    <div class="info-section rating-section mt-3">
                        <h5 class="section-title mb-2">
                            <i class="bi bi-star me-2"></i>Penilaian Layanan
                            @if($penilaian)
                            <span class="badge bg-success ms-2">Sudah Dinilai</span>
                            @endif
                        </h5>

                        @if(!$penilaian)
                        <div class="rating-form">
                            <h6 class="mb-3">Beri Penilaian untuk Layanan Ini</h6>

                            <form action="{{ route('pengaduan.penilaian', $pengaduan->pengaduan_id) }}" method="POST">
                                @csrf

                                <!-- Rating Stars -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold mb-2">Rating <span class="text-danger">*</span></label>
                                    <div class="rating-stars-input">
                                        @for($i = 1; $i <= 5; $i++)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                   name="rating" id="rating{{ $i }}"
                                                   value="{{ $i }}" required>
                                            <label class="form-check-label rating-label" for="rating{{ $i }}">
                                                @for($j = 1; $j <= $i; $j++)
                                                <i class="bi bi-star-fill text-warning"></i>
                                                @endfor
                                                <span class="ms-2">({{ $i }})</span>
                                            </label>
                                        </div>
                                        @endfor
                                    </div>
                                    <div class="rating-description mt-1">
                                        <small class="text-muted">
                                            1 = Sangat Buruk | 2 = Buruk | 3 = Cukup | 4 = Baik | 5 = Sangat Baik
                                        </small>
                                    </div>
                                </div>

                                <!-- Komentar -->
                                <div class="mb-3">
                                    <label for="komentar" class="form-label fw-bold">Komentar (Opsional)</label>
                                    <textarea name="komentar" id="komentar" rows="3"
                                              class="form-control"
                                              placeholder="Berikan komentar atau saran untuk pelayanan..."
                                              maxlength="500">{{ old('komentar') }}</textarea>
                                    <div class="form-text">
                                        Maksimal 500 karakter. <span id="charCount">0</span>/500
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-check-circle me-1"></i>Simpan Penilaian
                                    </button>
                                </div>
                            </form>
                        </div>
                        @else
                        <div class="rating-display">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <div class="rating-stars-display me-3">
                                            @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $penilaian->rating)
                                            <i class="bi bi-star-fill text-warning fa-lg"></i>
                                            @else
                                            <i class="bi bi-star text-warning fa-lg"></i>
                                            @endif
                                            @endfor
                                        </div>
                                        <div>
                                            <h4 class="mb-0">{{ $penilaian->rating }}/5</h4>
                                            <small class="text-muted">
                                                @if($penilaian->rating == 1) Sangat Buruk
                                                @elseif($penilaian->rating == 2) Buruk
                                                @elseif($penilaian->rating == 3) Cukup
                                                @elseif($penilaian->rating == 4) Baik
                                                @elseif($penilaian->rating == 5) Sangat Baik
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-end">
                                    <small class="text-muted">
                                        <i class="bi bi-calendar me-1"></i>
                                        {{ $penilaian->created_at->format('d M Y, H:i') }}
                                    </small>
                                </div>
                            </div>

                            @if($penilaian->komentar)
                            <div class="mt-3 pt-3 border-top">
                                <h6 class="mb-2">Komentar Anda:</h6>
                                <div class="bg-light p-3 rounded">
                                    <i class="bi bi-quote text-muted me-2"></i>
                                    {{ $penilaian->komentar }}
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section><!-- /Detail Pengaduan Section -->

    <!-- Modal untuk gambar -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Preview Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid" alt="Preview">
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    /* ===========================================
       STYLING DETAIL PENGADUAN - KONSISTEN
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

    /* Icon Circle */
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

    /* Badge Status (sama dengan index) */
    .badge.status-menunggu,
    .badge.status-diproses,
    .badge.status-selesai,
    .badge.status-ditolak {
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.3s ease;
    }

    .badge.status-menunggu {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .badge.status-diproses {
        background: #cce5ff;
        color: #004085;
        border: 1px solid #b8daff;
    }

    .badge.status-selesai {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .badge.status-ditolak {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .badge.prioritas-rendah,
    .badge.prioritas-sedang,
    .badge.prioritas-tinggi,
    .badge.prioritas-kritis {
        padding: 0.25rem 0.6rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.75rem;
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

    .badge.bg-175cdd {
        background: #175cdd;
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

    /* File Attachments */
    .files-section {
        background: #f8f9fa;
    }

    .file-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 1rem;
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .file-card:hover {
        border-color: #175cdd;
        box-shadow: 0 4px 12px rgba(23, 92, 221, 0.1);
        transform: translateY(-3px);
    }

    .file-image {
        position: relative;
        width: 100%;
        height: 150px;
        overflow: hidden;
        border-radius: 8px;
        margin-bottom: 0.75rem;
    }

    .file-preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .file-card:hover .file-preview {
        transform: scale(1.05);
    }

    .file-icon {
        font-size: 3rem;
        margin-bottom: 0.75rem;
        color: #175cdd;
        transition: transform 0.3s ease;
    }

    .file-card:hover .file-icon {
        transform: scale(1.1);
    }

    .pdf-icon {
        color: #dc3545;
    }

    .doc-icon {
        color: #0d6efd;
    }

    .file-badge {
        position: absolute;
        top: 8px;
        right: 8px;
        font-size: 0.6rem;
        padding: 0.2rem 0.5rem;
    }

    .badge-image {
        background: rgba(40, 167, 69, 0.9);
        color: white;
    }

    .badge-pdf {
        background: rgba(220, 53, 69, 0.9);
        color: white;
    }

    .badge-doc {
        background: rgba(13, 110, 253, 0.9);
        color: white;
    }

    .file-name {
        font-size: 0.85rem;
        font-weight: 500;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        text-align: center;
    }

    .file-caption {
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 0.75rem;
        text-align: center;
        flex-grow: 1;
    }

    .file-actions {
        display: flex;
        gap: 0.5rem;
        width: 100%;
        justify-content: center;
    }

    .file-action-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #dee2e6;
        background: #fff;
        color: #6c757d;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .view-btn:hover {
        background: #175cdd;
        color: white;
        border-color: #175cdd;
    }

    .download-btn:hover {
        background: #28a745;
        color: white;
        border-color: #28a745;
    }

    .delete-btn:hover {
        background: #dc3545;
        color: white;
        border-color: #dc3545;
    }

    /* Empty Files Section */
    .files-empty-section {
        background: #f8f9fa;
        text-align: center;
    }

    .empty-state {
        padding: 2rem 0;
    }

    /* Rating Section */
    .rating-section {
        background: #fff8e1;
        border: 1px solid #ffe082;
    }

    .rating-form,
    .rating-display {
        padding: 1rem;
        background: white;
        border-radius: 8px;
        border: 1px solid #e9ecef;
    }

    .rating-stars-input .rating-label {
        cursor: pointer;
        padding: 8px 12px;
        border-radius: 8px;
        border: 2px solid #e0e0e0;
        transition: all 0.3s;
        margin-right: 5px;
        background: white;
    }

    .rating-stars-input .rating-label:hover {
        background-color: #f8f9fa;
        border-color: #ffc107;
    }

    .rating-stars-input .form-check-input:checked + .rating-label {
        background-color: #fff3cd;
        border-color: #ffc107;
        color: #856404;
    }

    .rating-stars-input .form-check-input {
        display: none;
    }

    .rating-stars-display .bi-star-fill,
    .rating-stars-display .bi-star {
        margin-right: 2px;
    }

    .rating-description {
        font-size: 0.85rem;
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

        .file-card {
            padding: 0.75rem;
        }

        .file-image {
            height: 120px;
        }

        .file-icon {
            font-size: 2.5rem;
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

        .rating-stars-input .rating-label {
            padding: 6px 8px;
            font-size: 0.9rem;
        }
    }
</style>

<script>
    function openImageModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
    }

    // Karakter counter untuk textarea
    document.getElementById('komentar')?.addEventListener('input', function() {
        const charCount = document.getElementById('charCount');
        if (charCount) {
            charCount.textContent = this.value.length;
        }
    });
</script>
@endsection
