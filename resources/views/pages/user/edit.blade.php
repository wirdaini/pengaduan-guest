@extends('layouts.guest.app')

@section('title', 'Edit User - Bina Desa')

@section('content')
<main class="main">
    <!-- Page Title -->
    <div class="page-title">
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
                    <li><a href="{{ route('user.index') }}">Data User</a></li>
                    <li><a href="{{ route('user.show', $user->id) }}">Detail User</a></li>
                    <li class="current">Edit User</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Edit User Section -->
    <section id="edit-user" class="edit-user section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <!-- Header Section -->
            <div class="edit-header mb-4">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="edit-icon-circle">
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                     alt="{{ $user->name }}"
                                     class="edit-profile-img">
                            @else
                                <div class="edit-icon">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <h2 class="edit-title mb-1">Edit User</h2>
                        <div class="edit-subtitle">
                            <span class="badge bg-warning text-dark me-2">
                                <i class="bi bi-exclamation-triangle me-1"></i>Mode Edit
                            </span>
                            <span class="text-muted">
                                <i class="bi bi-envelope me-1"></i>{{ $user->email }}
                            </span>
                            <span class="badge role-{{ $user->role }} ms-2">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="action-buttons">
                            <a href="{{ route('user.show', $user->id) }}"
                               class="btn btn-outline-info btn-sm">
                                <i class="bi bi-eye me-1"></i>Detail
                            </a>
                            <a href="{{ route('user.index') }}"
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

                        <!-- Info Penting -->
                        <div class="form-info-section mb-4">
                            <div class="info-box bg-light-warning">
                                <i class="bi bi-info-circle text-warning"></i>
                                <div>
                                    <strong>Informasi Penting:</strong> Password hanya perlu diisi jika ingin mengubah password user.
                                </div>
                            </div>
                        </div>

                        <!-- Form Edit -->
                        <form action="{{ route('user.update', $user->id) }}" method="POST"
                              class="php-email-form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Foto Profil -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-person-square me-2"></i>Foto Profil
                                </h5>
                                <div class="row align-items-center">
                                    <div class="col-md-4 text-center mb-3 mb-md-0">
                                        <div class="current-photo-container">
                                            @if($user->profile_picture)
                                                <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                                     alt="Foto Profil Saat Ini"
                                                     class="current-photo-img"
                                                     onclick="openPhotoModal('{{ asset('storage/' . $user->profile_picture) }}')">
                                            @else
                                                <div class="no-photo-placeholder">
                                                    <i class="bi bi-person-circle"></i>
                                                    <p class="text-muted mt-2">Belum ada foto</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-item">
                                            <label for="profile_picture" class="form-label">
                                                <i class="bi bi-upload me-1"></i>Ubah Foto Profil
                                            </label>
                                            <div class="form-input-wrapper">
                                                <input type="file" name="profile_picture" id="profile_picture"
                                                       class="form-control"
                                                       accept="image/*" onchange="previewImage(event)">
                                                <div class="form-icon">
                                                    <i class="bi bi-upload"></i>
                                                </div>
                                            </div>
                                            <div class="form-text">
                                                <small class="text-muted">Kosongkan jika tidak ingin mengubah foto.</small><br>
                                                <small class="text-muted">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Image Preview -->
                                <div id="imagePreview" class="mt-3 text-center" style="display: none;">
                                    <div class="preview-title">
                                        <i class="bi bi-image me-1"></i>Preview Foto Baru
                                    </div>
                                    <div class="preview-container mt-2">
                                        <img id="previewImage" src="" alt="Preview" class="preview-img">
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
                                                   value="{{ old('name', $user->name) }}"
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
                                                   value="{{ old('email', $user->email) }}"
                                                   placeholder="Contoh: budi.santoso@email.com" required>
                                            <div class="form-icon">
                                                <i class="bi bi-envelope"></i>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            Email harus valid
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
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role }}"
                                                        {{ old('role', $user->role) == $role ? 'selected' : '' }}>
                                                        {{ ucfirst($role) }}
                                                    </option>
                                                @endforeach
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
                                    <i class="bi bi-shield-lock me-2"></i>Keamanan Akun (Opsional)
                                </h5>
                                <div class="form-grid">
                                    <!-- Password -->
                                    <div class="form-item">
                                        <label for="password" class="form-label">
                                            <i class="bi bi-key me-1"></i>Password Baru
                                        </label>
                                        <div class="form-input-wrapper">
                                            <input type="password" name="password" id="password" class="form-control"
                                                   placeholder="Kosongkan jika tidak ingin mengubah">
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
                                            <i class="bi bi-key-fill me-1"></i>Konfirmasi Password
                                        </label>
                                        <div class="form-input-wrapper">
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                   class="form-control" placeholder="Ulangi password baru">
                                            <div class="form-icon">
                                                <i class="bi bi-key-fill"></i>
                                            </div>
                                            <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        <small class="form-text text-muted">
                                            Wajib diisi jika mengubah password
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Riwayat Sistem -->
                            <div class="form-section mb-4">
                                <h5 class="section-title mb-3">
                                    <i class="bi bi-clock-history me-2"></i>Riwayat Sistem
                                </h5>
                                <div class="info-grid">
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="bi bi-calendar-plus me-1"></i>Dibuat
                                        </div>
                                        <div class="info-value">{{ $user->created_at->format('d M Y, H:i') }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="bi bi-calendar-check me-1"></i>Diperbarui
                                        </div>
                                        <div class="info-value">{{ $user->updated_at->format('d M Y, H:i') }}</div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">
                                            <i class="bi bi-envelope-check me-1"></i>Email Terverifikasi
                                        </div>
                                        <div class="info-value">
                                            @if ($user->email_verified_at)
                                                <span class="badge bg-success">Ya</span>
                                                ({{ $user->email_verified_at->format('d M Y') }})
                                            @else
                                                <span class="badge bg-warning">Belum</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="form-section text-center mt-4">
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-check-circle me-2"></i>Update User
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary btn-lg ms-2">
                                        <i class="bi bi-arrow-clockwise me-2"></i>Reset
                                    </button>
                                </div>
                                <div class="form-info mt-3">
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Pastikan semua data yang dimasukkan sudah benar sebelum menyimpan perubahan.
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Edit User Section -->

    <!-- Modal untuk Foto Profil -->
    <div class="modal fade" id="photoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto Profil - {{ $user->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalPhoto" src="" class="img-fluid rounded" alt="Foto Profil">
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    /* ===========================================
       STYLING EDIT USER - KONSISTEN
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
        width: 70px;
        height: 70px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid #fff3cd;
        background: #f8f9fa;
        position: relative;
        box-shadow: 0 2px 8px rgba(255, 193, 7, 0.2);
        transition: all 0.3s ease;
    }

    .edit-header:hover .edit-icon-circle {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
    }

    .edit-profile-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .edit-icon {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        color: white;
        font-size: 2rem;
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

    /* Badge Role (sama dengan index/show) */
    .badge.role-admin,
    .badge.role-petugas,
    .badge.role-warga {
        padding: 0.25rem 0.6rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.75rem;
        transition: all 0.3s ease;
    }

    .badge.role-admin {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        border: 1px solid #dc3545;
    }

    .badge.role-petugas {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        color: #212529;
        border: 1px solid #ffc107;
    }

    .badge.role-warga {
        background: linear-gradient(135deg, #28a745 0%, #218838 100%);
        color: white;
        border: 1px solid #28a745;
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

    /* Current Photo Container */
    .current-photo-container {
        text-align: center;
    }

    .current-photo-img {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #f0f5ff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .current-photo-img:hover {
        transform: scale(1.05);
        border-color: #175cdd;
        box-shadow: 0 6px 18px rgba(23, 92, 221, 0.2);
    }

    .no-photo-placeholder {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: #f8f9fa;
        border: 5px solid #e9ecef;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        transition: all 0.3s ease;
        margin: 0 auto;
    }

    .no-photo-placeholder i {
        font-size: 4rem;
        margin-bottom: 0.5rem;
    }

    .no-photo-placeholder:hover {
        border-color: #175cdd;
        box-shadow: 0 6px 18px rgba(23, 92, 221, 0.1);
    }

    /* Image Preview */
    .preview-title {
        font-size: 0.9rem;
        font-weight: 500;
        color: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .preview-container {
        display: inline-block;
    }

    .preview-img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #28a745;
        box-shadow: 0 3px 10px rgba(40, 167, 69, 0.2);
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
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

    /* Info Grid (untuk riwayat) */
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

    .info-label {
        flex: 0 0 140px;
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

    .info-item:hover .info-label i {
        transform: scale(1.2);
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
        .edit-header {
            padding: 1rem;
        }

        .edit-title {
            font-size: 1.25rem;
        }

        .edit-icon-circle {
            width: 60px;
            height: 60px;
        }

        .edit-icon {
            font-size: 1.8rem;
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

        .current-photo-img,
        .no-photo-placeholder {
            width: 150px;
            height: 150px;
        }

        .preview-img {
            width: 100px;
            height: 100px;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-primary,
        .btn-outline-secondary {
            width: 100%;
            justify-content: center;
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

        .col-lg-8 {
            padding: 0;
        }

        .current-photo-img,
        .no-photo-placeholder {
            width: 120px;
            height: 120px;
        }

        .no-photo-placeholder i {
            font-size: 3rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image preview for new photo
        function previewImage(event) {
            const reader = new FileReader();
            const preview = document.getElementById('imagePreview');
            const previewImage = document.getElementById('previewImage');
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
                previewImage.src = reader.result;
                preview.style.display = 'block';
                showToast('Foto baru akan diupload', 'info');
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        }

        // Open photo modal
        window.openPhotoModal = function(photoSrc) {
            const modal = new bootstrap.Modal(document.getElementById('photoModal'));
            document.getElementById('modalPhoto').src = photoSrc;
            modal.show();
        }

        // Password strength checker
        const passwordInput = document.getElementById('password');
        const passwordStrength = document.getElementById('passwordStrength');

        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;

                if (password.length === 0) {
                    passwordStrength.textContent = 'Kekuatan: -';
                    passwordStrength.className = '';
                    return;
                }

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

                // Validate password if filled
                if (passwordInput.value) {
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
                const preview = document.getElementById('imagePreview');
                preview.style.display = 'none';

                // Reset role description
                if (roleDescription) {
                    roleDescription.style.display = 'none';
                }

                // Reset password strength
                if (passwordStrength) {
                    passwordStrength.textContent = 'Kekuatan: -';
                    passwordStrength.className = '';
                }

                showToast('Perubahan telah direset', 'info');
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
