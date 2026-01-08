@extends('layouts.guest.app')

@section('title', 'Tambah User - Bina Desa')

@section('content')
<main class="main">
    <!-- Page Title -->
    <div class="page-title">
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
                    <li><a href="{{ route('user.index') }}">Data User</a></li>
                    <li class="current">Tambah User</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Tambah User Section -->
    <section id="tambah-user" class="tambah-user section">
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
                        <h2 class="tambah-title mb-1">Tambah User Baru</h2>
                        <div class="tambah-subtitle">
                            <span class="badge bg-success me-2">
                                <i class="bi bi-plus-lg me-1"></i>Mode Tambah
                            </span>
                            <span class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>Buat akun baru untuk sistem Bina Desa
                            </span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="action-buttons">
                            <a href="{{ route('user.index') }}"
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
                                    <strong>Informasi Penting:</strong> User yang dibuat akan langsung dapat login dengan email dan password yang Anda buat.
                                </div>
                            </div>
                        </div>

                        <!-- Form Tambah -->
                        <form action="{{ route('user.store') }}" method="POST"
                              class="php-email-form" enctype="multipart/form-data">
                            @csrf

                            <!-- Foto Profil -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-person-square me-2"></i>Foto Profil (Opsional)
                                </h5>
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center mb-3 mb-md-0">
                                        <div class="image-upload-container">
                                            <div class="image-preview" id="imagePreview">
                                                <div class="image-preview-default">
                                                    <i class="bi bi-person-circle"></i>
                                                    <p class="text-muted mt-2">Belum ada foto</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-item">
                                            <label for="profile_picture" class="form-label">
                                                <i class="bi bi-upload me-1"></i>Upload Foto
                                            </label>
                                            <div class="form-input-wrapper">
                                                <input type="file" name="profile_picture" id="profile_picture"
                                                       class="form-control"
                                                       accept="image/*" onchange="previewImage(event)">
                                                <div class="form-icon">
                                                    <i class="bi bi-upload"></i>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted">
                                                Format: JPEG, PNG, JPG, GIF. Maksimal 2MB. Ukuran rekomendasi: 400x400px
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Dasar -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-info-circle me-2"></i>Informasi Dasar
                                </h5>
                                <div class="form-grid">
                                    <!-- Nama Lengkap -->
                                    <div class="form-item">
                                        <label for="name" class="form-label">
                                            <i class="bi bi-person me-1"></i>Nama Lengkap *
                                        </label>
                                        <div class="form-input-wrapper">
                                            <input type="text" name="name" id="name" class="form-control"
                                                   value="{{ old('name') }}"
                                                   placeholder="Contoh: Budi Santoso, S.Kom" required>
                                            <div class="form-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="form-item">
                                        <label for="email" class="form-label">
                                            <i class="bi bi-envelope me-1"></i>Email *
                                        </label>
                                        <div class="form-input-wrapper">
                                            <input type="email" name="email" id="email" class="form-control"
                                                   value="{{ old('email') }}"
                                                   placeholder="Contoh: budi.santoso@email.com" required>
                                            <div class="form-icon">
                                                <i class="bi bi-envelope"></i>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            Email harus valid dan belum terdaftar
                                        </small>
                                    </div>

                                    <!-- Role -->
                                    <div class="form-item">
                                        <label for="role" class="form-label">
                                            <i class="bi bi-person-badge me-1"></i>Role *
                                        </label>
                                        <div class="form-input-wrapper">
                                            <select name="role" id="role" class="form-select" required>
                                                <option value="">Pilih Role</option>
                                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                                <option value="warga" {{ old('role') == 'warga' ? 'selected' : '' }}>Warga</option>
                                            </select>
                                            <div class="form-icon">
                                                <i class="bi bi-person-badge"></i>
                                            </div>
                                        </div>
                                        <div id="roleDescription" class="mt-2">
                                            <!-- Deskripsi role akan muncul di sini -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Keamanan Akun -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-shield-lock me-2"></i>Keamanan Akun
                                </h5>
                                <div class="form-grid">
                                    <!-- Password -->
                                    <div class="form-item">
                                        <label for="password" class="form-label">
                                            <i class="bi bi-key me-1"></i>Password *
                                        </label>
                                        <div class="form-input-wrapper">
                                            <input type="password" name="password" id="password" class="form-control"
                                                   placeholder="Buat password yang kuat" required>
                                            <div class="form-icon">
                                                <i class="bi bi-key"></i>
                                            </div>
                                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        <div class="d-flex justify-content-between mt-2">
                                            <small class="form-text text-muted">
                                                Minimal 8 karakter
                                            </small>
                                            <small class="form-text">
                                                <span id="passwordStrength">Kekuatan: -</span>
                                            </small>
                                        </div>
                                    </div>

                                    <!-- Konfirmasi Password -->
                                    <div class="form-item">
                                        <label for="password_confirmation" class="form-label">
                                            <i class="bi bi-key-fill me-1"></i>Konfirmasi Password *
                                        </label>
                                        <div class="form-input-wrapper">
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                   class="form-control" placeholder="Ulangi password" required>
                                            <div class="form-icon">
                                                <i class="bi bi-key-fill"></i>
                                            </div>
                                            <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        <small class="form-text text-muted">
                                            Password harus sama dengan di atas
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="form-section text-center mt-4">
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="bi bi-person-plus me-2"></i>Buat User
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary btn-lg ms-2">
                                        <i class="bi bi-arrow-clockwise me-2"></i>Reset Form
                                    </button>
                                </div>
                                <div class="form-info mt-3">
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Pastikan semua data yang dimasukkan sudah benar sebelum membuat user.
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Panduan Role -->
            <div class="tambah-card mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="form-section">
                            <h5 class="section-title mb-3">
                                <i class="bi bi-lightbulb me-2"></i>Panduan Pemilihan Role
                            </h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="guide-item">
                                        <div class="guide-icon">
                                            <i class="bi bi-shield-check text-danger"></i>
                                        </div>
                                        <h6>Admin</h6>
                                        <ul class="small text-muted mb-0 ps-3">
                                            <li>Akses penuh sistem</li>
                                            <li>Manajemen semua user</li>
                                            <li>Kelola pengaduan</li>
                                            <li>Laporan dan statistik</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="guide-item">
                                        <div class="guide-icon">
                                            <i class="bi bi-person-badge text-warning"></i>
                                        </div>
                                        <h6>Petugas</h6>
                                        <ul class="small text-muted mb-0 ps-3">
                                            <li>Menangani pengaduan</li>
                                            <li>Input tindak lanjut</li>
                                            <li>Akses terbatas</li>
                                            <li>Monitoring tugas</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="guide-item">
                                        <div class="guide-icon">
                                            <i class="bi bi-person text-success"></i>
                                        </div>
                                        <h6>Warga</h6>
                                        <ul class="small text-muted mb-0 ps-3">
                                            <li>Input pengaduan</li>
                                            <li>Melacak status</li>
                                            <li>Memberikan penilaian</li>
                                            <li>Akses publik</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- /Tambah User Section -->
</main>

<style>
    /* ===========================================
       STYLING TAMBAH USER - KONSISTEN
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

    /* Image Upload Container */
    .image-upload-container {
        text-align: center;
    }

    .image-preview {
        width: 180px;
        height: 180px;
        border: 3px solid #e9ecef;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        overflow: hidden;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
        position: relative;
    }

    .image-preview:hover {
        border-color: #175cdd;
        box-shadow: 0 4px 12px rgba(23, 92, 221, 0.1);
    }

    .image-preview-default {
        text-align: center;
        color: #6c757d;
    }

    .image-preview-default i {
        font-size: 4rem;
        display: block;
        margin-bottom: 0.5rem;
    }

    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .image-preview:hover img {
        transform: scale(1.05);
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

    /* Password Toggle Button */
    .password-toggle {
        position: absolute;
        right: 0.875rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6c757d;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 2;
        padding: 0;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .password-toggle:hover {
        color: #175cdd;
    }

    /* Form Text */
    .form-text {
        font-size: 0.825rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }

    /* Role Description */
    #roleDescription {
        font-size: 0.85rem;
        color: #6c757d;
        background: #f8f9fa;
        border-radius: 8px;
        padding: 0.75rem;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }

    #roleDescription strong {
        color: #2c3e50;
        display: block;
        margin-bottom: 0.25rem;
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

    /* Password Strength Indicator */
    .password-strength {
        display: inline-block;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 500;
        margin-left: 0.5rem;
    }

    .strength-weak { background: #dc3545; color: white; }
    .strength-medium { background: #fd7e14; color: white; }
    .strength-strong { background: #28a745; color: white; }
    .strength-very-strong { background: #17a2b8; color: white; }

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

        .image-preview {
            width: 150px;
            height: 150px;
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

        .image-preview {
            width: 120px;
            height: 120px;
        }

        .guide-item h6 {
            font-size: 0.95rem;
        }

        .guide-item li {
            font-size: 0.85rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image preview
        function previewImage(event) {
            const reader = new FileReader();
            const imagePreview = document.getElementById('imagePreview');
            const maxSize = 2 * 1024 * 1024; // 2MB

            const file = event.target.files[0];
            if (file && file.size > maxSize) {
                showToast('Ukuran file terlalu besar. Maksimal 2MB', 'error');
                event.target.value = '';
                return;
            }

            if (file && !file.type.startsWith('image/')) {
                showToast('Format file tidak didukung. Harus gambar', 'error');
                event.target.value = '';
                return;
            }

            reader.onload = function() {
                imagePreview.innerHTML = `<img src="${reader.result}" alt="Preview" class="img-fluid">`;
                showToast('Foto berhasil diupload', 'success');
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        // Password strength checker
        const passwordInput = document.getElementById('password');
        const passwordStrength = document.getElementById('passwordStrength');

        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                const strength = checkPasswordStrength(password);

                passwordStrength.textContent = `Kekuatan: ${strength.text}`;
                passwordStrength.className = 'password-strength strength-' + strength.class;
            });
        }

        function checkPasswordStrength(password) {
            let score = 0;

            // Length check
            if (password.length >= 8) score++;
            if (password.length >= 12) score++;

            // Character variety checks
            if (/[A-Z]/.test(password)) score++;
            if (/[a-z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;

            // Determine strength
            if (score < 3) return { text: 'Lemah', class: 'weak' };
            if (score < 5) return { text: 'Sedang', class: 'medium' };
            if (score < 6) return { text: 'Kuat', class: 'strong' };
            return { text: 'Sangat Kuat', class: 'very-strong' };
        }

        // Password toggle visibility
        window.togglePassword = function(fieldId) {
            const field = document.getElementById(fieldId);
            const toggle = field.nextElementSibling.querySelector('i');

            if (field.type === 'password') {
                field.type = 'text';
                toggle.classList.remove('bi-eye');
                toggle.classList.add('bi-eye-slash');
            } else {
                field.type = 'password';
                toggle.classList.remove('bi-eye-slash');
                toggle.classList.add('bi-eye');
            }
        }

        // Role description
        const roleSelect = document.getElementById('role');
        const roleDescription = document.getElementById('roleDescription');

        const roleDescriptions = {
            'admin': '<strong>Admin</strong><br>Memiliki akses penuh sistem, dapat mengelola semua data, user, dan laporan.',
            'petugas': '<strong>Petugas</strong><br>Bertanggung jawab menangani pengaduan, membuat tindak lanjut, dan memantau tugas.',
            'warga': '<strong>Warga</strong><br>Dapat membuat pengaduan, melacak status pengaduan, dan memberikan penilaian.'
        };

        if (roleSelect) {
            roleSelect.addEventListener('change', function() {
                const selectedRole = this.value;

                if (selectedRole && roleDescriptions[selectedRole]) {
                    roleDescription.innerHTML = roleDescriptions[selectedRole];
                    roleDescription.style.display = 'block';
                } else {
                    roleDescription.style.display = 'none';
                }
            });

            // Trigger change event on load if there's already a selected role
            if (roleSelect.value) {
                roleSelect.dispatchEvent(new Event('change'));
            }
        }

        // Form validation
        const form = document.querySelector('form');
        const submitBtn = form?.querySelector('button[type="submit"]');

        if (submitBtn) {
            form.addEventListener('submit', function(e) {
                // Validate required fields
                const nameInput = form.querySelector('#name');
                const emailInput = form.querySelector('#email');
                const roleSelect = form.querySelector('#role');
                const passwordInput = form.querySelector('#password');
                const passwordConfirm = form.querySelector('#password_confirmation');

                if (!nameInput.value.trim()) {
                    e.preventDefault();
                    showToast('Harap isi nama lengkap', 'error');
                    nameInput.focus();
                    return;
                }

                if (!emailInput.value.trim()) {
                    e.preventDefault();
                    showToast('Harap isi email', 'error');
                    emailInput.focus();
                    return;
                }

                // Simple email validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailInput.value)) {
                    e.preventDefault();
                    showToast('Format email tidak valid', 'error');
                    emailInput.focus();
                    return;
                }

                if (!roleSelect.value) {
                    e.preventDefault();
                    showToast('Harap pilih role', 'error');
                    roleSelect.focus();
                    return;
                }

                if (!passwordInput.value) {
                    e.preventDefault();
                    showToast('Harap isi password', 'error');
                    passwordInput.focus();
                    return;
                }

                if (passwordInput.value.length < 8) {
                    e.preventDefault();
                    showToast('Password minimal 8 karakter', 'error');
                    passwordInput.focus();
                    return;
                }

                if (passwordInput.value !== passwordConfirm.value) {
                    e.preventDefault();
                    showToast('Password dan konfirmasi password tidak sama', 'error');
                    passwordConfirm.focus();
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
                // Reset image preview
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.innerHTML = `
                    <div class="image-preview-default">
                        <i class="bi bi-person-circle"></i>
                        <p class="text-muted mt-2">Belum ada foto</p>
                    </div>
                `;

                // Reset role description
                if (roleDescription) {
                    roleDescription.style.display = 'none';
                }

                // Reset password strength
                if (passwordStrength) {
                    passwordStrength.textContent = 'Kekuatan: -';
                    passwordStrength.className = '';
                }

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
