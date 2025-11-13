@extends('layouts.guest.app')

@section('title', 'Detail User - Bina Desa')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Detail User</h1>
                            <p class="mb-0">Informasi lengkap tentang user sistem Bina Desa</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('user.index') }}">Data User</a></li>
                        <li class="current">Detail User</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Detail User Section -->
        <section id="detail-user" class="detail-user section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-lg-8">

                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h4 class="card-title mb-0">
                                    <i class="fas fa-user-circle me-2"></i>Informasi User
                                </h4>
                            </div>
                            <div class="card-body">
                                <!-- Action Buttons -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">
                                                <i class="fas fa-edit me-2"></i>Edit User
                                            </a>
                                            <a href="{{ route('user.index') }}" class="btn btn-secondary">
                                                <i class="fas fa-arrow-left me-2"></i>Kembali
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Informasi Utama -->
                                    <div class="col-12">
                                        <div class="info-section mb-4">
                                            <h5 class="section-title text-primary mb-3">
                                                <i class="fas fa-id-card me-2"></i>Informasi User
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="fw-bold">Nama Lengkap</label>
                                                        <p class="info-value">{{ $user->name }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="fw-bold">Email</label>
                                                        <p class="info-value">{{ $user->email }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="fw-bold">User ID</label>
                                                        <p class="info-value">#{{ $user->id }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="fw-bold">Status Email</label>
                                                        <p class="info-value">
                                                            @if ($user->email_verified_at)
                                                                <span class="badge bg-success">
                                                                    <i class="fas fa-check me-1"></i>Terverifikasi
                                                                </span>
                                                            @else
                                                                <span class="badge bg-warning text-dark">
                                                                    <i class="fas fa-clock me-1"></i>Belum Verifikasi
                                                                </span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Riwayat Sistem -->
                                    <div class="col-12">
                                        <div class="info-section">
                                            <h5 class="section-title text-primary mb-3">
                                                <i class="fas fa-history me-2"></i>Riwayat Sistem
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="fw-bold">Tanggal Registrasi</label>
                                                        <p class="info-value">{{ $user->created_at->format('d/m/Y H:i') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="info-item">
                                                        <label class="fw-bold">Terakhir Update</label>
                                                        <p class="info-value">{{ $user->updated_at->format('d/m/Y H:i') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($user->email_verified_at)
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="info-item">
                                                            <label class="fw-bold">Email Terverifikasi Pada</label>
                                                            <p class="info-value">
                                                                {{ $user->email_verified_at->format('d/m/Y H:i') }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section><!-- /Detail User Section -->

    </main>

    <style>
        .info-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            border-left: 4px solid #0d6efd;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .info-item {
            margin-bottom: 1rem;
        }

        .info-item:last-child {
            margin-bottom: 0;
        }

        .info-item label {
            display: block;
            margin-bottom: 0.25rem;
            color: #495057;
        }

        .info-value {
            margin: 0;
            padding: 0.5rem 0;
            color: #2c3e50;
            font-size: 1rem;
        }

        .badge {
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
        }
    </style>
@endsection
