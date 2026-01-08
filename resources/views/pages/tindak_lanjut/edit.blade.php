@extends('layouts.guest.app')

@section('title', 'Edit Tindak Lanjut - Bina Desa')

@section('content')
<main class="main">
    <!-- Page Title -->
    <div class="page-title">
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
                    <li><a href="{{ route('tindak_lanjut.index') }}">Data Tindak Lanjut</a></li>
                    <li><a href="{{ route('tindak_lanjut.show', $tindakLanjut->tindak_id) }}">Detail Tindak Lanjut</a></li>
                    <li class="current">Edit Tindak Lanjut</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Edit Tindak Lanjut Section -->
    <section id="edit-tindak-lanjut" class="edit-tindak-lanjut section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <!-- Header Section -->
            <div class="edit-header mb-4">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="edit-icon-circle">
                            <div class="edit-icon">
                                <i class="bi bi-pencil-square"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <h2 class="edit-title mb-1">Edit Tindak Lanjut</h2>
                        <div class="edit-subtitle">
                            <span class="badge bg-warning text-dark me-2">
                                <i class="bi bi-exclamation-triangle me-1"></i>Mode Edit
                            </span>
                            <span class="text-muted">
                                <i class="bi bi-ticket me-1"></i>{{ $tindakLanjut->pengaduan->nomor_tiket }}
                            </span>
                            <span class="badge bg-petugas ms-2">
                                <i class="bi bi-person me-1"></i>{{ $tindakLanjut->petugas }}
                            </span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="action-buttons">
                            <a href="{{ route('tindak_lanjut.show', $tindakLanjut->tindak_id) }}"
                               class="btn btn-outline-info btn-sm">
                                <i class="bi bi-eye me-1"></i>Detail
                            </a>
                            <a href="{{ route('tindak_lanjut.index') }}"
                               class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-arrow-left me-1"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Form Card -->
            <div class="edit-card">
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

                        <!-- Form Edit -->
                        <form action="{{ route('tindak_lanjut.update', $tindakLanjut->tindak_id) }}" method="POST"
                              class="php-email-form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Informasi Pengaduan -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-info-circle me-2"></i>Informasi Pengaduan
                                </h5>
                                <div class="form-grid">
                                    <!-- Pengaduan (Readonly) -->
                                    <div class="form-item">
                                        <label class="form-label">
                                            <i class="bi bi-ticket me-1"></i>Pengaduan
                                        </label>
                                        <div class="form-input-wrapper">
                                            <input type="text" class="form-control"
                                                   value="{{ $tindakLanjut->pengaduan->nomor_tiket }} - {{ $tindakLanjut->pengaduan->judul }}"
                                                   readonly>
                                            <div class="form-icon">
                                                <i class="bi bi-ticket"></i>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            Pengaduan tidak dapat diubah
                                        </small>
                                    </div>

                                    <!-- Warga Pengadu -->
                                    <div class="form-item">
                                        <label class="form-label">
                                            <i class="bi bi-person me-1"></i>Warga Pengadu
                                        </label>
                                        <div class="form-input-wrapper">
                                            <input type="text" class="form-control"
                                                   value="{{ $tindakLanjut->pengaduan->warga->nama }} - {{ $tindakLanjut->pengaduan->warga->no_ktp }}"
                                                   readonly>
                                            <div class="form-icon">
                                                <i class="bi bi-person-circle"></i>
                                            </div>
                                        </div>
                                    </div>
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
                                                   value="{{ old('petugas', $tindakLanjut->petugas) }}"
                                                   placeholder="Contoh: Budi Santoso" required>
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
                                                      placeholder="Jelaskan tindakan yang telah dilakukan..."
                                                      required>{{ old('aksi', $tindakLanjut->aksi) }}</textarea>
                                            <div class="form-icon">
                                                <i class="bi bi-clipboard-data"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-2">
                                            <small class="form-text text-muted">
                                                Wajib diisi
                                            </small>
                                            <small class="form-text">
                                                <span id="aksiCharCount">{{ strlen(old('aksi', $tindakLanjut->aksi)) }}</span>/500
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
                                                      placeholder="Tambahkan catatan jika diperlukan...">{{ old('catatan', $tindakLanjut->catatan) }}</textarea>
                                            <div class="form-icon">
                                                <i class="bi bi-card-text"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-2">
                                            <small class="form-text text-muted">
                                                Opsional
                                            </small>
                                            <small class="form-text">
                                                <span id="catatanCharCount">{{ strlen(old('catatan', $tindakLanjut->catatan)) }}</span>/1000
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- File Attachments -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-paperclip me-2"></i>Dokumentasi Tindak Lanjut
                                </h5>

                                <!-- File yang Sudah Ada -->
                                @if(isset($mediaFiles) && $mediaFiles->count() > 0)
                                <div class="mb-4">
                                    <h6 class="section-subtitle mb-3">
                                        <i class="bi bi-files me-1"></i>File Terupload ({{ $mediaFiles->count() }})
                                    </h6>
                                    <div class="row">
                                        @foreach($mediaFiles as $media)
                                        <div class="col-md-6 col-lg-4 mb-3">
                                            <div class="file-preview-card">
                                                @if(str_starts_with($media->mime_type, 'image/'))
                                                    <div class="file-image-wrapper">
                                                        <img src="{{ asset('storage/' . $media->file_name) }}"
                                                             class="file-preview-img"
                                                             alt="{{ basename($media->file_name) }}">
                                                        <span class="file-badge badge-image">Gambar</span>
                                                    </div>
                                                @else
                                                    <div class="file-icon-wrapper">
                                                        @if($media->mime_type == 'application/pdf')
                                                            <i class="bi bi-file-earmark-pdf pdf-icon"></i>
                                                            <span class="file-badge badge-pdf">PDF</span>
                                                        @else
                                                            <i class="bi bi-file-earmark-text doc-icon"></i>
                                                            <span class="file-badge badge-doc">Dokumen</span>
                                                        @endif
                                                    </div>
                                                @endif
                                                <div class="file-info">
                                                    <div class="file-name">{{ Str::limit(basename($media->file_name), 20) }}</div>
                                                    @if($media->caption)
                                                    <div class="file-caption">{{ $media->caption }}</div>
                                                    @endif
                                                </div>
                                                <div class="file-actions">
                                                    <a href="{{ route('tindak_lanjut.download.media', [$tindakLanjut->tindak_id, $media->media_id]) }}"
                                                       class="file-action-btn download-btn" title="Download">
                                                        <i class="bi bi-download"></i>
                                                    </a>
                                                    <form action="{{ route('tindak_lanjut.destroy.media', [$tindakLanjut->tindak_id, $media->media_id]) }}"
                                                          method="POST" class="d-inline"
                                                          onsubmit="return confirm('Hapus file ini?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="file-action-btn delete-btn" title="Hapus">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                <!-- Upload File Baru -->
                                <div class="mt-3">
                                    <h6 class="section-subtitle mb-3">
                                        <i class="bi bi-plus-circle me-1"></i>Tambah File Baru (Opsional)
                                    </h6>
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

                                    <div class="form-item mt-3">
                                        <label for="caption" class="form-label">
                                            <i class="bi bi-card-text me-1"></i>Keterangan File
                                        </label>
                                        <div class="form-input-wrapper">
                                            <textarea name="caption" id="caption" class="form-control" rows="2"
                                                      placeholder="Keterangan untuk file baru (opsional)">{{ old('caption') }}</textarea>
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
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-check-circle me-2"></i>Update Tindak Lanjut
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary btn-lg ms-2">
                                        <i class="bi bi-arrow-clockwise me-2"></i>Reset
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
        </div>
    </section><!-- /Edit Tindak Lanjut Section -->
</main>

<style>
    /* ===========================================
       STYLING EDIT TINDAK LANJUT - KONSISTEN
       =========================================== */

    /* Edit Header - Konsisten */
    .edit-header {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        margin-bottom: 1.5rem;
        border: 1px solid #f0f0f0;
        transition: all 0.3s ease;
    }

    .edit-header:hover {
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.12);
        transform: translateY(-2px);
    }

    /* Icon Circle - Warna kuning untuk edit */
    .edit-icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid #fff3cd;
        box-shadow: 0 2px 8px rgba(255, 193, 7, 0.2);
        transition: all 0.3s ease;
    }

    .edit-header:hover .edit-icon-circle {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
    }

    .edit-icon {
        color: white;
        font-size: 1.8rem;
        transition: transform 0.3s ease;
    }

    .edit-header:hover .edit-icon {
        transform: rotate(-15deg);
    }

    /* Title */
    .edit-title {
        color: #2c3e50;
        font-size: 1.5rem;
        font-weight: 700;
        transition: color 0.3s ease;
    }

    .edit-header:hover .edit-title {
        color: #ff9800;
    }

    /* Subtitle */
    .edit-subtitle {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    /* Badge Petugas (sama dengan index/show) */
    .badge.bg-petugas {
        padding: 0.25rem 0.6rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.75rem;
        transition: all 0.3s ease;
        border: 1px solid #d1e0ff;
        background: #e8f4ff;
        color: #175cdd;
    }

    .badge.bg-petugas:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-outline-info,
    .btn-outline-secondary {
        border-radius: 50px;
        padding: 6px 12px;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .btn-outline-info {
        border-color: #0dcaf0;
        color: #0dcaf0;
    }

    .btn-outline-info:hover {
        border-color: #175cdd;
        color: #175cdd;
        background: rgba(23, 92, 221, 0.05);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(23, 92, 221, 0.1);
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

    /* Edit Card */
    .edit-card {
        background: #fff;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        border: 1px solid #f0f0f0;
        transition: all 0.3s ease;
    }

    .edit-card:hover {
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

    /* Section Subtitle */
    .section-subtitle {
        color: #6c757d;
        font-size: 0.95rem;
        font-weight: 500;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .section-subtitle i {
        color: #175cdd;
        margin-right: 0.5rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-section:hover .section-subtitle {
        color: #175cdd;
    }

    .form-section:hover .section-subtitle i {
        transform: scale(1.2);
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

    .form-control[readonly] {
        background-color: #f8f9fa;
        color: #6c757d;
        border-color: #e9ecef;
    }

    .form-control[readonly]:hover {
        border-color: #e9ecef;
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

    /* File Preview Card */
    .file-preview-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 0.75rem;
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .file-preview-card:hover {
        border-color: #175cdd;
        box-shadow: 0 4px 12px rgba(23, 92, 221, 0.1);
        transform: translateY(-3px);
    }

    .file-image-wrapper {
        position: relative;
        width: 100%;
        height: 120px;
        overflow: hidden;
        border-radius: 6px;
        margin-bottom: 0.5rem;
    }

    .file-preview-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .file-preview-card:hover .file-preview-img {
        transform: scale(1.05);
    }

    .file-icon-wrapper {
        position: relative;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        color: #175cdd;
        transition: transform 0.3s ease;
    }

    .file-preview-card:hover .file-icon-wrapper {
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
        top: 6px;
        right: 6px;
        font-size: 0.55rem;
        padding: 0.15rem 0.4rem;
        border-radius: 6px;
        font-weight: 600;
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

    .file-info {
        flex-grow: 1;
        width: 100%;
        text-align: center;
    }

    .file-name {
        font-size: 0.8rem;
        font-weight: 500;
        color: #2c3e50;
        margin-bottom: 0.25rem;
        word-break: break-all;
    }

    .file-caption {
        font-size: 0.7rem;
        color: #6c757d;
        margin-bottom: 0.5rem;
    }

    .file-actions {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        width: 100%;
    }

    .file-action-btn {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #dee2e6;
        background: #fff;
        color: #6c757d;
        transition: all 0.3s ease;
        text-decoration: none;
        font-size: 0.75rem;
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

    /* Form Actions */
    .form-actions {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn-primary {
        background: linear-gradient(135deg, #175cdd 0%, #0e3d8b 100%);
        border: none;
        border-radius: 50px;
        padding: 0.75rem 2rem;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(23, 92, 221, 0.3);
        background: linear-gradient(135deg, #1a6eff 0%, #1248b8 100%);
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

    .alert-warning {
        background: #fff3cd;
        border-color: #ffeaa7;
        color: #856404;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .edit-header {
            padding: 1rem;
        }

        .edit-title {
            font-size: 1.25rem;
        }

        .edit-icon-circle {
            width: 50px;
            height: 50px;
        }

        .edit-icon {
            font-size: 1.5rem;
        }

        .action-buttons {
            flex-direction: column;
            width: 100%;
        }

        .btn-outline-info,
        .btn-outline-secondary {
            width: 100%;
            justify-content: center;
        }

        .edit-card {
            padding: 1.25rem;
        }

        .form-section {
            padding: 1rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-primary,
        .btn-outline-secondary {
            width: 100%;
            justify-content: center;
        }

        .form-grid {
            gap: 1rem;
        }

        .file-preview-card {
            padding: 0.5rem;
        }

        .file-image-wrapper {
            height: 100px;
        }

        .file-icon-wrapper {
            font-size: 2rem;
        }
    }

    @media (max-width: 576px) {
        .section-title {
            font-size: 1rem;
        }

        .section-subtitle {
            font-size: 0.9rem;
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

        .edit-subtitle {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .col-lg-8 {
            padding: 0;
        }

        .file-actions {
            flex-wrap: wrap;
        }

        .file-action-btn {
            width: 24px;
            height: 24px;
            font-size: 0.65rem;
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

        // File upload validation
        const fileInput = document.getElementById('files');
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const files = this.files;
                const maxSize = 10 * 1024 * 1024; // 10MB
                const allowedTypes = [
                    'image/jpeg', 'image/png', 'image/jpg', 'image/gif',
                    'application/pdf',
                    'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                ];

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];

                    // Check file size
                    if (file.size > maxSize) {
                        showToast(`File "${file.name}" melebihi 10MB`, 'error');
                        this.value = '';
                        return;
                    }

                    // Check file type
                    if (!allowedTypes.includes(file.type)) {
                        showToast(`Format file "${file.name}" tidak didukung`, 'error');
                        this.value = '';
                        return;
                    }
                }

                if (files.length > 0) {
                    showToast(`${files.length} file siap diupload`, 'success');
                }
            });
        }

        // Form validation
        const form = document.querySelector('form');
        const submitBtn = form?.querySelector('button[type="submit"]');

        if (submitBtn) {
            form.addEventListener('submit', function(e) {
                // Validate required fields
                const petugas = form.querySelector('#petugas');
                const aksi = form.querySelector('#aksi');

                if (!petugas.value.trim()) {
                    e.preventDefault();
                    showToast('Harap isi nama petugas', 'error');
                    petugas.focus();
                    return;
                }

                if (!aksi.value.trim()) {
                    e.preventDefault();
                    showToast('Harap isi aksi yang dilakukan', 'error');
                    aksi.focus();
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

        // Reset form confirmation
        const resetBtn = form?.querySelector('button[type="reset"]');
        if (resetBtn) {
            resetBtn.addEventListener('click', function(e) {
                if (!confirm('Reset semua perubahan? Data akan dikembalikan ke nilai semula.')) {
                    e.preventDefault();
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
