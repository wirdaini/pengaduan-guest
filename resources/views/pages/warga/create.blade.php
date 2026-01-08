@extends('layouts.guest.app')

@section('title', 'Tambah Warga - Bina Desa')

@section('content')
    <main class="main">
        <!-- Page Title -->
        <div class="page-title">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
                        <li><a href="{{ route('warga.index') }}">Data Warga</a></li>
                        <li class="current">Tambah Warga</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Tambah Warga Section -->
        <section id="tambah-warga" class="tambah-warga section">
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
                            <h2 class="tambah-title mb-1">Tambah Warga Baru</h2>
                            <div class="tambah-subtitle">
                                <span class="badge bg-success me-2">
                                    <i class="bi bi-plus-lg me-1"></i>Mode Tambah
                                </span>
                                <span class="text-muted">
                                    <i class="bi bi-info-circle me-1"></i>Lengkapi data warga untuk sistem Bina Desa
                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="action-buttons">
                                <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary btn-sm">
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
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert"
                                    style="border-radius: 12px; border: 1px solid #f8d7da;">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
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
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <!-- Info Penting -->
                            <div class="form-info-section mb-4">
                                <div class="info-box bg-light-primary">
                                    <i class="bi bi-info-circle text-primary"></i>
                                    <div>
                                        <strong>Informasi Penting:</strong> Data warga akan digunakan untuk pengajuan
                                        pengaduan dan verifikasi identitas.
                                    </div>
                                </div>
                            </div>

                            <!-- Form Tambah -->
                            @if (auth()->user()->role == 'warga' && !auth()->user()->warga)
                                <form action="{{ route('warga.store.user') }}" method="POST" class="php-email-form">
                                @else
                                    <form action="{{ route('warga.store') }}" method="POST" class="php-email-form">
                            @endif
                            @csrf

                            <!-- Informasi Pribadi -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-person-vcard me-2"></i>Informasi Pribadi
                                </h5>
                                <div class="form-grid">
                                    <!-- Nomor KTP -->
                                    <div class="form-item">
                                        <label for="no_ktp" class="form-label">
                                            <i class="bi bi-card-text me-1"></i>Nomor KTP *
                                        </label>
                                        <div class="form-input-wrapper">
                                            <input type="text" name="no_ktp" id="no_ktp" class="form-control"
                                                value="{{ old('no_ktp') }}" placeholder="Contoh: 3273010101010001"
                                                maxlength="16" required>
                                            <div class="form-icon">
                                                <i class="bi bi-card-text"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-2">
                                            <small class="form-text text-muted">
                                                16 digit angka
                                            </small>
                                            <small class="form-text">
                                                <span id="ktpCount">{{ strlen(old('no_ktp', '')) }}</span>/16
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Nama Lengkap -->
                                    <div class="form-item">
                                        <label for="nama" class="form-label">
                                            <i class="bi bi-person me-1"></i>Nama Lengkap *
                                        </label>
                                        <div class="form-input-wrapper">
                                            <input type="text" name="nama" id="nama" class="form-control"
                                                value="{{ old('nama') }}" placeholder="Contoh: Budi Santoso" required>
                                            <div class="form-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Jenis Kelamin -->
                                    <div class="form-item">
                                        <label for="jenis_kelamin" class="form-label">
                                            <i class="bi bi-gender-ambiguous me-1"></i>Jenis Kelamin *
                                        </label>
                                        <div class="form-input-wrapper">
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="L"
                                                    {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="P"
                                                    {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            <div class="form-icon">
                                                <i class="bi bi-gender-ambiguous"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Agama -->
                                    <div class="form-item">
                                        <label for="agama" class="form-label">
                                            <i class="bi bi-heart me-1"></i>Agama *
                                        </label>
                                        <div class="form-input-wrapper">
                                            <select name="agama" id="agama" class="form-select" required>
                                                <option value="">Pilih Agama</option>
                                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>
                                                    Islam</option>
                                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>
                                                    Kristen</option>
                                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>
                                                    Katolik</option>
                                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>
                                                    Hindu</option>
                                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>
                                                    Buddha</option>
                                                <option value="Konghucu"
                                                    {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                            </select>
                                            <div class="form-icon">
                                                <i class="bi bi-heart"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Kontak & Pekerjaan -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-telephone me-2"></i>Informasi Kontak & Pekerjaan
                                </h5>
                                <div class="form-grid">
                                    <!-- Pekerjaan -->
                                    <div class="form-item">
                                        <label for="pekerjaan" class="form-label">
                                            <i class="bi bi-briefcase me-1"></i>Pekerjaan *
                                        </label>
                                        <div class="form-input-wrapper">
                                            <input type="text" name="pekerjaan" id="pekerjaan" class="form-control"
                                                value="{{ old('pekerjaan') }}"
                                                placeholder="Contoh: Pegawai Swasta, Wiraswasta, PNS" required>
                                            <div class="form-icon">
                                                <i class="bi bi-briefcase"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Telepon -->
                                    <div class="form-item">
                                        <label for="telp" class="form-label">
                                            <i class="bi bi-telephone me-1"></i>Nomor Telepon *
                                        </label>
                                        <div class="form-input-wrapper">
                                            <input type="tel" name="telp" id="telp" class="form-control"
                                                value="{{ old('telp') }}" placeholder="Contoh: 081234567890" required>
                                            <div class="form-icon">
                                                <i class="bi bi-telephone"></i>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            Format: 08xx-xxxx-xxxx atau +62 xxx xxx xxx
                                        </small>
                                    </div>

                                    <!-- Email -->
                                    <div class="form-item">
                                        <label for="email" class="form-label">
                                            <i class="bi bi-envelope me-1"></i>Alamat Email *
                                        </label>
                                        <div class="form-input-wrapper">
                                            <input type="email" name="email" id="email" class="form-control"
                                                value="{{ old('email') }}" placeholder="Contoh: budi.santoso@email.com"
                                                required>
                                            <div class="form-icon">
                                                <i class="bi bi-envelope"></i>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            Email harus valid dan belum terdaftar
                                        </small>
                                    </div>

                                    <!-- Alamat -->
                                    <div class="form-item">
                                        <label for="alamat" class="form-label">
                                            <i class="bi bi-geo-alt me-1"></i>Alamat
                                        </label>
                                        <div class="form-input-wrapper">
                                            <textarea name="alamat" id="alamat" class="form-control" rows="3"
                                                placeholder="Contoh: Jl. Merdeka No. 123, Jakarta Pusat">{{ old('alamat') }}</textarea>
                                            <div class="form-icon">
                                                <i class="bi bi-geo-alt"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-2">
                                            <small class="form-text text-muted">
                                                Opsional
                                            </small>
                                            <small class="form-text">
                                                <span id="alamatCount">{{ strlen(old('alamat', '')) }}</span>/500
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="form-section text-center mt-4">
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="bi bi-save me-2"></i>Simpan Data Warga
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary btn-lg ms-2">
                                        <i class="bi bi-arrow-clockwise me-2"></i>Reset Form
                                    </button>
                                </div>
                                <div class="form-info mt-3">
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Pastikan semua data yang dimasukkan sudah benar sebelum menyimpan.
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
                                                <i class="bi bi-card-text text-primary"></i>
                                            </div>
                                            <h6>Nomor KTP</h6>
                                            <ul class="small text-muted mb-0 ps-3">
                                                <li>Harus 16 digit angka</li>
                                                <li>Data harus valid dan benar</li>
                                                <li>Untuk verifikasi identitas</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="guide-item">
                                            <div class="guide-icon">
                                                <i class="bi bi-person-check text-success"></i>
                                            </div>
                                            <h6>Data Pribadi</h6>
                                            <ul class="small text-muted mb-0 ps-3">
                                                <li>Nama sesuai KTP</li>
                                                <li>Jenis kelamin benar</li>
                                                <li>Agama dan pekerjaan lengkap</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="guide-item">
                                            <div class="guide-icon">
                                                <i class="bi bi-telephone text-warning"></i>
                                            </div>
                                            <h6>Kontak</h6>
                                            <ul class="small text-muted mb-0 ps-3">
                                                <li>Nomor telepon aktif</li>
                                                <li>Email valid dan dapat diakses</li>
                                                <li>Alamat lengkap (opsional)</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- /Tambah Warga Section -->
    </main>

    <style>
        /* ===========================================
               STYLING TAMBAH WARGA - KONSISTEN
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

        .form-control:focus+.form-icon,
        .form-select:focus+.form-icon {
            color: #175cdd;
            transform: translateY(-50%) scale(1.2);
        }

        /* Textarea */
        textarea.form-control {
            min-height: 100px;
            resize: vertical;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
        }

        /* Form Text */
        .form-text {
            font-size: 0.825rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }

        /* Guide Items */
        .guide-item {
            background: #fff;
            border-radius: 10px;
            padding: 1.5rem;
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
            height: 100%;
        }

        .guide-item:hover {
            border-color: #175cdd;
            box-shadow: 0 5px 15px rgba(23, 92, 221, 0.1);
            transform: translateY(-3px);
        }

        .guide-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .guide-item:hover .guide-icon {
            transform: scale(1.1);
        }

        .guide-item h6 {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 0.75rem;
            transition: color 0.3s ease;
        }

        .guide-item:hover h6 {
            color: #175cdd;
        }

        .guide-item ul {
            margin: 0;
            padding: 0;
        }

        .guide-item li {
            margin-bottom: 0.25rem;
            line-height: 1.4;
            font-size: 0.85rem;
        }

        .guide-item li:last-child {
            margin-bottom: 0;
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

            .form-grid {
                gap: 1rem;
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

            textarea.form-control {
                padding: 0.625rem 0.875rem 0.625rem 2.25rem;
                min-height: 80px;
            }

            .guide-item h6 {
                font-size: 0.95rem;
            }

            .guide-item li {
                font-size: 0.8rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // KTP character counter
            const ktpInput = document.getElementById('no_ktp');
            const ktpCount = document.getElementById('ktpCount');

            if (ktpInput) {
                ktpInput.addEventListener('input', function() {
                    // Only allow numbers
                    this.value = this.value.replace(/\D/g, '');

                    // Limit to 16 characters
                    if (this.value.length > 16) {
                        this.value = this.value.substring(0, 16);
                    }

                    // Update counter
                    ktpCount.textContent = this.value.length;

                    // Show validation message
                    if (this.value.length === 16) {
                        this.style.borderColor = '#28a745';
                    } else if (this.value.length >= 12) {
                        this.style.borderColor = '#ffc107';
                    } else {
                        this.style.borderColor = '';
                    }
                });

                // Trigger input event on load
                ktpInput.dispatchEvent(new Event('input'));
            }

            // Telepon validation
            const telpInput = document.getElementById('telp');
            if (telpInput) {
                telpInput.addEventListener('input', function() {
                    // Allow numbers, plus, hyphen, space
                    this.value = this.value.replace(/[^\d+\-\s]/g, '');

                    // Auto format
                    let value = this.value.replace(/\D/g, '');
                    if (value.startsWith('0')) {
                        if (value.length <= 4) {
                            this.value = value;
                        } else if (value.length <= 8) {
                            this.value = value.substring(0, 4) + '-' + value.substring(4);
                        } else {
                            this.value = value.substring(0, 4) + '-' + value.substring(4, 8) + '-' + value
                                .substring(8, 12);
                        }
                    } else if (value.startsWith('62')) {
                        if (value.length <= 3) {
                            this.value = '+' + value;
                        } else if (value.length <= 7) {
                            this.value = '+' + value.substring(0, 3) + ' ' + value.substring(3);
                        } else if (value.length <= 11) {
                            this.value = '+' + value.substring(0, 3) + ' ' + value.substring(3, 7) + ' ' +
                                value.substring(7);
                        } else {
                            this.value = '+' + value.substring(0, 3) + ' ' + value.substring(3, 7) + ' ' +
                                value.substring(7, 11) + ' ' + value.substring(11, 14);
                        }
                    }
                });
            }

            // Alamat character counter
            const alamatTextarea = document.getElementById('alamat');
            const alamatCount = document.getElementById('alamatCount');

            if (alamatTextarea) {
                alamatTextarea.addEventListener('input', function() {
                    const charCount = this.value.length;
                    const maxChars = 500;

                    // Update counter
                    alamatCount.textContent = charCount;

                    // Warn if approaching limit
                    if (charCount > maxChars * 0.9) {
                        this.style.borderColor = '#ffc107';
                    } else {
                        this.style.borderColor = '';
                    }

                    // Truncate if exceeds limit
                    if (charCount > maxChars) {
                        this.value = this.value.substring(0, maxChars);
                        showToast('Alamat maksimal 500 karakter', 'warning');
                    }
                });

                // Trigger input event on load
                alamatTextarea.dispatchEvent(new Event('input'));
            }

            // Form validation
            const form = document.querySelector('form');
            const submitBtn = form?.querySelector('button[type="submit"]');

            if (submitBtn) {
                form.addEventListener('submit', function(e) {
                    // Validate required fields
                    const ktpInput = form.querySelector('#no_ktp');
                    const namaInput = form.querySelector('#nama');
                    const jenisKelaminSelect = form.querySelector('#jenis_kelamin');
                    const agamaSelect = form.querySelector('#agama');
                    const pekerjaanInput = form.querySelector('#pekerjaan');
                    const telpInput = form.querySelector('#telp');
                    const emailInput = form.querySelector('#email');

                    // KTP validation
                    if (!ktpInput.value.trim()) {
                        e.preventDefault();
                        showToast('Harap isi nomor KTP', 'error');
                        ktpInput.focus();
                        return;
                    }

                    if (ktpInput.value.length !== 16) {
                        e.preventDefault();
                        showToast('Nomor KTP harus 16 digit', 'error');
                        ktpInput.focus();
                        return;
                    }

                    // Nama validation
                    if (!namaInput.value.trim()) {
                        e.preventDefault();
                        showToast('Harap isi nama lengkap', 'error');
                        namaInput.focus();
                        return;
                    }

                    // Jenis Kelamin validation
                    if (!jenisKelaminSelect.value) {
                        e.preventDefault();
                        showToast('Harap pilih jenis kelamin', 'error');
                        jenisKelaminSelect.focus();
                        return;
                    }

                    // Agama validation
                    if (!agamaSelect.value) {
                        e.preventDefault();
                        showToast('Harap pilih agama', 'error');
                        agamaSelect.focus();
                        return;
                    }

                    // Pekerjaan validation
                    if (!pekerjaanInput.value.trim()) {
                        e.preventDefault();
                        showToast('Harap isi pekerjaan', 'error');
                        pekerjaanInput.focus();
                        return;
                    }

                    // Telepon validation
                    if (!telpInput.value.trim()) {
                        e.preventDefault();
                        showToast('Harap isi nomor telepon', 'error');
                        telpInput.focus();
                        return;
                    }

                    // Simple phone validation
                    const phoneRegex = /^(\+62|62|0)8[1-9][0-9]{6,9}$/;
                    const cleanPhone = telpInput.value.replace(/\D/g, '');
                    if (!phoneRegex.test(cleanPhone)) {
                        e.preventDefault();
                        showToast('Format nomor telepon tidak valid', 'error');
                        telpInput.focus();
                        return;
                    }

                    // Email validation
                    if (!emailInput.value.trim()) {
                        e.preventDefault();
                        showToast('Harap isi alamat email', 'error');
                        emailInput.focus();
                        return;
                    }

                    // Email format validation
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(emailInput.value)) {
                        e.preventDefault();
                        showToast('Format email tidak valid', 'error');
                        emailInput.focus();
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
                    // Reset counters
                    if (ktpCount) ktpCount.textContent = '0';
                    if (alamatCount) alamatCount.textContent = '0';

                    showToast('Form telah direset', 'info');
                });
            }

            // Jenis kelamin select change
            const jenisKelaminSelect = document.getElementById('jenis_kelamin');
            if (jenisKelaminSelect) {
                jenisKelaminSelect.addEventListener('change', function() {
                    if (this.value === 'L') {
                        showToast('Jenis kelamin: Laki-laki', 'info');
                    } else if (this.value === 'P') {
                        showToast('Jenis kelamin: Perempuan', 'info');
                    }
                });
            }

            // Agama select change
            const agamaSelect = document.getElementById('agama');
            if (agamaSelect) {
                agamaSelect.addEventListener('change', function() {
                    if (this.value) {
                        showToast(`Agama: ${this.options[this.selectedIndex].text}`, 'info');
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
