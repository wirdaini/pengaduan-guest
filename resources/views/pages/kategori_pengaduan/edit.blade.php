@extends('layouts.guest.app')

@section('title', 'Edit Kategori Pengaduan - Bina Desa')

@section('content')
<main class="main">
    <!-- Page Title -->
    <div class="page-title">
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
                    <li><a href="{{ route('kategori_pengaduan.index') }}">Kategori Pengaduan</a></li>
                    <li class="current">Edit Kategori</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Edit Kategori Pengaduan Section -->
    <section id="edit-kategori_pengaduan" class="edit-kategori_pengaduan section">
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
                        <h2 class="edit-title mb-1">Edit Kategori Pengaduan</h2>
                        <div class="edit-subtitle">
                            <span class="badge bg-warning text-dark me-2">
                                <i class="bi bi-exclamation-triangle me-1"></i>Mode Edit
                            </span>
                            <span class="text-muted">
                                <i class="bi bi-tags me-1"></i>ID: {{ $kategori->kategori_id }}
                            </span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="action-buttons">
                            <a href="{{ route('kategori_pengaduan.show', $kategori->kategori_id) }}"
                               class="btn btn-outline-info btn-sm">
                                <i class="bi bi-eye me-1"></i>Detail
                            </a>
                            <a href="{{ route('kategori_pengaduan.index') }}"
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
                        <form action="{{ route('kategori_pengaduan.update', $kategori->kategori_id) }}" method="POST" class="php-email-form">
                            @csrf
                            @method('PUT')

                            <!-- Informasi Dasar -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-info-circle me-2"></i>Informasi Dasar
                                </h5>
                                <div class="form-grid">
                                    <!-- Nama Kategori -->
                                    <div class="form-item">
                                        <label for="nama" class="form-label">
                                            <i class="bi bi-card-text me-1"></i>Nama Kategori *
                                        </label>
                                        <div class="form-input-wrapper">
                                            <input type="text" name="nama" id="nama" class="form-control"
                                                   placeholder="Contoh: Infrastruktur Jalan"
                                                   value="{{ old('nama', $kategori->nama) }}" required>
                                            <div class="form-icon">
                                                <i class="bi bi-tag"></i>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            Nama kategori yang akan ditampilkan di form pengaduan
                                        </small>
                                    </div>

                                    <!-- SLA Hari -->
                                    <div class="form-item">
                                        <label for="sla_hari" class="form-label">
                                            <i class="bi bi-clock me-1"></i>SLA (Hari) *
                                        </label>
                                        <div class="form-input-wrapper">
                                            <input type="number" name="sla_hari" id="sla_hari" class="form-control"
                                                   placeholder="Contoh: 7"
                                                   value="{{ old('sla_hari', $kategori->sla_hari) }}"
                                                   min="1" max="30" required>
                                            <div class="form-icon">
                                                <i class="bi bi-calendar-check"></i>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            Service Level Agreement - Target penyelesaian dalam hari (1-30 hari)
                                        </small>
                                    </div>

                                    <!-- Prioritas -->
                                    <div class="form-item">
                                        <label for="prioritas" class="form-label">
                                            <i class="bi bi-exclamation-circle me-1"></i>Prioritas *
                                        </label>
                                        <div class="form-input-wrapper">
                                            <select name="prioritas" id="prioritas" class="form-select" required>
                                                <option value="">Pilih Prioritas</option>
                                                <option value="Rendah" {{ old('prioritas', $kategori->prioritas) == 'Rendah' ? 'selected' : '' }}>
                                                    Rendah
                                                </option>
                                                <option value="Sedang" {{ old('prioritas', $kategori->prioritas) == 'Sedang' ? 'selected' : '' }}>
                                                    Sedang
                                                </option>
                                                <option value="Tinggi" {{ old('prioritas', $kategori->prioritas) == 'Tinggi' ? 'selected' : '' }}>
                                                    Tinggi
                                                </option>
                                                <option value="Kritis" {{ old('prioritas', $kategori->prioritas) == 'Kritis' ? 'selected' : '' }}>
                                                    Kritis
                                                </option>
                                            </select>
                                            <div class="form-icon">
                                                <i class="bi bi-speedometer2"></i>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            Tingkat urgensi penanganan pengaduan
                                        </small>
                                    </div>

                                    <!-- Deskripsi -->
                                    <div class="form-item">
                                        <label for="deskripsi" class="form-label">
                                            <i class="bi bi-text-paragraph me-1"></i>Deskripsi
                                        </label>
                                        <div class="form-input-wrapper">
                                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"
                                                      placeholder="Tambahkan deskripsi kategori (opsional)">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                                            <div class="form-icon">
                                                <i class="bi bi-card-text"></i>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            Penjelasan tambahan tentang kategori (maksimal 255 karakter)
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="form-section text-center mt-4">
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-check-circle me-2"></i>Update Kategori
                                    </button>
                                    <a href="{{ route('kategori_pengaduan.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
                                        <i class="bi bi-x-circle me-2"></i>Batal
                                    </a>
                                </div>
                                <div class="form-info mt-3">
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Perubahan kategori akan mempengaruhi pengaduan yang menggunakan kategori ini.
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Edit Kategori Pengaduan Section -->
</main>

<style>
    /* ===========================================
       STYLING EDIT PAGE - KONSISTEN DENGAN LAINNYA
       =========================================== */

    /* Edit Header - Konsisten dengan detail */
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

    /* Form Text */
    .form-text {
        font-size: 0.825rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }

    /* Textarea khusus */
    textarea.form-control {
        min-height: 100px;
        resize: vertical;
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

        .edit-subtitle {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
    }
</style>
@endsection
