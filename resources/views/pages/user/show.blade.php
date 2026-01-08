@extends('layouts.guest.app')

@section('title', 'Detail User - Bina Desa')

@section('content')
<main class="main">
    <!-- Page Title -->
    <div class="page-title">
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
                    <li><a href="{{ route('user.index') }}">Data User</a></li>
                    <li class="current">Detail User</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Detail User Section -->
    <section id="detail-user" class="detail-user section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <!-- Header Section -->
            <div class="detail-header mb-3">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="detail-icon-circle">
                            @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                     alt="{{ $user->name }}"
                                     class="detail-profile-img">
                            @else
                                <div class="detail-icon">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <h2 class="detail-title mb-1">{{ $user->name }}</h2>
                        <div class="detail-subtitle">
                            <span class="badge role-{{ $user->role }} me-2">
                                {{ ucfirst($user->role) }}
                            </span>
                            <span class="text-muted">
                                <i class="bi bi-envelope me-1"></i>{{ $user->email }}
                            </span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="action-buttons">
                            <a href="{{ route('user.edit', $user->id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil me-1"></i>Edit
                            </a>
                            <a href="{{ route('user.index') }}"
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
                    <!-- Kolom Kiri - Informasi User -->
                    <div class="col-lg-6">
                        <!-- Informasi Dasar -->
                        <div class="info-section mb-3">
                            <h5 class="section-title mb-2">
                                <i class="bi bi-info-circle me-2"></i>Informasi Dasar
                            </h5>
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-person me-1"></i>Nama Lengkap
                                    </div>
                                    <div class="info-value">{{ $user->name }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-envelope me-1"></i>Email
                                    </div>
                                    <div class="info-value">{{ $user->email }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-person-badge me-1"></i>Role
                                    </div>
                                    <div class="info-value">
                                        <span class="badge role-{{ $user->role }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-hash me-1"></i>User ID
                                    </div>
                                    <div class="info-value">#{{ $user->id }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Warga (jika role warga) -->
                        @if($user->role == 'warga' && $user->warga)
                        <div class="info-section mb-3">
                            <h5 class="section-title mb-2">
                                <i class="bi bi-person-vcard me-2"></i>Informasi Warga
                            </h5>
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-card-text me-1"></i>NIK
                                    </div>
                                    <div class="info-value">{{ $user->warga->no_ktp }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-telephone me-1"></i>Telepon
                                    </div>
                                    <div class="info-value">{{ $user->warga->telp }}</div>
                                </div>
                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="bi bi-gender-ambiguous me-1"></i>Jenis Kelamin
                                    </div>
                                    <div class="info-value">
                                        {{ $user->warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Kolom Kanan - Status & Foto -->
                    <div class="col-lg-6">
                        <!-- Status Verifikasi -->
                        <div class="info-section mb-3">
                            <h5 class="section-title mb-2">
                                <i class="bi bi-shield-check me-2"></i>Status Akun
                            </h5>
                            <div class="status-grid">
                                <div class="status-item">
                                    <div class="status-icon">
                                        <i class="bi bi-envelope-check"></i>
                                    </div>
                                    <div class="status-content">
                                        <div class="status-label">Email Verification</div>
                                        <div class="status-value">
                                            @if ($user->email_verified_at)
                                            <span class="badge bg-success">Terverifikasi</span>
                                            @else
                                            <span class="badge bg-warning">Belum Verifikasi</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="status-item">
                                    <div class="status-icon">
                                        <i class="bi bi-image"></i>
                                    </div>
                                    <div class="status-content">
                                        <div class="status-label">Foto Profil</div>
                                        <div class="status-value">
                                            @if($user->profile_picture)
                                            <span class="badge bg-success">Tersedia</span>
                                            @else
                                            <span class="badge bg-secondary">Tidak Ada</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Foto Profil Preview -->
                        <div class="info-section mb-3">
                            <h5 class="section-title mb-2">
                                <i class="bi bi-person-square me-2"></i>Foto Profil
                            </h5>
                            <div class="photo-preview text-center">
                                @if($user->profile_picture)
                                <div class="profile-photo-container">
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                         alt="Foto Profil {{ $user->name }}"
                                         class="profile-photo-preview">
                                    <div class="photo-info mt-2">
                                        <small class="text-muted">Klik untuk memperbesar</small>
                                    </div>
                                </div>
                                @else
                                <div class="no-photo-placeholder">
                                    <i class="bi bi-person-circle display-4 text-muted"></i>
                                    <p class="text-muted mt-2">Belum ada foto profil</p>
                                </div>
                                @endif
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
                            <i class="bi bi-person-plus timeline-icon-sm"></i>
                            <div class="timeline-content">
                                <span class="timeline-title">Registrasi</span>
                                <span class="timeline-date">{{ $user->created_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <i class="bi bi-arrow-repeat timeline-icon-sm"></i>
                            <div class="timeline-content">
                                <span class="timeline-title">Diperbarui</span>
                                <span class="timeline-date">{{ $user->updated_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>
                        @if ($user->email_verified_at)
                        <div class="timeline-item">
                            <i class="bi bi-check-circle timeline-icon-sm"></i>
                            <div class="timeline-content">
                                <span class="timeline-title">Email Terverifikasi</span>
                                <span class="timeline-date">{{ $user->email_verified_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Detail User Section -->

    <!-- Modal untuk Foto Profil -->
    <div class="modal fade" id="profilePhotoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto Profil - {{ $user->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalProfilePhoto" src="" class="img-fluid rounded" alt="Foto Profil">
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    /* ===========================================
       STYLING DETAIL USER - KONSISTEN
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
        width: 70px;
        height: 70px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid #f0f5ff;
        background: #f8f9fa;
        position: relative;
        box-shadow: 0 2px 8px rgba(23, 92, 221, 0.2);
        transition: all 0.3s ease;
    }

    .detail-header:hover .detail-icon-circle {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(23, 92, 221, 0.3);
    }

    .detail-profile-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .detail-icon {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #175cdd 0%, #0e3d8b 100%);
        color: white;
        font-size: 2rem;
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

    /* Badge Role (sama dengan index) */
    .badge.role-admin,
    .badge.role-petugas,
    .badge.role-warga {
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
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

    /* Status Grid */
    .status-grid {
        display: grid;
        gap: 1rem;
    }

    .status-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem;
        background: #fff;
        border-radius: 8px;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .status-item:hover {
        border-color: #175cdd;
        box-shadow: 0 2px 8px rgba(23, 92, 221, 0.1);
        transform: translateX(5px);
    }

    .status-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #f0f5ff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #175cdd;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }

    .status-item:hover .status-icon {
        background: #175cdd;
        color: white;
        transform: scale(1.1);
    }

    .status-content {
        flex: 1;
    }

    .status-label {
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 0.25rem;
    }

    .status-value {
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* Photo Preview */
    .photo-preview {
        padding: 1rem;
    }

    .profile-photo-container {
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .profile-photo-container:hover .profile-photo-preview {
        transform: scale(1.05);
    }

    .profile-photo-preview {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #f0f5ff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .no-photo-placeholder {
        padding: 2rem;
        background: #f8f9fa;
        border-radius: 12px;
        border: 2px dashed #dee2e6;
    }

    .photo-info {
        font-size: 0.8rem;
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .detail-header {
            padding: 1rem;
        }

        .detail-title {
            font-size: 1.25rem;
        }

        .detail-icon-circle {
            width: 60px;
            height: 60px;
        }

        .detail-icon {
            font-size: 1.8rem;
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

        .status-item {
            flex-direction: column;
            text-align: center;
        }

        .status-icon {
            margin-bottom: 0.5rem;
        }

        .profile-photo-preview {
            width: 150px;
            height: 150px;
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

        .profile-photo-preview {
            width: 120px;
            height: 120px;
        }

        .status-item {
            padding: 0.5rem;
        }

        .status-icon {
            width: 35px;
            height: 35px;
            font-size: 1rem;
        }
    }
</style>

<script>
    // Modal untuk foto profil
    document.addEventListener('DOMContentLoaded', function() {
        const profilePhoto = document.querySelector('.profile-photo-preview');
        if (profilePhoto) {
            profilePhoto.addEventListener('click', function() {
                const modal = new bootstrap.Modal(document.getElementById('profilePhotoModal'));
                document.getElementById('modalProfilePhoto').src = this.src;
                modal.show();
            });
        }
    });
</script>
@endsection
