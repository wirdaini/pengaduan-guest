@extends('layouts.guest.app')

@section('title', 'Data Tindak Lanjut - Bina Desa')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
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

                        <!-- ========== TOTAL TINDAK LANJUT DI SINI ========== -->
                        <div class="mt-2">
                            <p class="text-muted mb-0">
                                <i class="bi bi-check-circle me-1"></i>
                                Total: <strong>{{ $tindak_lanjut->total() }}</strong> tindak lanjut
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

                <!-- Tindak Lanjut Grid -->
                <div class="row gy-4">
                    @foreach ($tindak_lanjut as $item)
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="user-card">
                                <!-- Bagian Avatar Bulat -->
                                <div class="user-picture-area">
                                    <div class="user-picture-circle">
                                        <!-- GANTI INISIAL NAMA DENGAN ICON PAPAN UJIAN -->
                                        <div class="petugas-avatar">
                                            <i class="bi bi-clipboard-check"></i> <!-- ICON GANTI INISIAL -->
                                        </div>
                                    </div>

                                    <!-- Overlay untuk Action Buttons -->
                                    <div class="user-overlay-circle">
                                        <div class="user-action-links">
                                            <a href="{{ route('tindak_lanjut.show', $item->tindak_id) }}"
                                                class="user-action-btn user-view-btn">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('tindak_lanjut.edit', $item->tindak_id) }}"
                                                class="user-action-btn user-edit-btn">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('tindak_lanjut.destroy', $item->tindak_id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="user-action-btn user-delete-btn"
                                                    onclick="return confirm('Yakin ingin menghapus tindak lanjut ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Tindak Lanjut -->
                                <div class="user-content">
                                    <h4 class="user-name">{{ Str::limit($item->aksi, 40) }}</h4>
                                    <span class="user-role-badge">
                                        {{ $item->petugas }}
                                    </span>

                                    <!-- Container untuk 4 baris info -->
                                    <div class="user-info-container">
                                        <!-- Pengaduan -->
                                        <div class="user-info-item">
                                            <i class="bi bi-inbox"></i>
                                            <span class="user-info-text">
                                                {{ $item->pengaduan->judul ? Str::limit($item->pengaduan->judul, 30) : '-' }}
                                            </span>
                                        </div>

                                        <!-- No Tiket -->
                                        <div class="user-info-item">
                                            <i class="bi bi-ticket"></i>
                                            <span class="user-info-text">
                                                {{ $item->pengaduan->nomor_tiket ?? '-' }}
                                            </span>
                                        </div>

                                        <!-- Catatan -->
                                        <div class="user-info-item">
                                            <i class="bi bi-card-text"></i>
                                            <span class="user-info-text">
                                                {{ $item->catatan ? Str::limit($item->catatan, 50) : '-' }}
                                            </span>
                                        </div>

                                        <!-- Tanggal Dibuat -->
                                        <div class="user-info-item">
                                            <i class="bi bi-calendar-event"></i>
                                            <span class="user-info-text">
                                                {{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- File Attachment - SELALU DI BAWAH & DEKAT DENGAN TANGGAL -->
                                    @php
                                        $fileCount = \App\Models\Media::where('ref_table', 'tindak_lanjut')
                                            ->where('ref_id', $item->tindak_id)
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
                        </div><!-- End Tindak Lanjut Card -->
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
        /* ===========================================
                   CARD TINDAK LANJUT DESAIN BULAT - LEBIH PENDEK
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
            padding: 18px 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 290px;
            position: relative;
        }

        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        /* Area Gambar Bulat di Tengah */
        .user-picture-area {
            position: relative;
            width: 90px;
            height: 90px;
            margin: 0 auto 10px auto;
            flex-shrink: 0;
        }

        /* Lingkaran untuk Foto/Icon */
        .user-picture-circle {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #f0f5ff;
            background: #f8f9fa;
            position: relative;
            z-index: 1;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        /* Avatar untuk Petugas */
        .petugas-avatar {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #175cdd 0%, #0e3d8b 100%);
            color: white;
            font-size: 1.8rem;
            /* Ukuran icon */
            font-weight: bold;
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
            gap: 6px;
        }

        .user-action-btn {
            width: 24px;
            height: 24px;
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
            font-size: 0.7rem;
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

        /* User Content - LEBIH PENDEK */
        .user-content {
            padding: 0 5px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-grow: 1;
            min-height: 180px;
        }

        /* Aksi Tindak Lanjut */
        .user-name {
            color: #2c3e50;
            margin-bottom: 5px;
            font-weight: 700;
            font-size: 0.95rem;
            line-height: 1.3;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding: 0 3px;
        }

        /* Badge Petugas */
        .user-role-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 0.7rem;
            font-weight: 600;
            margin-bottom: 8px;
            border: 1px solid #d1e0ff;
            background: #e8f4ff;
            color: #175cdd;
            white-space: nowrap;
        }

        /* Container untuk 4 baris info */
        .user-info-container {
            width: 100%;
            flex: 1;
            margin-bottom: 5px;
            /* DIPENDEKKAN */
        }

        /* Info Item - SPASI DIKURANGI */
        .user-info-item {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 6px;
            font-size: 0.75rem;
            margin-bottom: 4px;
            /* DIPENDEKKAN */
            width: 100%;
            text-align: left;
            padding: 2px 6px;
            min-height: 20px;
        }

        .user-info-item i {
            color: #175cdd;
            flex-shrink: 0;
            font-size: 0.85rem;
            width: 16px;
            text-align: center;
        }

        .user-info-text {
            color: #6c757d;
            word-break: break-word;
            overflow-wrap: break-word;
            flex: 1;
            line-height: 1.2;
            max-height: 2.4em;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            font-size: 0.75rem;
        }

        /* Styling untuk item kosong */
        .user-info-text:empty:before,
        .user-info-text:-moz-only-whitespace:before {
            content: "-";
            color: #adb5bd;
            font-style: italic;
        }

        /* File Attachment - LEBIH DEKAT DENGAN TANGGAL */
        .file-info-compact {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 5px 8px;
            background: #f8f9fa;
            border-radius: 6px;
            margin-top: 3px;
            /* DIPENDEKKAN */
            width: 100%;
            justify-content: center;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
            min-height: 32px;
        }

        .file-info-compact.no-files {
            opacity: 0.7;
            background: #f1f3f4;
            border-color: #dee2e6;
        }

        .file-icon-small {
            width: 22px;
            height: 22px;
            background: #175cdd;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.75rem;
            transition: all 0.3s ease;
        }

        .file-info-compact.no-files .file-icon-small {
            background: #adb5bd;
        }

        .file-number {
            font-size: 0.8rem;
            font-weight: 700;
            color: #175cdd;
            transition: all 0.3s ease;
        }

        .file-info-compact.no-files .file-number {
            color: #6c757d;
            font-weight: 500;
        }

        .file-text-small {
            font-size: 0.65rem;
            color: #6c757d;
            margin-left: 3px;
        }

        /* CSS untuk search-section (SAMA DENGAN SEBELUMNYA) */
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

        /* CSS untuk total-badge (SAMA DENGAN SEBELUMNYA) */
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
        @media (max-width: 992px) {
            .col-lg-3 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            .user-picture-area {
                width: 80px;
                height: 80px;
            }

            .user-picture-circle {
                width: 80px;
                height: 80px;
            }

            .petugas-avatar {
                font-size: 1.6rem;
            }

            .user-name {
                font-size: 0.9rem;
            }

            .user-info-text {
                max-width: 120px;
            }

            .user-card {
                min-height: 280px;
                padding: 15px 10px;
            }

            .user-action-btn {
                width: 22px;
                height: 22px;
                font-size: 0.65rem;
            }

            .user-info-item {
                padding: 2px 4px;
                margin-bottom: 3px;
                font-size: 0.7rem;
            }
        }

        @media (max-width: 768px) {
            .col-lg-3 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .user-picture-area {
                width: 85px;
                height: 85px;
            }

            .user-picture-circle {
                width: 85px;
                height: 85px;
            }

            .user-info-text {
                max-width: 200px;
            }

            .user-card {
                min-height: 270px;
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
                max-width: 160px;
            }

            .user-card {
                min-height: 260px;
                padding: 12px 10px;
            }

            .user-picture-area {
                width: 75px;
                height: 75px;
                margin-bottom: 8px;
            }

            .user-picture-circle {
                width: 75px;
                height: 75px;
            }

            .petugas-avatar {
                font-size: 1.5rem;
            }

            .user-info-item {
                font-size: 0.7rem;
                margin-bottom: 3px;
                padding: 1px 3px;
            }

            .user-info-item i {
                font-size: 0.8rem;
                width: 14px;
            }

            .user-action-btn {
                width: 20px;
                height: 20px;
                font-size: 0.6rem;
            }
        }
    </style>

    <script>
        // Pastikan semua card memiliki tinggi yang sama
        document.addEventListener('DOMContentLoaded', function() {
            function equalizeCardHeights() {
                const cards = document.querySelectorAll('.user-card');
                if (cards.length === 0) return;

                // Reset height
                cards.forEach(card => {
                    card.style.minHeight = '';
                });

                // Cari card dengan tinggi tertinggi
                let maxHeight = 0;
                cards.forEach(card => {
                    const height = card.offsetHeight;
                    if (height > maxHeight) {
                        maxHeight = height;
                    }
                });

                // Set semua card ke tinggi yang sama
                cards.forEach(card => {
                    card.style.minHeight = maxHeight + 'px';
                });
            }

            // Jalankan saat halaman dimuat
            equalizeCardHeights();

            // Jalankan saat ukuran window berubah
            window.addEventListener('resize', equalizeCardHeights);
        });
    </script>
@endsection
