@extends('layouts.guest.app')

@section('title', 'Beri Penilaian Layanan - Bina Desa')

@section('content')
<main class="main">
    <!-- Page Title -->
    <div class="page-title">
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
                    <li><a href="{{ route('penilaian_layanan.index') }}">Data Penilaian</a></li>
                    <li class="current">Beri Penilaian</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Beri Penilaian Section -->
    <section id="tambah-penilaian" class="tambah-penilaian section">
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
                        <h2 class="tambah-title mb-1">Beri Penilaian Layanan Baru</h2>
                        <div class="tambah-subtitle">
                            <span class="badge bg-success me-2">
                                <i class="bi bi-plus-lg me-1"></i>Mode Penilaian
                            </span>
                            <span class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>Berikan penilaian jujur untuk kualitas layanan
                            </span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="action-buttons">
                            <a href="{{ route('penilaian_layanan.index') }}"
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
                            <div class="info-box bg-light-warning">
                                <i class="bi bi-info-circle text-warning"></i>
                                <div>
                                    <strong>Informasi Penting:</strong> Penilaian hanya dapat diedit dalam 24 jam setelah dibuat.
                                </div>
                            </div>
                        </div>

                        <!-- Form Tambah -->
                        <form action="{{ route('penilaian_layanan.store') }}" method="POST"
                              class="php-email-form">
                            @csrf

                            <!-- Pilih Pengaduan -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-inbox me-2"></i>Pilih Pengaduan
                                </h5>
                                <div class="form-item">
                                    <label for="pengaduan_id" class="form-label">
                                        <i class="bi bi-ticket me-1"></i>Pengaduan yang Selesai *
                                    </label>
                                    <div class="form-input-wrapper">
                                        <select name="pengaduan_id" id="pengaduan_id" class="form-select" required>
                                            <option value="">Pilih Pengaduan yang Sudah Selesai</option>
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
                                        Hanya menampilkan pengaduan dengan status 'Selesai' dan belum dinilai
                                    </small>
                                </div>
                            </div>

                            <!-- Rating Pelayanan -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-star me-2"></i>Rating Pelayanan
                                </h5>
                                <div class="rating-input-wrapper">
                                    <div class="rating-stars-input">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="star{{ $i }}" name="rating"
                                                   value="{{ $i }}"
                                                   {{ old('rating') == $i ? 'checked' : '' }}
                                                   required>
                                            <label for="star{{ $i }}" class="rating-label"
                                                   title="{{ $i }} bintang">
                                                <i class="bi bi-star-fill"></i>
                                                <span class="rating-number">{{ $i }}</span>
                                            </label>
                                        @endfor
                                    </div>
                                    <div class="rating-display mt-3" id="ratingDisplay" style="display: none;">
                                        <div class="selected-rating">
                                            <span class="rating-text">
                                                Rating Terpilih: <strong><span id="selectedRating">0</span>/5</strong>
                                            </span>
                                            <span class="rating-description ms-2" id="selectedRatingDesc"></span>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted text-center d-block mt-2">
                                        1 = Sangat Tidak Puas | 5 = Sangat Puas
                                    </small>
                                </div>
                            </div>

                            <!-- Komentar -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-chat-left-text me-2"></i>Komentar (Opsional)
                                </h5>
                                <div class="form-item">
                                    <div class="form-input-wrapper">
                                        <textarea name="komentar" id="komentar" class="form-control" rows="4"
                                                  placeholder="Bagikan pengalaman atau saran perbaikan..."
                                                  maxlength="500">{{ old('komentar') }}</textarea>
                                        <div class="form-icon">
                                            <i class="bi bi-card-text"></i>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <small class="form-text text-muted">
                                            Maksimal 500 karakter
                                        </small>
                                        <small class="form-text">
                                            <span id="charCount">{{ strlen(old('komentar', '')) }}</span>/500
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="form-section text-center mt-4">
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="bi bi-send-check me-2"></i>Kirim Penilaian
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary btn-lg ms-2">
                                        <i class="bi bi-arrow-clockwise me-2"></i>Reset Form
                                    </button>
                                </div>
                                <div class="form-info mt-3">
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Penilaian Anda akan membantu kami meningkatkan kualitas pelayanan.
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Panduan Rating -->
            <div class="tambah-card mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="form-section">
                            <h5 class="section-title mb-3">
                                <i class="bi bi-lightbulb me-2"></i>Panduan Rating
                            </h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="rating-guide-item">
                                        <div class="rating-guide-stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star-fill text-warning"></i>
                                            @endfor
                                        </div>
                                        <h6>Sangat Puas (5)</h6>
                                        <p class="small text-muted mb-0">
                                            Layanan melebihi ekspektasi, penanganan sangat cepat dan memuaskan
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="rating-guide-item">
                                        <div class="rating-guide-stars">
                                            @for ($i = 1; $i <= 4; $i++)
                                                <i class="bi bi-star-fill text-primary"></i>
                                            @endfor
                                            <i class="bi bi-star text-muted"></i>
                                        </div>
                                        <h6>Puas (4)</h6>
                                        <p class="small text-muted mb-0">
                                            Layanan baik, sesuai dengan yang diharapkan, respon tepat waktu
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="rating-guide-item">
                                        <div class="rating-guide-stars">
                                            @for ($i = 1; $i <= 3; $i++)
                                                <i class="bi bi-star-fill text-secondary"></i>
                                            @endfor
                                            @for ($i = 1; $i <= 2; $i++)
                                                <i class="bi bi-star text-muted"></i>
                                            @endfor
                                        </div>
                                        <h6>Cukup (3)</h6>
                                        <p class="small text-muted mb-0">
                                            Layanan cukup memadai, ada beberapa hal yang perlu ditingkatkan
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- /Beri Penilaian Section -->
</main>

<style>
    /* ===========================================
       STYLING TAMBAH PENILAIAN - KONSISTEN
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

    .bg-light-warning {
        background: #fff3cd;
        border: 1px solid #ffeaa7;
        color: #856404;
    }

    .info-box i {
        font-size: 1.25rem;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .info-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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

    /* Rating Input Wrapper */
    .rating-input-wrapper {
        text-align: center;
    }

    .rating-stars-input {
        display: flex;
        justify-content: center;
        flex-direction: row-reverse;
        gap: 10px;
        margin-bottom: 1rem;
    }

    .rating-stars-input input[type="radio"] {
        display: none;
    }

    .rating-stars-input .rating-label {
        position: relative;
        font-size: 3rem;
        color: #e0e0e0;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 5px;
    }

    .rating-stars-input .rating-label i {
        transition: all 0.3s ease;
    }

    .rating-stars-input .rating-label .rating-number {
        font-size: 0.875rem;
        font-weight: 600;
        color: #6c757d;
        transition: all 0.3s ease;
    }

    .rating-stars-input .rating-label:hover i,
    .rating-stars-input .rating-label:hover ~ .rating-label i,
    .rating-stars-input input[type="radio"]:checked ~ .rating-label i {
        color: #ffc107;
        transform: scale(1.1);
    }

    .rating-stars-input .rating-label:hover .rating-number,
    .rating-stars-input input[type="radio"]:checked ~ .rating-label .rating-number {
        color: #ffc107;
        font-weight: 700;
    }

    .rating-stars-input input[type="radio"]:checked + .rating-label i {
        filter: drop-shadow(0 2px 4px rgba(255, 193, 7, 0.3));
    }

    /* Rating Display */
    .rating-display {
        padding: 1rem;
        background: white;
        border-radius: 10px;
        border: 1px solid #e9ecef;
        animation: fadeIn 0.3s ease;
    }

    .selected-rating {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .rating-text {
        font-size: 1rem;
        color: #2c3e50;
    }

    .rating-text strong {
        color: #175cdd;
    }

    .rating-description {
        font-size: 0.9rem;
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Rating Guide Items */
    .rating-guide-item {
        background: #fff;
        border-radius: 10px;
        padding: 1.5rem;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
        height: 100%;
        text-align: center;
    }

    .rating-guide-item:hover {
        border-color: #175cdd;
        box-shadow: 0 5px 15px rgba(23, 92, 221, 0.1);
        transform: translateY(-3px);
    }

    .rating-guide-stars {
        margin-bottom: 0.75rem;
        font-size: 1.25rem;
    }

    .rating-guide-item h6 {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 0.5rem;
        transition: color 0.3s ease;
    }

    .rating-guide-item:hover h6 {
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

        .rating-guide-item {
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .rating-stars-input {
            gap: 5px;
        }

        .rating-stars-input .rating-label {
            font-size: 2.5rem;
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

        .rating-stars-input .rating-label {
            font-size: 2rem;
        }

        .selected-rating {
            flex-direction: column;
            gap: 5px;
            text-align: center;
        }

        .rating-text {
            font-size: 0.9rem;
        }

        .rating-description {
            font-size: 0.8rem;
        }

        .rating-guide-item h6 {
            font-size: 0.95rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Rating star interaction
        const stars = document.querySelectorAll('.rating-stars-input input[type="radio"]');
        const ratingDisplay = document.getElementById('ratingDisplay');
        const selectedRatingSpan = document.getElementById('selectedRating');
        const selectedRatingDesc = document.getElementById('selectedRatingDesc');
        const charCount = document.getElementById('charCount');
        const komentarTextarea = document.getElementById('komentar');

        const ratingDescriptions = {
            1: {
                icon: 'bi bi-emoji-angry',
                text: 'Sangat Tidak Puas',
                color: 'text-danger'
            },
            2: {
                icon: 'bi bi-emoji-frown',
                text: 'Tidak Puas',
                color: 'text-danger'
            },
            3: {
                icon: 'bi bi-emoji-neutral',
                text: 'Cukup Puas',
                color: 'text-warning'
            },
            4: {
                icon: 'bi bi-emoji-smile',
                text: 'Puas',
                color: 'text-primary'
            },
            5: {
                icon: 'bi bi-emoji-laughing',
                text: 'Sangat Puas',
                color: 'text-success'
            }
        };

        stars.forEach(star => {
            star.addEventListener('change', function() {
                const value = parseInt(this.value);

                // Update display
                selectedRatingSpan.textContent = value;

                // Get description
                const desc = ratingDescriptions[value];
                selectedRatingDesc.innerHTML = `
                    <i class="${desc.icon} ${desc.color}"></i> ${desc.text}
                `;

                // Show rating display
                ratingDisplay.style.display = 'block';
                ratingDisplay.style.animation = 'fadeIn 0.3s ease';
            });
        });

        // Set initial display if there's already a selected rating
        const selectedStar = document.querySelector('.rating-stars-input input[type="radio"]:checked');
        if (selectedStar) {
            selectedStar.dispatchEvent(new Event('change'));
        }

        // Character counter for komentar
        komentarTextarea?.addEventListener('input', function() {
            const charCount = this.value.length;
            const maxChars = 500;

            // Update counter
            document.getElementById('charCount').textContent = charCount;

            // Warn if approaching limit
            if (charCount > maxChars * 0.9) {
                this.style.borderColor = '#ffc107';
            } else {
                this.style.borderColor = '';
            }

            // Truncate if exceeds limit
            if (charCount > maxChars) {
                this.value = this.value.substring(0, maxChars);
                showToast('Komentar maksimal 500 karakter', 'warning');
            }
        });

        // Form validation
        const form = document.querySelector('form');
        const submitBtn = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', function(e) {
            // Validate required fields
            const pengaduanSelect = form.querySelector('#pengaduan_id');
            const rating = form.querySelector('input[name="rating"]:checked');

            if (!pengaduanSelect.value) {
                e.preventDefault();
                showToast('Harap pilih pengaduan terlebih dahulu', 'error');
                pengaduanSelect.focus();
                return;
            }

            if (!rating) {
                e.preventDefault();
                showToast('Harap pilih rating terlebih dahulu', 'error');
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

        // Form reset
        const resetBtn = form.querySelector('button[type="reset"]');
        if (resetBtn) {
            resetBtn.addEventListener('click', function() {
                ratingDisplay.style.display = 'none';
                showToast('Form telah direset', 'info');
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
