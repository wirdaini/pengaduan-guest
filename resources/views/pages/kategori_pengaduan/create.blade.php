@extends('layouts.guest.app')

@section('title', 'Tambah Kategori Pengaduan - Bina Desa')

@section('content')
<main class="main">
    <!-- Page Title -->
    <div class="page-title">
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
                    <li><a href="{{ route('kategori_pengaduan.index') }}">Kategori Pengaduan</a></li>
                    <li class="current">Tambah Kategori</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Tambah Kategori Pengaduan Section -->
    <section id="tambah-kategori_pengaduan" class="tambah-kategori_pengaduan section">
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
                        <h2 class="tambah-title mb-1">Tambah Kategori Baru</h2>
                        <div class="tambah-subtitle">
                            <span class="badge bg-success me-2">
                                <i class="bi bi-plus-lg me-1"></i>Mode Tambah
                            </span>
                            <span class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>Tambahkan kategori untuk klasifikasi pengaduan
                            </span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="action-buttons">
                            <a href="{{ route('kategori_pengaduan.index') }}"
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
                        <form action="{{ route('kategori_pengaduan.store') }}" method="POST" class="php-email-form">
                            @csrf

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
                                                   value="{{ old('nama') }}" required>
                                            <div class="form-icon">
                                                <i class="bi bi-tag"></i>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            Nama kategori yang akan ditampilkan di form pengaduan (maksimal 100 karakter)
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
                                                   value="{{ old('sla_hari') }}"
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
                                                <option value="Rendah" {{ old('prioritas') == 'Rendah' ? 'selected' : '' }}>
                                                    Rendah
                                                </option>
                                                <option value="Sedang" {{ old('prioritas') == 'Sedang' ? 'selected' : '' }}>
                                                    Sedang
                                                </option>
                                                <option value="Tinggi" {{ old('prioritas') == 'Tinggi' ? 'selected' : '' }}>
                                                    Tinggi
                                                </option>
                                                <option value="Kritis" {{ old('prioritas') == 'Kritis' ? 'selected' : '' }}>
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
                                            <i class="bi bi-text-paragraph me-1"></i>Deskripsi (Opsional)
                                        </label>
                                        <div class="form-input-wrapper">
                                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"
                                                      placeholder="Tambahkan deskripsi kategori (opsional)">{{ old('deskripsi') }}</textarea>
                                            <div class="form-icon">
                                                <i class="bi bi-card-text"></i>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            Penjelasan tambahan tentang kategori (maksimal 500 karakter)
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="form-section text-center mt-4">
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="bi bi-plus-circle me-2"></i>Tambah Kategori
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary btn-lg ms-2">
                                        <i class="bi bi-arrow-clockwise me-2"></i>Reset Form
                                    </button>
                                </div>
                                <div class="form-info mt-3">
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Kategori yang ditambahkan akan langsung tersedia di form pengaduan.
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Contoh Kategori -->
            <div class="tambah-card mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="form-section">
                            <h5 class="section-title mb-3">
                                <i class="bi bi-lightbulb me-2"></i>Contoh Kategori yang Umum
                            </h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="example-item">
                                        <div class="example-header">
                                            <h6>Infrastruktur Jalan</h6>
                                            <span class="badge prioritas-sedang">Sedang</span>
                                        </div>
                                        <div class="example-body">
                                            <p><i class="bi bi-clock me-1"></i> SLA: 7 hari</p>
                                            <p class="text-muted small">Lubang jalan, kerusakan aspal, drainase tersumbat</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="example-item">
                                        <div class="example-header">
                                            <h6>Kebersihan Lingkungan</h6>
                                            <span class="badge prioritas-tinggi">Tinggi</span>
                                        </div>
                                        <div class="example-body">
                                            <p><i class="bi bi-clock me-1"></i> SLA: 3 hari</p>
                                            <p class="text-muted small">Sampah menumpuk, saluran air kotor, bau tidak sedap</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="example-item">
                                        <div class="example-header">
                                            <h6>Penerangan Jalan</h6>
                                            <span class="badge prioritas-rendah">Rendah</span>
                                        </div>
                                        <div class="example-body">
                                            <p><i class="bi bi-clock me-1"></i> SLA: 14 hari</p>
                                            <p class="text-muted small">Lampu jalan mati, penerangan kurang, kabel putus</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- /Tambah Kategori Pengaduan Section -->
</main>

<style>
    /* ===========================================
       STYLING TAMBAH PAGE - KONSISTEN DENGAN LAINNYA
       =========================================== */

    /* Tambah Header - Konsisten dengan edit */
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

    /* Example Item */
    .example-item {
        background: #fff;
        border-radius: 10px;
        padding: 1rem;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
        height: 100%;
    }

    .example-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border-color: #175cdd;
    }

    .example-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #f0f0f0;
    }

    .example-header h6 {
        margin: 0;
        color: #2c3e50;
        font-weight: 600;
        font-size: 0.95rem;
        transition: color 0.3s ease;
    }

    .example-item:hover .example-header h6 {
        color: #175cdd;
    }

    .example-body p {
        margin-bottom: 0.25rem;
        font-size: 0.85rem;
        color: #495057;
    }

    .example-body i {
        color: #175cdd;
        font-size: 0.9rem;
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

    /* Badge Prioritas - Sama dengan index */
    .badge.prioritas-rendah,
    .badge.prioritas-sedang,
    .badge.prioritas-tinggi,
    .badge.prioritas-kritis {
        padding: 0.25rem 0.5rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.7rem;
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

        .example-item {
            margin-bottom: 1rem;
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
    }
</style>

<script>
    // Simple validation
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const namaInput = document.querySelector('input[name="nama"]');
        const slaInput = document.querySelector('input[name="sla_hari"]');
        const prioritasSelect = document.querySelector('select[name="prioritas"]');
        const deskripsiTextarea = document.querySelector('textarea[name="deskripsi"]');
        const submitBtn = form.querySelector('button[type="submit"]');

        // Limit nama length
        namaInput.addEventListener('input', function() {
            if (this.value.length > 100) {
                this.value = this.value.substring(0, 100);
                showToast('Nama kategori maksimal 100 karakter', 'warning');
            }
        });

        // Validate SLA range
        slaInput.addEventListener('change', function() {
            const value = parseInt(this.value);
            if (value < 1) this.value = 1;
            if (value > 30) this.value = 30;
        });

        // Limit deskripsi length
        if (deskripsiTextarea) {
            deskripsiTextarea.addEventListener('input', function() {
                if (this.value.length > 500) {
                    this.value = this.value.substring(0, 500);
                    showToast('Deskripsi maksimal 500 karakter', 'warning');
                }
            });
        }

        // Form submission
        form.addEventListener('submit', function(e) {
            if (!namaInput.value.trim() || !slaInput.value || !prioritasSelect.value) {
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
    });
</script>
@endsection
