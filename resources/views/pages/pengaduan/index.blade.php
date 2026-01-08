@extends('layouts.guest.app')

@section('title', 'Data Pengaduan - Bina Desa')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
                        <li class="current">Data Pengaduan</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Data Pengaduan Section -->
        <section id="pengaduan" class="pengaduan section">

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
                            <h2>Daftar Pengaduan</h2>
                            <a href="{{ route('pengaduan.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Ajukan Pengaduan Baru
                            </a>
                        </div>
                        <!-- ========== TOTAL PENGADUAN DI SINI ========== -->
                        <div class="mt-2">
                            <p class="text-muted mb-0">
                                <i class="bi bi-inbox me-1"></i>
                                Total: <strong>{{ $pengaduan->total() }}</strong> pengaduan
                            </p>
                        </div>
                    </div>
                </div>

                <!-- START: Search & Filter Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="search-section">
                            <div class="card" style="background: transparent; border: none; box-shadow: none;">
                                <div class="card-body" style="padding: 0;">
                                    <form method="GET" action="{{ route('pengaduan.index') }}" class="search-form">
                                        <div class="search-input-group">
                                            <!-- SEARCH INPUT -->
                                            <div class="input-wrapper">
                                                <i class="bi bi-search"></i>
                                                <input type="text" class="form-control" name="search"
                                                    value="{{ request('search') }}"
                                                    placeholder="Cari judul, deskripsi, atau nomor tiket...">
                                            </div>

                                            <!-- FILTER STATUS -->
                                            <div class="select-wrapper">
                                                <i class="bi bi-clock"></i>
                                                <select class="form-select" name="status">
                                                    <option value="">Semua Status</option>
                                                    <option value="menunggu"
                                                        {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu
                                                    </option>
                                                    <option value="diproses"
                                                        {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses
                                                    </option>
                                                    <option value="selesai"
                                                        {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai
                                                    </option>
                                                    <option value="ditolak"
                                                        {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak
                                                    </option>
                                                </select>
                                            </div>

                                            <!-- FILTER KATEGORI -->
                                            <div class="select-wrapper">
                                                <i class="bi bi-tags"></i>
                                                <select class="form-select" name="kategori_id">
                                                    <option value="">Semua Kategori</option>
                                                    @foreach ($kategories as $kategori)
                                                        <option value="{{ $kategori->kategori_id }}"
                                                            {{ request('kategori_id') == $kategori->kategori_id ? 'selected' : '' }}>
                                                            {{ $kategori->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- FILTER RT -->
                                            <div class="select-wrapper">
                                                <i class="bi bi-house"></i>
                                                <select class="form-select" name="rt">
                                                    <option value="">Semua RT</option>
                                                    @for ($i = 1; $i <= 20; $i++)
                                                        @php
                                                            // Format menjadi 3 digit: 001, 002, etc
                                                            $rtFormatted = str_pad($i, 3, '0', STR_PAD_LEFT);
                                                        @endphp
                                                        <option value="{{ $rtFormatted }}"
                                                            {{ request('rt') == $rtFormatted ? 'selected' : '' }}>
                                                            RT {{ $rtFormatted }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <!-- FILTER RW -->
                                            <div class="select-wrapper">
                                                <i class="bi bi-building"></i>
                                                <select class="form-select" name="rw">
                                                    <option value="">Semua RW</option>
                                                    @for ($i = 1; $i <= 10; $i++)
                                                        @php
                                                            // Format menjadi 3 digit: 001, 002, etc
                                                            $rwFormatted = str_pad($i, 3, '0', STR_PAD_LEFT);
                                                        @endphp
                                                        <option value="{{ $rwFormatted }}"
                                                            {{ request('rw') == $rwFormatted ? 'selected' : '' }}>
                                                            RW {{ $rwFormatted }}
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            <!-- TOMBOL CARI -->
                                            <button type="submit" class="search-btn">
                                                <i class="bi bi-search"></i>
                                                Cari Pengaduan
                                            </button>

                                            <!-- TOMBOL RESET -->
                                            <a href="{{ route('pengaduan.index') }}"
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
                @if (request()->anyFilled(['search', 'status', 'kategori_id', 'rt', 'rw']))
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
                                        @if (request('status'))
                                            @php
                                                $statusLabels = [
                                                    'pending' => 'Menunggu',
                                                    'diproses' => 'Diproses',
                                                    'selesai' => 'Selesai',
                                                    'ditolak' => 'Ditolak',
                                                ];
                                            @endphp
                                            <span class="badge"
                                                style="background: color-mix(in srgb, var(--accent-color), transparent 90%); color: var(--accent-color); padding: 6px 12px; border-radius: 12px; font-size: 0.875rem; font-weight: 500; margin-left: 8px;">
                                                Status: {{ $statusLabels[request('status')] ?? request('status') }}
                                            </span>
                                        @endif
                                        @if (request('kategori_id'))
                                            @php
                                                $kategoriName =
                                                    $kategories->where('kategori_id', request('kategori_id'))->first()
                                                        ->nama ?? 'Kategori';
                                            @endphp
                                            <span class="badge"
                                                style="background: color-mix(in srgb, var(--accent-color), transparent 90%); color: var(--accent-color); padding: 6px 12px; border-radius: 12px; font-size: 0.875rem; font-weight: 500; margin-left: 8px;">
                                                Kategori: {{ $kategoriName }}
                                            </span>
                                        @endif
                                        @if (request('rt'))
                                            <span class="badge"
                                                style="background: color-mix(in srgb, var(--accent-color), transparent 90%); color: var(--accent-color); padding: 6px 12px; border-radius: 12px; font-size: 0.875rem; font-weight: 500; margin-left: 8px;">
                                                RT: {{ request('rt') }}
                                            </span>
                                        @endif
                                        @if (request('rw'))
                                            <span class="badge"
                                                style="background: color-mix(in srgb, var(--accent-color), transparent 90%); color: var(--accent-color); padding: 6px 12px; border-radius: 12px; font-size: 0.875rem; font-weight: 500; margin-left: 8px;">
                                                RW: {{ request('rw') }}
                                            </span>
                                        @endif
                                        <span class="badge"
                                            style="background: var(--accent-color); color: var(--contrast-color); padding: 6px 12px; border-radius: 12px; font-size: 0.875rem; font-weight: 500; margin-left: 8px;">
                                            {{ $pengaduan->total() }} data ditemukan
                                        </span>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- PENGADUAN GRID - 4 PER BARIS -->
                <div class="row gy-4">
                    @foreach ($pengaduan as $item)
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="user-card">
                                <!-- Bagian Avatar Bulat -->
                                <div class="user-picture-area">
                                    <div class="user-picture-circle">
                                        <div class="pengadu-icon">
                                            <i class="bi bi-inbox"></i>
                                        </div>
                                    </div>

                                    <!-- Overlay untuk Action Buttons -->
                                    <div class="user-overlay-circle">
                                        <div class="user-action-links">
                                            <a href="{{ route('pengaduan.show', $item->pengaduan_id) }}"
                                                class="user-action-btn user-view-btn">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('pengaduan.edit', $item->pengaduan_id) }}"
                                                class="user-action-btn user-edit-btn">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('pengaduan.destroy', $item->pengaduan_id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="user-action-btn user-delete-btn"
                                                    onclick="return confirm('Yakin ingin menghapus pengaduan ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Pengaduan -->
                                <div class="user-content">
                                    <h4 class="user-name">{{ Str::limit($item->judul, 40) }}</h4>
                                    <span class="user-role-badge status-{{ $item->status }}">
                                        @if ($item->status == 'menunggu')
                                            <i class="bi bi-clock me-1"></i>Menunggu
                                        @elseif($item->status == 'diproses')
                                            <i class="bi bi-gear me-1"></i>Diproses
                                        @elseif($item->status == 'selesai')
                                            <i class="bi bi-check-circle me-1"></i>Selesai
                                        @elseif($item->status == 'ditolak')
                                            <i class="bi bi-x-circle me-1"></i>Ditolak
                                        @endif
                                    </span>

                                    <!-- Nomor Tiket -->
                                    <div class="user-info-item">
                                        <i class="bi bi-ticket"></i>
                                        <span class="user-info-text">
                                            {{ $item->nomor_tiket }}
                                        </span>
                                    </div>

                                    <!-- Pengadu -->
                                    <div class="user-info-item">
                                        <i class="bi bi-person"></i>
                                        <span class="user-info-text">
                                            {{ $item->warga->nama }}
                                        </span>
                                    </div>

                                    <!-- Kategori -->
                                    <div class="user-info-item">
                                        <i class="bi bi-tags"></i>
                                        <span class="user-info-text">
                                            @if ($item->kategori && $item->kategori->nama)
                                                {{ $item->kategori->nama }}
                                            @else
                                                <span class="text-warning">Belum ada kategori</span>
                                            @endif
                                        </span>
                                    </div>

                                    <!-- Tanggal Dibuat -->
                                    <div class="user-info-item">
                                        <i class="bi bi-calendar-event"></i>
                                        <span class="user-info-text">
                                            {{ $item->created_at->format('d M Y') }}
                                        </span>
                                    </div>

                                    <!-- File Attachment - MIRIP TINDAK LANJUT -->
                                    @php
                                        $fileCount = \App\Models\Media::where('ref_table', 'pengaduan')
                                            ->where('ref_id', $item->pengaduan_id)
                                            ->count();
                                        $hasFiles = $fileCount > 0;
                                    @endphp
                                    <div class="file-info-compact {{ !$hasFiles ? 'no-files' : '' }}">
                                        <div class="file-icon-small">
                                            <i class="bi bi-paperclip"></i>
                                        </div>
                                        <div>
                                            <span class="file-number">{{ $fileCount }}</span>
                                            <span class="file-text-small">Files</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Pengaduan Card -->
                    @endforeach
                </div>

                {{-- START: Pagination Links --}}
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $pengaduan->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                {{-- END: Pagination Links --}}

                @if ($pengaduan->isEmpty())
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="empty-state" data-aos="fade-up">
                                <i class="bi bi-inbox display-1 text-muted"></i>
                                <h3 class="mt-3">Belum Ada Pengaduan</h3>
                                <p class="text-muted">Mulai dengan mengajukan pengaduan pertama.</p>
                                <a href="{{ route('pengaduan.create') }}" class="btn btn-primary mt-3">
                                    <i class="bi bi-plus-circle"></i> Ajukan Pengaduan Pertama
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

        </section><!-- /Data Pengaduan Section -->

    </main>

    <style>
        /* ===========================================
                           CARD PENGGUNAAN DESAIN BULAT (DENGAN ATTACHMENT MIRIP TINDAK LANJUT)
                        =========================================== */
        .user-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid #f0f0f0;
            margin-bottom: 20px;
            text-align: center;
            padding: 20px 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 320px;
            position: relative;
        }

        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        /* Area Gambar Bulat di Tengah */
        .user-picture-area {
            position: relative;
            width: 100px;
            height: 100px;
            margin: 0 auto 12px auto;
            flex-shrink: 0;
        }

        /* Lingkaran untuk Foto/Icon */
        .user-picture-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #f0f5ff;
            background: #f8f9fa;
            position: relative;
            z-index: 1;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        /* Avatar untuk Pengadu */
        .pengadu-icon {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #175cdd 0%, #0e3d8b 100%);
            /* Warna biru seperti di show */
            color: white;
            font-size: 2rem;
            /* Ukuran icon */
        }

        /* Overlay Lingkaran untuk Action Buttons */
        .user-overlay-circle {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(23, 92, 221, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 2;
        }

        .user-card:hover .user-overlay-circle {
            opacity: 1;
        }

        /* Tombol Action */
        .user-action-links {
            display: flex;
            gap: 8px;
        }

        .user-action-btn {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1.5px solid white;
            background: rgba(255, 255, 255, 0.25);
            cursor: pointer;
            font-size: 0.75rem;
        }

        .user-view-btn:hover {
            background: rgba(23, 162, 184, 0.9);
            transform: scale(1.1);
        }

        .user-edit-btn:hover {
            background: rgba(255, 193, 7, 0.9);
            transform: scale(1.1);
        }

        .user-delete-btn:hover {
            background: rgba(220, 53, 69, 0.9);
            transform: scale(1.1);
        }

        /* User Content */
        .user-content {
            padding: 0 5px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-grow: 1;
        }

        /* Judul Pengaduan */
        .user-name {
            color: #2c3e50;
            margin-bottom: 6px;
            font-weight: 700;
            font-size: 1rem;
            line-height: 1.3;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding: 0 5px;
        }

        /* Badge Status */
        .user-role-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 10px;
            border: 1px solid transparent;
            white-space: nowrap;
        }

        /* Warna Status */
        .status-menunggu {
            background: #fff3cd;
            color: #856404;
            border-color: #ffeaa7;
        }

        .status-diproses {
            background: #cce5ff;
            color: #004085;
            border-color: #b8daff;
        }

        .status-selesai {
            background: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .status-ditolak {
            background: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        /* Info Item */
        .user-info-item {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 8px;
            font-size: 0.8rem;
            margin-bottom: 6px;
            width: 100%;
            text-align: left;
            padding: 3px 8px;
            min-height: 22px;
            margin-left: 4px;
        }

        .user-info-item i {
            color: #175cdd;
            flex-shrink: 0;
            font-size: 0.9rem;
            width: 18px;
            text-align: center;
        }

        .user-info-text {
            color: #6c757d;
            word-break: break-word;
            overflow-wrap: break-word;
            flex: 1;
            line-height: 1.3;
            max-height: 2.6em;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            font-size: 0.8rem;
        }

        /* File Attachment - STYLING MIRIP TINDAK LANJUT */
        .file-info-compact {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 10px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-top: 8px;
            width: 100%;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .file-info-compact.no-files {
            opacity: 0.7;
            background: #f1f3f4;
        }

        .file-icon-small {
            width: 24px;
            height: 24px;
            background: #175cdd;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }

        .file-info-compact.no-files .file-icon-small {
            background: #adb5bd;
        }

        .file-number {
            font-size: 0.9rem;
            font-weight: 700;
            color: #175cdd;
            transition: all 0.3s ease;
        }

        .file-info-compact.no-files .file-number {
            color: #6c757d;
            font-weight: 500;
        }

        .file-text-small {
            font-size: 0.7rem;
            color: #6c757d;
            margin-left: 4px;
        }

        /* CSS untuk search-section */
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

        /* CSS untuk total-badge */
        .total-badge {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 20px;
            padding: 10px 20px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
            color: #495057;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .total-badge:hover {
            border-color: #175cdd;
            background: #f0f5ff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(23, 92, 221, 0.1);
        }

        .total-number {
            font-size: 1.3rem;
            font-weight: 700;
            color: #175cdd;
            min-width: 30px;
            text-align: center;
        }

        .total-text {
            font-weight: 500;
            white-space: nowrap;
        }

        /* Empty State */
        .empty-state {
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 4rem;
            color: #6c757d;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .user-info-text {
                max-width: 160px;
            }
        }

        @media (max-width: 992px) {
            .col-lg-3 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            .user-picture-area {
                width: 90px;
                height: 90px;
            }

            .user-picture-circle {
                width: 90px;
                height: 90px;
            }

            .user-name {
                font-size: 0.95rem;
            }

            .user-info-text {
                max-width: 140px;
            }

            .user-card {
                min-height: 310px;
            }

            .user-action-btn {
                width: 24px;
                height: 24px;
                font-size: 0.7rem;
            }

            .user-info-item {
                padding: 3px 6px;
                margin-left: 2px;
                margin-bottom: 5px;
                font-size: 0.75rem;
            }
        }

        @media (max-width: 768px) {
            .col-lg-3 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .user-picture-area {
                width: 100px;
                height: 100px;
            }

            .user-picture-circle {
                width: 100px;
                height: 100px;
            }

            .user-info-text {
                max-width: 220px;
            }

            .user-card {
                min-height: 300px;
            }

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

            .d-flex.justify-content-between {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 15px;
            }

            .total-badge {
                align-self: flex-start;
                margin-top: 5px;
            }
        }

        @media (max-width: 480px) {
            .user-info-text {
                max-width: 180px;
            }

            .user-card {
                min-height: 290px;
                padding: 15px 12px;
            }

            .user-picture-area {
                width: 85px;
                height: 85px;
                margin-bottom: 10px;
            }

            .user-picture-circle {
                width: 85px;
                height: 85px;
            }

            .user-info-item {
                font-size: 0.7rem;
                margin-bottom: 5px;
                padding: 2px 4px;
                margin-left: 0;
            }

            .user-info-item i {
                font-size: 0.85rem;
                width: 16px;
            }

            .user-action-btn {
                width: 22px;
                height: 22px;
                font-size: 0.65rem;
            }
        }
    </style>
@endsection
