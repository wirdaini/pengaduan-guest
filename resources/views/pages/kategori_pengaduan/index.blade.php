@extends('layouts.guest.app')

@section('title', 'Kategori Pengaduan - Bina Desa')

@section('content')
    <main class="main">
        <!-- Page Title -->
        <div class="page-title">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
                        <li class="current">Kategori Pengaduan</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Kategori Pengaduan Section -->
        <section id="kategori_pengaduan" class="kategori_pengaduan section">
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
                            <h2>Daftar Kategori Pengaduan</h2>
                            <a href="{{ route('kategori_pengaduan.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Tambah Kategori Baru
                            </a>
                        </div>

                        <!-- ========== TOTAL KATEGORI DI SINI ========== -->
                        <div class="mt-2">
                            <p class="text-muted mb-0">
                                <i class="bi bi-tags me-1"></i>
                                Total: <strong>{{ $kategoris->total() }}</strong> kategori
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


                                    <form method="GET" action="{{ route('kategori_pengaduan.index') }}"
                                        class="search-form">
                                        <div class="search-input-group">

                                            <!-- SEARCH INPUT -->
                                            <div class="input-wrapper">
                                                <i class="bi bi-search"></i>
                                                <input type="text" class="form-control" name="search"
                                                    value="{{ request('search') }}" placeholder="Cari nama kategori...">
                                            </div>

                                            <!-- FILTER PRIORITAS -->
                                            <div class="select-wrapper">
                                                <i class="bi bi-exclamation-circle"></i>
                                                <select class="form-select" name="prioritas">
                                                    <option value="">Semua Prioritas</option>
                                                    <option value="Rendah"
                                                        {{ request('prioritas') == 'Rendah' ? 'selected' : '' }}>Rendah
                                                    </option>
                                                    <option value="Sedang"
                                                        {{ request('prioritas') == 'Sedang' ? 'selected' : '' }}>Sedang
                                                    </option>
                                                    <option value="Tinggi"
                                                        {{ request('prioritas') == 'Tinggi' ? 'selected' : '' }}>Tinggi
                                                    </option>
                                                    <option value="Kritis"
                                                        {{ request('prioritas') == 'Kritis' ? 'selected' : '' }}>Kritis
                                                    </option>
                                                </select>
                                            </div>

                                            <!-- FILTER SLA -->
                                            <div class="select-wrapper">
                                                <i class="bi bi-clock"></i>
                                                <select class="form-select" name="sla_hari">
                                                    <option value="">Semua SLA</option>
                                                    <option value="1"
                                                        {{ request('sla_hari') == '1' ? 'selected' : '' }}>1 Hari</option>
                                                    <option value="3"
                                                        {{ request('sla_hari') == '3' ? 'selected' : '' }}>3 Hari</option>
                                                    <option value="7"
                                                        {{ request('sla_hari') == '7' ? 'selected' : '' }}>7 Hari</option>
                                                    <option value="14"
                                                        {{ request('sla_hari') == '14' ? 'selected' : '' }}>15 Hari
                                                    </option>
                                                </select>
                                            </div>

                                            <!-- TOMBOL CARI -->
                                            <button type="submit" class="search-btn">
                                                <i class="bi bi-search"></i>
                                                Cari Kategori
                                            </button>

                                            <!-- TOMBOL RESET -->
                                            <a href="{{ route('kategori_pengaduan.index') }}"
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
                @if (request()->anyFilled(['search', 'prioritas', 'sla_hari']))
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
                                        @if (request('prioritas'))
                                            <span class="badge"
                                                style="background: color-mix(in srgb, var(--accent-color), transparent 90%); color: var(--accent-color); padding: 6px 12px; border-radius: 12px; font-size: 0.875rem; font-weight: 500; margin-left: 8px;">
                                                Prioritas: {{ request('prioritas') }}
                                            </span>
                                        @endif
                                        @if (request('sla_hari'))
                                            <span class="badge"
                                                style="background: color-mix(in srgb, var(--accent-color), transparent 90%); color: var(--accent-color); padding: 6px 12px; border-radius: 12px; font-size: 0.875rem; font-weight: 500; margin-left: 8px;">
                                                SLA: {{ request('sla_hari') }} Hari
                                            </span>
                                        @endif
                                        <span class="badge"
                                            style="background: var(--accent-color); color: var(--contrast-color); padding: 6px 12px; border-radius: 12px; font-size: 0.875rem; font-weight: 500; margin-left: 8px;">
                                            {{ $kategoris->total() }} data ditemukan
                                        </span>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Kategori Grid -->
                <div class="row gy-4">
                    @foreach ($kategoris as $item)
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="user-card">
                                <!-- Bagian Icon Bulat -->
                                <div class="user-picture-area">
                                    <div class="user-picture-circle">
                                        <div class="user-picture-default kategori-icon-bg">
                                            <i class="bi bi-tags"></i>
                                        </div>
                                    </div>

                                    <!-- Overlay untuk Action Buttons -->
                                    <div class="user-overlay-circle">
                                        <div class="user-action-links">
                                            <a href="{{ route('kategori_pengaduan.show', $item->kategori_id) }}"
                                                class="user-action-btn user-view-btn">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('kategori_pengaduan.edit', $item->kategori_id) }}"
                                                class="user-action-btn user-edit-btn">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('kategori_pengaduan.destroy', $item->kategori_id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="user-action-btn user-delete-btn"
                                                    onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Kategori -->
                                <div class="user-content">
                                    <h4 class="user-name">{{ $item->nama }}</h4>
                                    <span class="user-role-badge prioritas-{{ strtolower($item->prioritas) }}">
                                        {{ $item->prioritas }}
                                    </span>

                                    <!-- SLA -->
                                    <div class="user-info-item">
                                        <i class="bi bi-clock"></i>
                                        <span class="user-info-text">
                                            SLA: {{ $item->sla_hari }} hari
                                        </span>
                                    </div>

                                    <!-- Deskripsi -->
                                    @if ($item->deskripsi)
                                        <div class="user-info-item">
                                            <i class="bi bi-card-text"></i>
                                            <span class="user-info-text">
                                                {{ Str::limit($item->deskripsi, 50) }}
                                            </span>
                                        </div>
                                    @endif

                                    <!-- Tanggal Dibuat -->
                                    <div class="user-info-item">
                                        <i class="bi bi-calendar-plus"></i>
                                        <span class="user-info-text">
                                            Dibuat: {{ $item->created_at->format('d M Y') }}
                                        </span>
                                    </div>

                                    <!-- Status Aktif (jika ada) -->
                                    @if (isset($item->is_active))
                                        <div class="user-info-item">
                                            <i class="bi bi-toggle2-{{ $item->is_active ? 'on' : 'off' }}"></i>
                                            <span
                                                class="user-info-text status-{{ $item->is_active ? 'aktif' : 'nonaktif' }}">
                                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div><!-- End Kategori Card -->
                    @endforeach
                </div>

                {{-- START: Pagination Links --}}
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $kategoris->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                {{-- END: Pagination Links --}}

                @if ($kategoris->isEmpty())
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="empty-state" data-aos="fade-up">
                                <i class="bi bi-tags display-1 text-muted"></i>
                                <h3 class="mt-3">Belum Ada Kategori</h3>
                                <p class="text-muted">Mulai dengan menambahkan kategori pertama.</p>
                                <a href="{{ route('kategori_pengaduan.create') }}" class="btn btn-primary mt-3">
                                    <i class="bi bi-plus-circle"></i> Tambah Kategori Pertama
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </section><!-- /Kategori Pengaduan Section -->
    </main>

    <style>
        /* ===========================================
                   CARD KATEGORI (tanpa ID)
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
            min-height: 300px;
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

        /* Lingkaran untuk Icon */
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

        /* Icon Kategori dengan warna BIRU */
        .kategori-icon-bg {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #175cdd 0%, #0e3d8b 100%);
            color: white;
            font-size: 2.5rem;
        }

        .user-picture-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .user-card:hover .user-picture-img {
            transform: scale(1.05);
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

        /* Nama Kategori */
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

        /* Badge Prioritas */
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

        /* Warna Prioritas */
        .prioritas-rendah {
            background: #e8f5e9;
            color: #28a745;
            border-color: #c3e6cb;
        }

        .prioritas-sedang {
            background: #fff3cd;
            color: #856404;
            border-color: #ffeaa7;
        }

        .prioritas-tinggi {
            background: #ffe5d0;
            color: #d35400;
            border-color: #fdbe74;
        }

        .prioritas-kritis {
            background: #f8d7da;
            color: #c62828;
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
            word-break: break-all;
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

        /* Status Aktif/Nonaktif */
        .status-aktif {
            color: #28a745;
            font-weight: 500;
        }

        .status-nonaktif {
            color: #dc3545;
            font-weight: 500;
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
                min-height: 290px;
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
                min-height: 280px;
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
                min-height: 270px;
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
