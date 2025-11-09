@extends('layouts.app')

@section('title', 'Data Users - Bina Desa')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Data Users</h1>
                            <p class="mb-0">Kelola semua user yang memiliki akses ke sistem Bina Desa</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="current">Data Users</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Users Section -->
        <section id="users" class="users section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Add User Button -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2>Daftar Users</h2>
                            <a href="{{ route('user.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Tambah User Baru
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Users Grid -->
                <div class="row gy-4">

                    @foreach ($users as $user)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="user-card">
                                <div class="user-header">
                                    <!-- Avatar dengan inisial nama -->
                                    <div class="user-avatar bg-primary">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <div class="user-overlay">
                                        <div class="action-links">
                                            <a href="{{ route('user.show', $user->id) }}" class="btn-info"
                                                title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn-edit"
                                                title="Edit Data">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete" title="Hapus Data"
                                                    onclick="return confirm('Yakin ingin menghapus user ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-content">
                                    <h4>{{ $user->name }}</h4>
                                    <span class="user-role">{{ ucfirst($user->role) }}</span>

                                    <div class="user-info">
                                        <p><strong>Email:</strong> {{ $user->email }}</p>
                                        <p><strong>Status:</strong>
                                            @if ($user->email_verified_at)
                                                <span class="text-success">Terverifikasi</span>
                                            @else
                                                <span class="text-warning">Belum Verifikasi</span>
                                            @endif
                                        </p>
                                    </div>

                                    <div class="user-meta">
                                        <div class="status-badge">
                                            <i class="bi bi-person-check"></i>
                                            <span class="status-{{ $user->role }}">{{ ucfirst($user->role) }}</span>
                                        </div>
                                        <div class="tanggal">
                                            <i class="bi bi-calendar"></i>
                                            <span>{{ $user->created_at->format('d M Y') }}</span>
                                        </div>
                                    </div>

                                    <div class="action-buttons">
                                        <a href="{{ route('user.show', $user->id) }}" class="btn-info-full">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn-edit-full">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete-full"
                                                onclick="return confirm('Yakin ingin menghapus user ini?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End User Card -->
                    @endforeach

                </div>

                @if ($users->isEmpty())
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="empty-state" data-aos="fade-up">
                                <i class="bi bi-people display-1 text-muted"></i>
                                <h3 class="mt-3">Belum Ada User</h3>
                                <p class="text-muted">Mulai dengan menambahkan user pertama.</p>
                                <a href="{{ route('user.create') }}" class="btn btn-primary mt-3">
                                    <i class="bi bi-plus-circle"></i> Tambah User Pertama
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

        </section><!-- /Users Section -->

    </main>

    <style>
        .user-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
        }

        .user-header {
            position: relative;
            height: 120px;
            overflow: hidden;
            background: linear-gradient(135deg, #175cdd 0%, #1a4bb8 100%);
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: bold;
            color: white;
            position: absolute;
            top: 20px;
            left: 20px;
            border: 3px solid white;
        }

        .user-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .user-card:hover .user-overlay {
            opacity: 1;
        }

        .action-links {
            display: flex;
            gap: 10px;
        }

        .btn-info,
        .btn-edit,
        .btn-delete {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .btn-info {
            background: #17a2b8;
        }

        .btn-edit {
            background: #ffc107;
        }

        .btn-delete {
            background: #dc3545;
            border: none;
        }

        .btn-info:hover,
        .btn-edit:hover,
        .btn-delete:hover {
            transform: scale(1.1);
            color: white;
        }

        .user-content {
            padding: 20px;
        }

        .user-content h4 {
            color: #2c3e50;
            margin-bottom: 5px;
            font-weight: 600;
            line-height: 1.3;
        }

        .user-role {
            color: #6c757d;
            font-size: 0.8em;
            font-weight: 500;
        }

        .user-info {
            margin: 15px 0;
        }

        .user-info p {
            margin-bottom: 5px;
            font-size: 0.85em;
            color: #495057;
            line-height: 1.4;
        }

        .user-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0;
            padding: 10px 0;
            border-top: 1px solid #e9ecef;
            border-bottom: 1px solid #e9ecef;
        }

        .status-badge,
        .tanggal {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.8em;
            font-weight: 500;
        }

        .status-admin {
            color: #dc3545;
        }

        .status-petugas {
            color: #fd7e14;
        }

        .status-warga {
            color: #28a745;
        }

        .tanggal {
            color: #6c757d;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-info-full,
        .btn-edit-full,
        .btn-delete-full {
            flex: 1;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            font-size: 0.8em;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-info-full {
            background: #17a2b8;
            color: white;
        }

        .btn-edit-full {
            background: #ffc107;
            color: #212529;
        }

        .btn-delete-full {
            background: #dc3545;
            color: white;
        }

        .btn-info-full:hover,
        .btn-edit-full:hover,
        .btn-delete-full:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .empty-state {
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 4rem;
        }
    </style>
@endsection
