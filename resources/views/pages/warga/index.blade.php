@extends('layouts.app')

@section('title', 'Data Warga - Bina Desa')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Data Warga</h1>
                            <p class="mb-0">
                                Daftar warga yang telah terdaftar dalam sistem. Kelola data warga dengan mudah.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="current">Data Warga</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Warga Section -->
        <section id="warga" class="warga section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Add Warga Button -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2>Daftar Warga</h2>
                            <a href="{{ route('warga.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Tambah Warga Baru
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Warga Grid -->
                <div class="row gy-4">

                    @foreach ($warga as $item)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="warga-card">
                                <div class="warga-header">
                                    <!-- Avatar dengan inisial nama -->
                                    <div class="warga-avatar"
                                        style="background: {{ $item->jenis_kelamin == 'L' ? '#3498db' : '#e84393' }};">
                                        {{ strtoupper(substr($item->nama, 0, 2)) }}
                                    </div>
                                    <div class="warga-overlay">
                                        <div class="action-links">
                                            <a href="{{ route('warga.show', $item->warga_id) }}" class="btn-info"
                                                title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn-edit"
                                                title="Edit Data">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete" title="Hapus Data"
                                                    onclick="return confirm('Yakin ingin menghapus warga ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="warga-content">
                                    <h4>{{ $item->nama }}</h4>
                                    <span class="warga-nik">NIK: {{ $item->no_ktp }}</span>

                                    <div class="warga-info">
                                        <p><strong>Jenis Kelamin:</strong>
                                            {{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                        <p><strong>Agama:</strong> {{ $item->agama }}</p>
                                        <p><strong>Pekerjaan:</strong> {{ $item->pekerjaan }}</p>
                                        <p><strong>Telepon:</strong> {{ $item->telp }}</p>
                                        <p><strong>Email:</strong> {{ $item->email }}</p>
                                    </div>

                                    <div class="warga-meta">
                                        <div class="status-badge">
                                            <i class="bi bi-person-check"></i>
                                            <span class="status-verified">Terverifikasi</span>
                                        </div>
                                        <div class="tanggal">
                                            <i class="bi bi-calendar"></i>
                                            <span>{{ $item->created_at->format('d M Y') }}</span>
                                        </div>
                                    </div>

                                    <div class="action-buttons">
                                        <a href="{{ route('warga.show', $item->warga_id) }}" class="btn-info-full">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                        <a href="{{ route('warga.edit', $item->warga_id) }}" class="btn-edit-full">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete-full"
                                                onclick="return confirm('Yakin ingin menghapus data warga ini?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Warga Card -->
                    @endforeach

                </div>

                @if ($warga->isEmpty())
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="empty-state" data-aos="fade-up">
                                <i class="bi bi-people display-1 text-muted"></i>
                                <h3 class="mt-3">Belum Ada Data Warga</h3>
                                <p class="text-muted">Mulai dengan menambahkan data warga pertama.</p>
                                <a href="{{ route('warga.create') }}" class="btn btn-primary mt-3">
                                    <i class="bi bi-plus-circle"></i> Tambah Warga Pertama
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

        </section><!-- /Warga Section -->

    </main>

    <style>
        .warga-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .warga-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
        }

        .warga-header {
            position: relative;
            height: 120px;
            overflow: hidden;
            background: linear-gradient(135deg, #175cdd 0%, #1a4bb8 100%);
        }

        .warga-avatar {
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

        .warga-overlay {
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

        .warga-card:hover .warga-overlay {
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

        .warga-content {
            padding: 20px;
        }

        .warga-content h4 {
            color: #2c3e50;
            margin-bottom: 5px;
            font-weight: 600;
            line-height: 1.3;
        }

        .warga-nik {
            color: #6c757d;
            font-size: 0.8em;
            font-weight: 500;
        }

        .warga-info {
            margin: 15px 0;
        }

        .warga-info p {
            margin-bottom: 5px;
            font-size: 0.85em;
            color: #495057;
            line-height: 1.4;
        }

        .warga-meta {
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

        .status-verified {
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
