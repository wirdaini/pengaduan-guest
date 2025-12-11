@extends('layouts.guest.app')

@section('title', 'Data Tindak Lanjut - Bina Desa')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Data Tindak Lanjut</h1>
                            <p class="mb-0">
                                Kelola semua tindak lanjut dari pengaduan warga. Pantau perkembangan penanganan setiap laporan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="current">Data Tindak Lanjut</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Data Tindak Lanjut Section -->
        <section id="tindak-lanjut" class="tindak-lanjut section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2>Daftar Tindak Lanjut</h2>
                            <a href="{{ route('tindak_lanjut.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Tambah Tindak Lanjut Baru
                            </a>
                        </div>
                    </div>
                </div>

                <!-- START: Search & Filter Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="search-section">
                            <div class="card" style="background: transparent; border: none; box-shadow: none;">
                                <div class="card-body" style="padding: 0;">
                                    <h3 class="search-title">Cari & Filter Tindak Lanjut</h3>
                                    <p class="search-subtitle">Temukan dan kelola semua tindak lanjut dengan mudah</p>

                                    <form method="GET" action="{{ route('tindak_lanjut.index') }}" class="search-form">
                                        <div class="search-input-group">
                                            <!-- SEARCH INPUT -->
                                            <div class="input-wrapper">
                                                <i class="bi bi-search"></i>
                                                <input type="text" class="form-control" name="search"
                                                    value="{{ request('search') }}"
                                                    placeholder="Cari aksi, catatan, atau petugas...">
                                            </div>

                                            <!-- FILTER PETUGAS -->
                                            <div class="select-wrapper">
                                                <i class="bi bi-person"></i>
                                                <select class="form-select" name="petugas">
                                                    <option value="">Semua Petugas</option>
                                                    @php
                                                        $petugasList = App\Models\TindakLanjut::select('petugas')
                                                            ->distinct()
                                                            ->pluck('petugas');
                                                    @endphp
                                                    @foreach ($petugasList as $petugas)
                                                        <option value="{{ $petugas }}"
                                                            {{ request('petugas') == $petugas ? 'selected' : '' }}>
                                                            {{ $petugas }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- TOMBOL CARI -->
                                            <button type="submit" class="search-btn">
                                                <i class="bi bi-search"></i>
                                                Cari Tindak Lanjut
                                            </button>

                                            <!-- TOMBOL RESET -->
                                            <a href="{{ route('tindak_lanjut.index') }}"
                                                class="btn btn-outline-secondary reset-btn"
                                                style="background: transparent; color: var(--default-color); border: 1px solid color-mix(in srgb, var(--default-color), transparent 80%); border-radius: 50px; padding: 18px 24px; text-decoration: none; display: flex; align-items: center; gap: 8px; white-space: nowrap; transition: all 0.3s ease;">
                                                <i class="bi bi-arrow-clockwise"></i>
                                                Reset
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Search & Filter Section -->

                <!-- Search & Filter Results -->
                @if (request()->anyFilled(['search', 'petugas']))
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="alert alert-info alert-dismissible fade show" role="alert"
                                style="background: var(--surface-color); border: 1px solid color-mix(in srgb, var(--default-color), transparent 95%); border-radius: 16px; color: var(--default-color);">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-search me-2"></i>
                                    <div>
                                        <strong style="color: var(--heading-color);">Filter Aktif:</strong>
                                        @if (request('search'))
                                            <span class="badge"
                                                style="background: color-mix(in srgb, var(--accent-color), transparent 90%); color: var(--accent-color); padding: 6px 12px; border-radius: 12px; font-size: 0.875rem; font-weight: 500; margin-left: 8px;">
                                                Pencarian: "{{ request('search') }}"
                                            </span>
                                        @endif
                                        @if (request('petugas'))
                                            <span class="badge"
                                                style="background: color-mix(in srgb, var(--accent-color), transparent 90%); color: var(--accent-color); padding: 6px 12px; border-radius: 12px; font-size: 0.875rem; font-weight: 500; margin-left: 8px;">
                                                Petugas: {{ request('petugas') }}
                                            </span>
                                        @endif
                                        <span class="badge"
                                            style="background: var(--accent-color); color: var(--contrast-color); padding: 6px 12px; border-radius: 12px; font-size: 0.875rem; font-weight: 500; margin-left: 8px;">
                                            {{ $tindak_lanjut->total() }} data ditemukan
                                        </span>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- card --}}
                <div class="row gy-4">
                    @foreach ($tindak_lanjut as $item)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="tindak-card">
                                <div class="tindak-header">
                                    <!-- Avatar dengan inisial petugas -->
                                    <div class="tindak-avatar"
                                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        {{ strtoupper(substr($item->petugas, 0, 2)) }}
                                    </div>
                                    <div class="tindak-overlay">
                                        <div class="action-links">
                                            <a href="{{ route('tindak_lanjut.show', $item->tindak_id) }}" class="btn-info"
                                                title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('tindak_lanjut.edit', $item->tindak_id) }}" class="btn-edit"
                                                title="Edit Data">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('tindak_lanjut.destroy', $item->tindak_id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete" title="Hapus Data"
                                                    onclick="return confirm('Yakin ingin menghapus tindak lanjut ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tindak-content">
                                    <h4>{{ Str::limit($item->aksi, 40) }}</h4>
                                    <span class="petugas-info">{{ $item->petugas }}</span>

                                    <div class="tindak-info">
                                        <p><strong>Pengaduan:</strong> {{ Str::limit($item->pengaduan->judul, 30) }}</p>
                                        <p><strong>No Tiket:</strong> {{ $item->pengaduan->nomor_tiket }}</p>
                                        <p><strong>Catatan:</strong> {{ Str::limit($item->catatan, 80) }}</p>
                                    </div>

                                    <div class="tindak-meta">
                                        <div class="tanggal">
                                            <i class="bi bi-calendar"></i>
                                            <span>{{ $item->created_at->format('d M Y') }}</span>
                                        </div>
                                        <div class="status-pengaduan">
                                            @if ($item->pengaduan->status == 'menunggu')
                                                <span class="status-menunggu">Menunggu</span>
                                            @elseif($item->pengaduan->status == 'diproses')
                                                <span class="status-diproses">Diproses</span>
                                            @elseif($item->pengaduan->status == 'selesai')
                                                <span class="status-selesai">Selesai</span>
                                            @elseif($item->pengaduan->status == 'ditolak')
                                                <span class="status-ditolak">Ditolak</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="action-buttons">
                                        <a href="{{ route('tindak_lanjut.show', $item->tindak_id) }}"
                                            class="btn-info-full">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                        <a href="{{ route('tindak_lanjut.edit', $item->tindak_id) }}"
                                            class="btn-edit-full">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('tindak_lanjut.destroy', $item->tindak_id) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete-full"
                                                onclick="return confirm('Yakin ingin menghapus tindak lanjut ini?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Tindak Card -->
                    @endforeach
                </div>

                {{-- START: Pagination Links --}}
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $tindak_lanjut->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                {{-- END: Pagination Links --}}

                @if ($tindak_lanjut->isEmpty())
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="empty-state" data-aos="fade-up">
                                <i class="bi bi-inbox display-1 text-muted"></i>
                                <h3 class="mt-3">Belum Ada Tindak Lanjut</h3>
                                <p class="text-muted">Mulai dengan menambahkan tindak lanjut pertama.</p>
                                <a href="{{ route('tindak_lanjut.create') }}" class="btn btn-primary mt-3">
                                    <i class="bi bi-plus-circle"></i> Tambah Tindak Lanjut
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

        </section><!-- /Data Tindak Lanjut Section -->

    </main>

    <style>
        .tindak-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .tindak-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
        }

        .tindak-header {
            position: relative;
            height: 120px;
            overflow: hidden;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .tindak-avatar {
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

        .tindak-overlay {
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

        .tindak-card:hover .tindak-overlay {
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

        .tindak-content {
            padding: 20px;
        }

        .tindak-content h4 {
            color: #2c3e50;
            margin-bottom: 5px;
            font-weight: 600;
            line-height: 1.3;
        }

        .petugas-info {
            color: #6c757d;
            font-size: 0.8em;
            font-weight: 500;
        }

        .tindak-info {
            margin: 15px 0;
        }

        .tindak-info p {
            margin-bottom: 5px;
            font-size: 0.85em;
            color: #495057;
            line-height: 1.4;
        }

        .tindak-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 15px 0;
            padding: 10px 0;
            border-top: 1px solid #e9ecef;
            border-bottom: 1px solid #e9ecef;
        }

        .tanggal,
        .status-pengaduan {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.8em;
            font-weight: 500;
        }

        .tanggal {
            color: #6c757d;
        }

        .status-menunggu {
            color: #ffc107;
        }

        .status-diproses {
            color: #17a2b8;
        }

        .status-selesai {
            color: #28a745;
        }

        .status-ditolak {
            color: #dc3545;
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

        /* Search Section Styling (sama dengan pengaduan) */
        .search-section .search-title {
            font-size: 2rem;
            font-weight: 300;
            color: var(--heading-color);
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
            line-height: 1.2;
        }

        .search-section .search-subtitle {
            font-size: 1.125rem;
            color: color-mix(in srgb, var(--default-color), transparent 20%);
            margin-bottom: 2rem;
            line-height: 1.6;
            font-weight: 300;
        }

        .search-section .search-form .search-input-group {
            display: flex;
            align-items: stretch;
            background: var(--surface-color);
            border-radius: 60px;
            padding: 8px;
            box-shadow: 0 20px 60px color-mix(in srgb, var(--default-color), transparent 94%);
            transition: all 0.4s ease;
            gap: 8px;
        }

        .search-section .search-form .search-input-group:focus-within {
            box-shadow: 0 25px 80px color-mix(in srgb, var(--accent-color), transparent 90%);
        }

        .search-section .search-form .input-wrapper,
        .search-section .search-form .select-wrapper {
            position: relative;
            flex: 1;
            display: flex;
            align-items: center;
        }

        .search-section .search-form .input-wrapper i,
        .search-section .search-form .select-wrapper i {
            position: absolute;
            left: 20px;
            color: color-mix(in srgb, var(--default-color), transparent 40%);
            font-size: 1.1rem;
            z-index: 2;
        }

        .search-section .search-form .form-control,
        .search-section .search-form .form-select {
            border: none;
            background: transparent;
            padding: 20px 20px 20px 50px;
            font-size: 1rem;
            color: var(--default-color);
            border-radius: 0;
            width: 100%;
        }

        .search-section .search-form .form-control:focus,
        .search-section .search-form .form-select:focus {
            box-shadow: none;
            background: transparent;
        }

        .search-section .search-form .form-control::placeholder {
            color: color-mix(in srgb, var(--default-color), transparent 50%);
            font-weight: 300;
        }

        .search-section .search-form .search-btn {
            background: var(--accent-color);
            color: var(--contrast-color);
            border: none;
            border-radius: 50px;
            padding: 18px 32px;
            font-weight: 500;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .search-section .search-form .search-btn:hover {
            background: color-mix(in srgb, var(--accent-color), black 10%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px color-mix(in srgb, var(--accent-color), transparent 70%);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .search-section .search-form .search-input-group {
                flex-direction: column;
                gap: 1rem;
                padding: 1.5rem;
                border-radius: 24px;
            }

            .search-section .search-form .search-input-group .search-btn,
            .search-section .search-form .search-input-group .reset-btn {
                border-radius: 16px;
                justify-content: center;
            }
        }
    </style>
@endsection
