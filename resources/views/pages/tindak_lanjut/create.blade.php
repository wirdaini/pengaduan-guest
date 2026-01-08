@extends('layouts.guest.app')

@section('title', 'Tambah Tindak Lanjut - Bina Desa')

@section('content')
<main class="main">
    <!-- Page Title -->
    <div class="page-title">
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
                    <li><a href="{{ route('tindak_lanjut.index') }}">Data Tindak Lanjut</a></li>
                    <li class="current">Tambah Tindak Lanjut</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Tambah Tindak Lanjut Section -->
    <section id="tambah-tindak-lanjut" class="tambah-tindak-lanjut section">
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
                        <h2 class="tambah-title mb-1">Tambah Tindak Lanjut Baru</h2>
                        <div class="tambah-subtitle">
                            <span class="badge bg-success me-2">
                                <i class="bi bi-plus-lg me-1"></i>Mode Tambah
                            </span>
                            <span class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>Catat setiap tindakan untuk meningkatkan layanan
                            </span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="action-buttons">
                            <a href="{{ route('tindak_lanjut.index') }}"
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
                    <div class="col-lg-8 mx-auto">
                        <!-- Notifikasi -->
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert"
                                 style="border-radius: 12px; border: 1px solid #d4edda;">
                                <i class="bi bi-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                 style="border-radius: 12px; border: 1px solid #f8d7da;">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                {{ session('error') }}
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

                        <!-- Info Penting -->
                        <div class="form-info-section mb-4">
                            <div class="info-box bg-light-primary">
                                <i class="bi bi-info-circle text-primary"></i>
                                <div>
                                    <strong>Informasi Penting:</strong> Setelah menyimpan tindak lanjut, status pengaduan akan otomatis berubah menjadi 'diproses'.
                                </div>
                            </div>
                        </div>

                        <!-- Form Tambah -->
                        <form action="{{ route('tindak_lanjut.store') }}" method="POST"
                              class="php-email-form" enctype="multipart/form-data">
                            @csrf

                            <!-- Pilih Pengaduan -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-inbox me-2"></i>Pilih Pengaduan
                                </h5>
                                <div class="form-item">
                                    <label for="pengaduan_id" class="form-label">
                                        <i class="bi bi-ticket me-1"></i>Pengaduan yang Akan Ditindaklanjuti *
                                    </label>
                                    <div class="form-input-wrapper">
                                        <select name="pengaduan_id" id="pengaduan_id" class="form-select" required>
                                            <option value="">Pilih Pengaduan</option>
                                            @foreach ($pengaduan as $item)
                                                <option value="{{ $item->pengaduan_id }}" {{ old('pengaduan_id') == $item->pengaduan_id ? 'selected' : '' }}>
                                                    {{ $item->nomor_tiket }} - {{ Str::limit($item->judul, 40) }}
                                                    ({{ $item->created_at->format('d M Y') }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="form-icon">
                                            <i class="bi bi-ticket"></i>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">
                                        Hanya menampilkan pengaduan dengan status 'menunggu' atau 'diproses'
                                    </small>
                                </div>
                            </div>

                            <!-- Informasi Tindak Lanjut -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-clipboard-check me-2"></i>Informasi Tindak Lanjut
                                </h5>
                                <div class="form-grid">
                                    <!-- Petugas -->
                                    <div class="form-item">
                                        <label for="petugas" class="form-label">
                                            <i class="bi bi-person-badge me-1"></i>Nama Petugas *
                                        </label>
                                        <div class="form-input-wrapper">
                                            <input type="text" name="petugas" id="petugas" class="form-control"
                                                   value="{{ old('petugas') }}"
                                                   placeholder="Contoh: Budi Santoso, S.Kom" required>
                                            <div class="form-icon">
                                                <i class="bi bi-person-badge"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Aksi -->
                                    <div class="form-item">
                                        <label for="aksi" class="form-label">
                                            <i class="bi bi-clipboard-data me-1"></i>Aksi yang Dilakukan *
                                        </label>
                                        <div class="form-input-wrapper">
                                            <textarea name="aksi" id="aksi" class="form-control" rows="4"
                                                      placeholder="Jelaskan secara detail tindakan yang telah dilakukan..."
                                                      required>{{ old('aksi') }}</textarea>
                                            <div class="form-icon">
                                                <i class="bi bi-clipboard-data"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-2">
                                            <small class="form-text text-muted">
                                                Wajib diisi
                                            </small>
                                            <small class="form-text">
                                                <span id="aksiCharCount">{{ strlen(old('aksi', '')) }}</span>/500
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Catatan -->
                                    <div class="form-item">
                                        <label for="catatan" class="form-label">
                                            <i class="bi bi-card-text me-1"></i>Catatan Tambahan
                                        </label>
                                        <div class="form-input-wrapper">
                                            <textarea name="catatan" id="catatan" class="form-control" rows="3"
                                                      placeholder="Tambahkan catatan jika diperlukan...">{{ old('catatan') }}</textarea>
                                            <div class="form-icon">
                                                <i class="bi bi-card-text"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-2">
                                            <small class="form-text text-muted">
                                                Opsional
                                            </small>
                                            <small class="form-text">
                                                <span id="catatanCharCount">{{ strlen(old('catatan', '')) }}</span>/1000
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Dokumentasi Tindak Lanjut -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-paperclip me-2"></i>Dokumentasi Tindak Lanjut (Opsional)
                                </h5>

                                <!-- Upload File Baru -->
                                <div class="mt-3">
                                    <div class="form-item">
                                        <label for="files" class="form-label">
                                            <i class="bi bi-upload me-1"></i>Pilih File
                                        </label>
                                        <div class="form-input-wrapper">
                                            <input type="file" name="files[]" id="files" class="form-control"
                                                   multiple accept="image/*,.pdf,.doc,.docx,.xlsx,.xls">
                                            <div class="form-icon">
                                                <i class="bi bi-upload"></i>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            Format: JPG, PNG, PDF, DOC, XLSX. Maksimal 10MB per file.
                                        </small>
                                    </div>

                                    <!-- Preview File -->
                                    <div id="file-preview" class="mt-3"></div>

                                    <div class="form-item mt-3">
                                        <label for="caption" class="form-label">
                                            <i class="bi bi-card-text me-1"></i>Keterangan File
                                        </label>
                                        <div class="form-input-wrapper">
                                            <textarea name="caption" id="caption" class="form-control" rows="2"
                                                      placeholder="Keterangan untuk semua file (misal: Foto kondisi, Laporan teknis, dll)">{{ old('caption') }}</textarea>
                                            <div class="form-icon">
                                                <i class="bi bi-card-text"></i>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            Keterangan akan diterapkan untuk semua file yang diupload
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="form-section text-center mt-4">
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="bi bi-save me-2"></i>Simpan Tindak Lanjut
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary btn-lg ms-2">
                                        <i class="bi bi-arrow-clockwise me-2"></i>Reset Form
                                    </button>
                                </div>
                                <div class="form-info mt-3">
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Pastikan data yang dimasukkan akurat dan sesuai dengan tindakan yang dilakukan.
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Panduan Pengisian -->
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
                                            <i class="bi bi-ticket text-primary"></i>
                                        </div>
                                        <h6>Pilih Pengaduan</h6>
                                        <p class="small text-muted mb-0">
                                            Pilih pengaduan yang akan ditindaklanjuti dari daftar yang tersedia
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="guide-item">
                                        <div class="guide-icon">
                                            <i class="bi bi-clipboard-check text-success"></i>
                                        </div>
                                        <h6>Detail Tindakan</h6>
                                        <p class="small text-muted mb-0">
                                            Jelaskan tindakan secara rinci untuk dokumentasi yang akurat
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="guide-item">
                                        <div class="guide-icon">
                                            <i class="bi bi-paperclip text-warning"></i>
                                        </div>
                                        <h6>Dokumentasi</h6>
                                        <p class="small text-muted mb-0">
                                            Upload bukti dokumentasi untuk mendukung tindakan yang dilakukan
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- /Tambah Tindak Lanjut Section -->
</main>

<style>
    /* ===========================================
       STYLING TAMBAH TINDAK LANJUT - KONSISTEN
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

    /* Form Info Section */
    .form-info-section {
        margin-bottom: 1.5rem;
    }

    .info-box {
        padding: 1rem 1.25rem;
        border-radius: 10px;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        transition: all 0.3s ease;
    }

    .bg-light-primary {
        background: #e7f3ff;
        border: 1px solid #b3d7ff;
        color: #175cdd;
    }

    .info-box i {
        font-size: 1.25rem;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .info-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(23, 92, 221, 0.1);
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

    /* Textarea */
    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    /* Form Text */
    .form-text {
        font-size: 0.825rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }

    /* File Preview */
    #file-preview .alert {
        border-radius: 10px;
        border: 1px solid #e9ecef;
        background: #fff;
    }

    #file-preview ul {
        margin: 0;
        padding-left: 1rem;
    }

    #file-preview li {
        padding: 0.5rem 0;
        border-bottom: 1px solid #f0f0f0;
    }

    #file-preview li:last-child {
        border-bottom: none;
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
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #175cdd;
        transition: transform 0.3s ease;
    }

    .guide-item:hover .guide-icon {
        transform: scale(1.1);
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

        .guide-item {
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .guide-icon {
            font-size: 2rem;
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

        .col-lg-8 {
            padding: 0;
        }

        .guide-item h6 {
            font-size: 0.95rem;
        }

        .form-grid {
            gap: 1rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Character counter untuk aksi
        const aksiTextarea = document.getElementById('aksi');
        const aksiCharCount = document.getElementById('aksiCharCount');

        if (aksiTextarea) {
            aksiTextarea.addEventListener('input', function() {
                const charCount = this.value.length;
                const maxChars = 500;

                // Update counter
                aksiCharCount.textContent = charCount;

                // Warn if approaching limit
                if (charCount > maxChars * 0.9) {
                    this.style.borderColor = '#ffc107';
                } else {
                    this.style.borderColor = '';
                }

                // Truncate if exceeds limit
                if (charCount > maxChars) {
                    this.value = this.value.substring(0, maxChars);
                    showToast('Aksi maksimal 500 karakter', 'warning');
                }
            });

            // Trigger input event untuk set initial count
            aksiTextarea.dispatchEvent(new Event('input'));
        }

        // Character counter untuk catatan
        const catatanTextarea = document.getElementById('catatan');
        const catatanCharCount = document.getElementById('catatanCharCount');

        if (catatanTextarea) {
            catatanTextarea.addEventListener('input', function() {
                const charCount = this.value.length;
                const maxChars = 1000;

                // Update counter
                catatanCharCount.textContent = charCount;

                // Warn if approaching limit
                if (charCount > maxChars * 0.9) {
                    this.style.borderColor = '#ffc107';
                } else {
                    this.style.borderColor = '';
                }

                // Truncate if exceeds limit
                if (charCount > maxChars) {
                    this.value = this.value.substring(0, maxChars);
                    showToast('Catatan maksimal 1000 karakter', 'warning');
                }
            });

            // Trigger input event untuk set initial count
            catatanTextarea.dispatchEvent(new Event('input'));
        }

        // File upload validation and preview
        const fileInput = document.getElementById('files');
        const filePreview = document.getElementById('file-preview');

        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const files = this.files;
                const maxSize = 10 * 1024 * 1024; // 10MB
                const allowedTypes = [
                    'image/jpeg', 'image/png', 'image/jpg', 'image/gif',
                    'application/pdf',
                    'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                ];

                // Clear previous preview
                filePreview.innerHTML = '';

                if (files.length > 0) {
                    let html = '<div class="alert alert-light"><h6>File yang akan diupload:</h6><ul class="mb-0">';
                    let hasError = false;

                    Array.from(files).forEach((file, index) => {
                        // Check file size
                        if (file.size > maxSize) {
                            showToast(`File "${file.name}" melebihi 10MB`, 'error');
                            hasError = true;
                            return;
                        }

                        // Check file type
                        if (!allowedTypes.includes(file.type)) {
                            showToast(`Format file "${file.name}" tidak didukung`, 'error');
                            hasError = true;
                            return;
                        }

                        // Get icon based on file type
                        let icon = 'bi-file-earmark';
                        if (file.type.startsWith('image/')) {
                            icon = 'bi-file-earmark-image text-success';
                        } else if (file.type === 'application/pdf') {
                            icon = 'bi-file-earmark-pdf text-danger';
                        } else if (file.type.includes('word') || file.type.includes('document')) {
                            icon = 'bi-file-earmark-word text-primary';
                        } else if (file.type.includes('excel') || file.type.includes('spreadsheet')) {
                            icon = 'bi-file-earmark-excel text-success';
                        }

                        html += `
                            <li class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <span class="badge bg-secondary me-2">${index + 1}</span>
                                    <i class="bi ${icon} me-2"></i>
                                    ${file.name}
                                    <br>
                                    <small class="text-muted">
                                        <i class="bi bi-info-circle"></i> ${file.type} •
                                        ${(file.size/1024).toFixed(2)} KB
                                    </small>
                                </div>
                            </li>`;
                    });

                    html += '</ul></div>';

                    if (!hasError) {
                        filePreview.innerHTML = html;
                        showToast(`${files.length} file siap diupload`, 'success');
                    } else {
                        this.value = '';
                        filePreview.innerHTML = '';
                    }
                }
            });
        }

        // Form validation
        const form = document.querySelector('form');
        const submitBtn = form?.querySelector('button[type="submit"]');

        if (submitBtn) {
            form.addEventListener('submit', function(e) {
                // Validate required fields
                const pengaduanSelect = form.querySelector('#pengaduan_id');
                const petugasInput = form.querySelector('#petugas');
                const aksiTextarea = form.querySelector('#aksi');

                if (!pengaduanSelect.value) {
                    e.preventDefault();
                    showToast('Harap pilih pengaduan terlebih dahulu', 'error');
                    pengaduanSelect.focus();
                    return;
                }

                if (!petugasInput.value.trim()) {
                    e.preventDefault();
                    showToast('Harap isi nama petugas', 'error');
                    petugasInput.focus();
                    return;
                }

                if (!aksiTextarea.value.trim()) {
                    e.preventDefault();
                    showToast('Harap isi aksi yang dilakukan', 'error');
                    aksiTextarea.focus();
                    return;
                }

                // Show loading state
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i> Memproses...';
                submitBtn.disabled = true;

                // Re-enable after 5 seconds if still not submitted
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 5000);
            });
        }

        // Form reset
        const resetBtn = form?.querySelector('button[type="reset"]');
        if (resetBtn) {
            resetBtn.addEventListener('click', function() {
                // Clear file preview
                if (filePreview) {
                    filePreview.innerHTML = '';
                }

                showToast('Form telah direset', 'info');
            });
        }

        // Pengaduan select change event
        const pengaduanSelect = document.getElementById('pengaduan_id');
        if (pengaduanSelect) {
            pengaduanSelect.addEventListener('change', function() {
                if (this.value) {
                    const selectedOption = this.options[this.selectedIndex];
                    showToast(`Pengaduan dipilih: ${selectedOption.text}`, 'info');
                }
            });
        }

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
                max-width: 300px;
                word-wrap: break-word;
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

        // Add CSS for animations if not exists
        if (!document.querySelector('#toast-animations')) {
            const style = document.createElement('style');
            style.id = 'toast-animations';
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
        }
    });
</script>
@endsection
