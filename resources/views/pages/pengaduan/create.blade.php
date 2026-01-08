@extends('layouts.guest.app')

@section('title', 'Ajukan Pengaduan - Bina Desa')

@section('content')
<main class="main">
    <!-- Page Title -->
    <div class="page-title">
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
                    <li><a href="{{ route('pengaduan.index') }}">Data Pengaduan</a></li>
                    <li class="current">Ajukan Pengaduan</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Ajukan Pengaduan Section -->
    <section id="tambah-pengaduan" class="tambah-pengaduan section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <!-- Header Section -->
            <div class="tambah-header mb-4">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="tambah-icon-circle">
                            <div class="tambah-icon">
                                <i class="bi bi-plus-circle"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <h2 class="tambah-title mb-1">Ajukan Pengaduan Baru</h2>
                        <div class="tambah-subtitle">
                            <span class="badge bg-success me-2">
                                <i class="bi bi-plus-lg me-1"></i>Mode Pengajuan
                            </span>
                            <span class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>Isi data dengan lengkap untuk penanganan yang tepat
                            </span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="action-buttons">
                            <a href="{{ route('pengaduan.index') }}"
                               class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-arrow-left me-1"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Form Card -->
            <div class="tambah-card">
                <div class="row">
                    <div class="col-lg-10 mx-auto">
                        <!-- Notifikasi -->
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert"
                                 style="border-radius: 12px; border: 1px solid #d4edda;">
                                <i class="bi bi-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                 style="border-radius: 12px; border: 1px solid #f8d7da;">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <strong>Periksa kesalahan berikut:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Form Tambah -->
                        <form action="{{ route('pengaduan.store') }}" method="POST"
                              class="php-email-form" enctype="multipart/form-data">
                            @csrf

                            <!-- Informasi Pengadu -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-person me-2"></i>Informasi Pengadu
                                </h5>
                                <div class="form-item">
                                    <label for="warga_id" class="form-label">
                                        <i class="bi bi-person-circle me-1"></i>Data Diri *
                                    </label>
                                    <div class="form-input-wrapper">
                                        <select name="warga_id" id="warga_id" class="form-select" required>
                                            <option value="">Pilih Data Diri</option>
                                            @foreach ($warga as $item)
                                                <option value="{{ $item->warga_id }}" {{ old('warga_id') == $item->warga_id ? 'selected' : '' }}>
                                                    {{ $item->nama }} - NIK: {{ $item->no_ktp }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="form-icon">
                                            <i class="bi bi-person-badge"></i>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">
                                        Pilih data diri Anda dari database warga
                                    </small>
                                </div>
                            </div>

                            <!-- Informasi Pengaduan -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-info-circle me-2"></i>Informasi Pengaduan
                                </h5>
                                <div class="form-grid">
                                    <!-- Judul Pengaduan -->
                                    <div class="form-item">
                                        <label for="judul" class="form-label">
                                            <i class="bi bi-card-text me-1"></i>Judul Pengaduan *
                                        </label>
                                        <div class="form-input-wrapper">
                                            <input type="text" name="judul" id="judul" class="form-control"
                                                   placeholder="Contoh: Jalan Rusak di RT 05"
                                                   value="{{ old('judul') }}" required>
                                            <div class="form-icon">
                                                <i class="bi bi-pencil"></i>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            Ringkasan singkat pengaduan (maksimal 100 karakter)
                                        </small>
                                    </div>

                                    <!-- Kategori -->
                                    <div class="form-item">
                                        <label for="kategori_id" class="form-label">
                                            <i class="bi bi-tags me-1"></i>Kategori *
                                        </label>
                                        <div class="form-input-wrapper">
                                            <select name="kategori_id" id="kategori_id" class="form-select" required>
                                                <option value="">Pilih Kategori</option>
                                                @foreach ($kategori as $kat)
                                                    <option value="{{ $kat->kategori_id }}" {{ old('kategori_id') == $kat->kategori_id ? 'selected' : '' }}>
                                                        {{ $kat->nama }} - SLA: {{ $kat->sla_hari }} hari (Prioritas: {{ $kat->prioritas }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="form-icon">
                                                <i class="bi bi-tag"></i>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            Pilih kategori yang sesuai dengan masalah yang diadukan
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Lokasi Pengaduan -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-geo-alt me-2"></i>Lokasi Pengaduan
                                </h5>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-item">
                                            <label for="lokasi_text" class="form-label">
                                                <i class="bi bi-geo me-1"></i>Lokasi Kejadian *
                                            </label>
                                            <div class="form-input-wrapper">
                                                <input type="text" name="lokasi_text" id="lokasi_text" class="form-control"
                                                       value="{{ old('lokasi_text') }}"
                                                       placeholder="Contoh: Jl. Merdeka No. 10, RT 05/RW 02" required>
                                                <div class="form-icon">
                                                    <i class="bi bi-geo-alt"></i>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted">
                                                Alamat lengkap lokasi kejadian
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <label for="rt" class="form-label">
                                                <i class="bi bi-house-door me-1"></i>RT *
                                            </label>
                                            <div class="form-input-wrapper">
                                                <input type="text" name="rt" id="rt" class="form-control"
                                                       value="{{ old('rt') }}" placeholder="Contoh: 001" required>
                                                <div class="form-icon">
                                                    <i class="bi bi-house"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <label for="rw" class="form-label">
                                                <i class="bi bi-building me-1"></i>RW *
                                            </label>
                                            <div class="form-input-wrapper">
                                                <input type="text" name="rw" id="rw" class="form-control"
                                                       value="{{ old('rw') }}" placeholder="Contoh: 002" required>
                                                <div class="form-icon">
                                                    <i class="bi bi-buildings"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Deskripsi Pengaduan -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-card-text me-2"></i>Deskripsi Pengaduan
                                </h5>
                                <div class="form-item">
                                    <label for="deskripsi" class="form-label">
                                        <i class="bi bi-chat-left-text me-1"></i>Deskripsi Pengaduan *
                                    </label>
                                    <div class="form-input-wrapper">
                                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="6"
                                                  placeholder="Jelaskan detail pengaduan Anda..." required>{{ old('deskripsi') }}</textarea>
                                        <div class="form-icon">
                                            <i class="bi bi-card-text"></i>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">
                                        Jelaskan dengan detail tentang masalah yang diadukan (maksimal 5000 karakter)
                                    </small>
                                </div>
                            </div>

                            <!-- File Attachments -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-paperclip me-2"></i>Bukti Pendukung (Opsional)
                                </h5>
                                <div class="form-item">
                                    <label for="files" class="form-label">
                                        <i class="bi bi-plus-circle me-1"></i>Upload File
                                    </label>
                                    <div class="form-input-wrapper">
                                        <input type="file" name="files[]" id="files" class="form-control" multiple
                                               accept="image/*,.pdf,.doc,.docx,.xlsx,.xls,.txt">
                                        <div class="form-icon">
                                            <i class="bi bi-upload"></i>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">
                                        Format: JPG, PNG, PDF, DOC, XLS, TXT. Max 10MB per file.
                                    </small>
                                </div>

                                <div class="form-item">
                                    <label for="caption" class="form-label">
                                        <i class="bi bi-chat-text me-1"></i>Keterangan File (Opsional)
                                    </label>
                                    <div class="form-input-wrapper">
                                        <textarea name="caption" id="caption" class="form-control" rows="2"
                                                  placeholder="Keterangan untuk file (misal: Foto kondisi awal, Bukti dokumen, dll)">{{ old('caption') }}</textarea>
                                        <div class="form-icon">
                                            <i class="bi bi-card-text"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="form-section text-center mt-4">
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="bi bi-send-check me-2"></i>Ajukan Pengaduan
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary btn-lg ms-2">
                                        <i class="bi bi-arrow-clockwise me-2"></i>Reset Form
                                    </button>
                                </div>
                                <div class="form-info mt-3">
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Pengaduan Anda akan segera diproses oleh pihak terkait.
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Info Panduan -->
            <div class="tambah-card mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="form-section">
                            <h5 class="section-title mb-3">
                                <i class="bi bi-lightbulb me-2"></i>Panduan Pengisian
                            </h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="guide-item">
                                        <div class="guide-icon">
                                            <i class="bi bi-check-circle"></i>
                                        </div>
                                        <h6>Data Lengkap</h6>
                                        <p class="small text-muted mb-0">
                                            Isi semua data dengan benar agar pengaduan dapat ditindaklanjuti dengan cepat.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="guide-item">
                                        <div class="guide-icon">
                                            <i class="bi bi-camera"></i>
                                        </div>
                                        <h6>Bukti Visual</h6>
                                        <p class="small text-muted mb-0">
                                            Sertakan foto atau dokumen pendukung untuk memperjelas laporan Anda.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="guide-item">
                                        <div class="guide-icon">
                                            <i class="bi bi-clock"></i>
                                        </div>
                                        <h6>Waktu Respon</h6>
                                        <p class="small text-muted mb-0">
                                            Pengaduan akan diproses sesuai SLA (Service Level Agreement) kategori.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- /Ajukan Pengaduan Section -->
</main>

<style>
    /* ===========================================
       STYLING TAMBAH PENGADUAN - KONSISTEN
       =========================================== */

    /* Tambah Header - Konsisten */
    .tambah-header {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        margin-bottom: 1.5rem;
        border: 1px solid #f0f0f0;
        transition: all 0.3s ease;
    }

    .tambah-header:hover {
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12);
        transform: translateY(-2px);
    }

    /* Icon Circle - Warna hijau untuk tambah */
    .tambah-icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid #e8f5e9;
        box-shadow: 0 2px 8px rgba(40, 167, 69, 0.2);
        transition: all 0.3s ease;
    }

    .tambah-header:hover .tambah-icon-circle {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    }

    .tambah-icon {
        color: white;
        font-size: 1.8rem;
        transition: transform 0.3s ease;
    }

    .tambah-header:hover .tambah-icon {
        transform: scale(1.1);
    }

    /* Title */
    .tambah-title {
        color: #2c3e50;
        font-size: 1.5rem;
        font-weight: 700;
        transition: color 0.3s ease;
    }

    .tambah-header:hover .tambah-title {
        color: #28a745;
    }

    /* Subtitle */
    .tambah-subtitle {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    /* Tambah Card */
    .tambah-card {
        background: #fff;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        border: 1px solid #f0f0f0;
        transition: all 0.3s ease;
    }

    .tambah-card:hover {
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12);
    }

    /* Form Sections */
    .form-section {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .form-section:hover {
        border-color: #175cdd;
        box-shadow: 0 4px 15px rgba(23, 92, 221, 0.1);
        transform: translateY(-2px);
    }

    .form-section:hover::before {
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
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid rgba(23, 92, 221, 0.1);
        transition: all 0.3s ease;
    }

    .form-section:hover .section-title {
        color: #175cdd;
        border-bottom-color: rgba(23, 92, 221, 0.3);
    }

    .section-title i {
        color: #175cdd;
        font-size: 1.1rem;
        width: 24px;
        transition: all 0.3s ease;
    }

    .form-section:hover .section-title i {
        transform: scale(1.2);
        color: #175cdd;
    }

    /* Form Grid */
    .form-grid {
        display: grid;
        gap: 1.25rem;
    }

    /* Form Item */
    .form-item {
        margin-bottom: 0.5rem;
    }

    .form-label {
        color: #495057;
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        font-size: 0.95rem;
        transition: color 0.3s ease;
    }

    .form-item:hover .form-label {
        color: #175cdd;
    }

    .form-label i {
        color: #175cdd;
        margin-right: 0.5rem;
        font-size: 0.95rem;
        width: 18px;
        transition: all 0.3s ease;
    }

    .form-item:hover .form-label i {
        transform: scale(1.2);
    }

    /* Form Input Wrapper */
    .form-input-wrapper {
        position: relative;
        margin-bottom: 0.5rem;
    }

    .form-control,
    .form-select {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        font-size: 0.95rem;
        color: #2c3e50;
        transition: all 0.3s ease;
        background: #fff;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #175cdd;
        box-shadow: 0 0 0 0.25rem rgba(23, 92, 221, 0.15);
        background: #fff;
    }

    .form-control:hover,
    .form-select:hover {
        border-color: #175cdd;
    }

    .form-icon {
        position: absolute;
        left: 0.875rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        font-size: 1rem;
        transition: all 0.3s ease;
        z-index: 2;
    }

    .form-control:focus + .form-icon,
    .form-select:focus + .form-icon {
        color: #175cdd;
        transform: translateY(-50%) scale(1.2);
    }

    /* File Input */
    .form-control[type="file"] {
        padding: 0.75rem 1rem 0.75rem 0.875rem;
    }

    .form-control[type="file"] + .form-icon {
        left: auto;
        right: 0.875rem;
    }

    /* Textarea */
    textarea.form-control {
        min-height: 150px;
        resize: vertical;
    }

    /* Form Text */
    .form-text {
        font-size: 0.825rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        border: none;
        border-radius: 50px;
        padding: 0.75rem 2rem;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
        background: linear-gradient(135deg, #34ce57 0%, #28a745 100%);
    }

    .btn-outline-secondary {
        border: 2px solid #dee2e6;
        border-radius: 50px;
        padding: 0.75rem 2rem;
        font-weight: 500;
        color: #6c757d;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        border-color: #175cdd;
        color: #175cdd;
        background: rgba(23, 92, 221, 0.05);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(23, 92, 221, 0.1);
    }

    /* Form Info */
    .form-info {
        padding: 0.75rem 1rem;
        background: #e7f3ff;
        border-radius: 8px;
        border: 1px solid #b3d7ff;
        transition: all 0.3s ease;
    }

    .form-info:hover {
        background: #d4eaff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(23, 92, 221, 0.1);
    }

    .form-info p {
        margin: 0;
        font-size: 0.9rem;
        color: #175cdd;
    }

    .form-info i {
        color: #175cdd;
        font-size: 1rem;
    }

    /* Guide Items */
    .guide-item {
        background: #fff;
        border-radius: 10px;
        padding: 1.5rem;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
        height: 100%;
        text-align: center;
    }

    .guide-item:hover {
        border-color: #175cdd;
        box-shadow: 0 5px 15px rgba(23, 92, 221, 0.1);
        transform: translateY(-3px);
    }

    .guide-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #175cdd 0%, #0e3d8b 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem auto;
        color: white;
        font-size: 1.5rem;
        transition: all 0.3s ease;
    }

    .guide-item:hover .guide-icon {
        transform: scale(1.1) rotate(5deg);
    }

    .guide-item h6 {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 0.5rem;
        transition: color 0.3s ease;
    }

    .guide-item:hover h6 {
        color: #175cdd;
    }

    /* Alert Styling */
    .alert {
        border-radius: 12px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        border: 1px solid transparent;
    }

    .alert-success {
        background: #e8f5e9;
        border-color: #c3e6cb;
        color: #155724;
    }

    .alert-danger {
        background: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .tambah-header {
            padding: 1rem;
        }

        .tambah-title {
            font-size: 1.25rem;
        }

        .tambah-icon-circle {
            width: 50px;
            height: 50px;
        }

        .tambah-icon {
            font-size: 1.5rem;
        }

        .action-buttons {
            flex-direction: column;
            width: 100%;
        }

        .btn-outline-secondary {
            width: 100%;
            justify-content: center;
        }

        .tambah-card {
            padding: 1.25rem;
        }

        .form-section {
            padding: 1rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-success,
        .btn-outline-secondary {
            width: 100%;
            justify-content: center;
        }

        .form-grid {
            gap: 1rem;
        }

        .col-md-6 {
            margin-bottom: 1rem;
        }

        .guide-item {
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .guide-icon {
            width: 50px;
            height: 50px;
            font-size: 1.25rem;
        }
    }

    @media (max-width: 576px) {
        .section-title {
            font-size: 1rem;
        }

        .form-label {
            font-size: 0.9rem;
        }

        .form-control,
        .form-select {
            padding: 0.625rem 0.875rem 0.625rem 2.25rem;
            font-size: 0.9rem;
        }

        .form-icon {
            left: 0.75rem;
            font-size: 0.9rem;
        }

        .tambah-subtitle {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .col-lg-10 {
            padding: 0;
        }
    }
</style>

<script>
    // Character counter for textarea
    document.getElementById('deskripsi')?.addEventListener('input', function() {
        const charCount = this.value.length;
        const maxChars = 5000;

        if (charCount > maxChars) {
            this.value = this.value.substring(0, maxChars);
            showToast('Deskripsi maksimal 5000 karakter', 'warning');
        }
    });

    // Character counter for judul
    document.getElementById('judul')?.addEventListener('input', function() {
        const charCount = this.value.length;
        const maxChars = 100;

        if (charCount > maxChars) {
            this.value = this.value.substring(0, maxChars);
            showToast('Judul maksimal 100 karakter', 'warning');
        }
    });

    // File size validation
    document.getElementById('files')?.addEventListener('change', function() {
        const maxSize = 10 * 1024 * 1024; // 10MB
        const files = this.files;

        for (let i = 0; i < files.length; i++) {
            if (files[i].size > maxSize) {
                alert(`File "${files[i].name}" melebihi ukuran maksimum 10MB`);
                this.value = '';
                return;
            }
        }
    });

    // Form validation
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const submitBtn = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', function(e) {
            // Validate required fields
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.style.borderColor = '#dc3545';
                    isValid = false;
                } else {
                    field.style.borderColor = '#dee2e6';
                }
            });

            if (!isValid) {
                e.preventDefault();
                showToast('Harap lengkapi semua field yang wajib diisi', 'error');
                return;
            }

            // Show loading state
            if (submitBtn) {
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i> Memproses...';
                submitBtn.disabled = true;

                // Re-enable after 5 seconds if still not submitted
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 5000);
            }
        });

        // Form reset
        const resetBtn = form.querySelector('button[type="reset"]');
        if (resetBtn) {
            resetBtn.addEventListener('click', function() {
                showToast('Form telah direset', 'info');
            });
        }
    });

    // Helper function to show toast
    function showToast(message, type = 'info') {
        // Create toast element
        const toast = document.createElement('div');
        toast.className = `toast-${type}`;
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 16px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            z-index: 9999;
            animation: slideIn 0.3s ease;
        `;

        // Set background color based on type
        if (type === 'error') {
            toast.style.background = '#dc3545';
        } else if (type === 'warning') {
            toast.style.background = '#ffc107';
            toast.style.color = '#212529';
        } else if (type === 'success') {
            toast.style.background = '#28a745';
        } else {
            toast.style.background = '#175cdd';
        }

        toast.textContent = message;
        document.body.appendChild(toast);

        // Remove toast after 3 seconds
        setTimeout(() => {
            toast.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // Add CSS for animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
</script>
@endsection
