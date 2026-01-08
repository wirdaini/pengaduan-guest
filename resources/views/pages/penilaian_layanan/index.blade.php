@extends('layouts.guest.app')

@section('title', 'Data Penilaian Layanan - Bina Desa')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
                        <li class="current">Data Penilaian Layanan</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Data Penilaian Section -->
        <section id="penilaian-layanan" class="penilaian-layanan section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2>Daftar Penilaian Layanan</h2>
                            <a href="{{ route('penilaian_layanan.create') }}" class="btn btn-primary">
                                <i class="bi bi-star-fill"></i> Beri Penilaian Baru
                            </a>
                        </div>

                        <div class="mt-2">
                            <p class="text-muted mb-0">
                                <i class="bi bi-star me-1"></i>
                                Total: <strong>{{ $penilaian->total() }}</strong> penilaian
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

                                    <form method="GET" action="{{ route('penilaian_layanan.index') }}"
                                        class="search-form">
                                        <div class="search-input-group">
                                            <!-- SEARCH INPUT -->
                                            <div class="input-wrapper">
                                                <i class="bi bi-search"></i>
                                                <input type="text" class="form-control" name="search"
                                                    value="{{ request('search') }}"
                                                    placeholder="Cari komentar atau nama warga...">
                                            </div>

                                            <!-- FILTER RATING -->
                                            <div class="select-wrapper">
                                                <i class="bi bi-star"></i>
                                                <select class="form-select" name="rating">
                                                    <option value="">Semua Rating</option>
                                                    <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>
                                                        ⭐ (1) - Sangat Tidak Puas</option>
                                                    <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>
                                                        ⭐⭐ (2) - Tidak Puas</option>
                                                    <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>
                                                        ⭐⭐⭐ (3) - Cukup Puas</option>
                                                    <option value="4"
                                                        {{ request('rating') == '4' ? 'selected' : '' }}>⭐⭐⭐⭐ (4) - Puas
                                                    </option>
                                                    <option value="5"
                                                        {{ request('rating') == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5) - Sangat
                                                        Puas</option>
                                                </select>
                                            </div>

                                            <!-- TOMBOL CARI -->
                                            <button type="submit" class="search-btn">
                                                <i class="bi bi-search"></i>
                                                Cari Penilaian
                                            </button>

                                            <!-- TOMBOL RESET -->
                                            <a href="{{ route('penilaian_layanan.index') }}"
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

                <!-- Statistik Rating -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Statistik Penilaian</h5>
                                <div class="row text-center">
                                    @php
                                        $total = $penilaian->total();
                                        $ratings = [
                                            5 => $penilaian->where('rating', 5)->count(),
                                            4 => $penilaian->where('rating', 4)->count(),
                                            3 => $penilaian->where('rating', 3)->count(),
                                            2 => $penilaian->where('rating', 2)->count(),
                                            1 => $penilaian->where('rating', 1)->count(),
                                        ];
                                        $average = $total > 0 ? number_format($penilaian->avg('rating'), 1) : 0;
                                    @endphp
                                    <div class="col-md-2 col-4">
                                        <div class="stat-box">
                                            <h3>{{ $total }}</h3>
                                            <p>Total Penilaian</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-4">
                                        <div class="stat-box">
                                            <h3>{{ $average }}</h3>
                                            <p>Rata-rata Rating</p>
                                        </div>
                                    </div>
                                    @foreach ($ratings as $stars => $count)
                                        <div class="col-md-2 col-4">
                                            <div class="stat-box">
                                                <h3>{{ $count }}</h3>
                                                <p>{{ str_repeat('⭐', $stars) }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search & Filter Results -->
                @if (request()->anyFilled(['search', 'rating']))
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
                                        @if (request('rating'))
                                            <span class="badge"
                                                style="background: color-mix(in srgb, var(--accent-color), transparent 90%); color: var(--accent-color); padding: 6px 12px; border-radius: 12px; font-size: 0.875rem; font-weight: 500; margin-left: 8px;">
                                                Rating: {{ str_repeat('⭐', request('rating')) }}
                                            </span>
                                        @endif
                                        <span class="badge"
                                            style="background: var(--accent-color); color: var(--contrast-color); padding: 6px 12px; border-radius: 12px; font-size: 0.875rem; font-weight: 500; margin-left: 8px;">
                                            {{ $penilaian->total() }} data ditemukan
                                        </span>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- PENILAIAN GRID - 4 PER BARIS -->
                <div class="row gy-4">
                    @foreach ($penilaian as $item)
                        <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up"
                            data-aos-delay="{{ $loop->iteration * 100 }}">
                            <div class="user-card">
                                <!-- Bagian Avatar Bulat dengan Rating -->
                                <div class="user-picture-area">
                                    <!-- Bagian Avatar Bulat dengan Rating -->
                                    <div class="user-picture-circle rating-{{ $item->rating }}">
                                        <div class="rating-avatar">
                                            @if ($item->rating == 5)
                                                <i class="bi bi-emoji-laughing"></i>
                                            @elseif($item->rating == 4)
                                                <i class="bi bi-emoji-smile"></i>
                                            @elseif($item->rating == 3)
                                                <i class="bi bi-emoji-neutral"></i>
                                            @elseif($item->rating == 2)
                                                <i class="bi bi-emoji-frown"></i>
                                            @else
                                                <i class="bi bi-emoji-angry"></i>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Overlay untuk Action Buttons -->
                                    <div class="user-overlay-circle">
                                        <div class="user-action-links">
                                            <a href="{{ route('penilaian_layanan.show', $item->penilaian_id) }}"
                                                class="user-action-btn user-view-btn">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if ($item->created_at->diffInHours(now()) <= 24)
                                                <a href="{{ route('penilaian_layanan.edit', $item->penilaian_id) }}"
                                                    class="user-action-btn user-edit-btn">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            @endif
                                            <form action="{{ route('penilaian_layanan.destroy', $item->penilaian_id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="user-action-btn user-delete-btn"
                                                    onclick="return confirm('Yakin ingin menghapus penilaian ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Penilaian -->
                                <div class="user-content">
                                    <h4 class="user-name">{{ Str::limit($item->pengaduan->judul, 35) }}</h4>

                                    <!-- Badge Rating -->
                                    <span class="user-role-badge rating-{{ $item->rating }}-badge">
                                        @if ($item->rating == 5)
                                            <i class="bi bi-emoji-laughing me-1"></i>Sangat Puas
                                        @elseif($item->rating == 4)
                                            <i class="bi bi-emoji-smile me-1"></i>Puas
                                        @elseif($item->rating == 3)
                                            <i class="bi bi-emoji-neutral me-1"></i>Cukup
                                        @elseif($item->rating == 2)
                                            <i class="bi bi-emoji-frown me-1"></i>Tidak
                                        @else
                                            <i class="bi bi-emoji-angry me-1"></i>Buruk
                                        @endif
                                    </span>

                                    <!-- Warga Pengadu -->
                                    <div class="user-info-item">
                                        <i class="bi bi-person"></i>
                                        <span class="user-info-text">
                                            {{ $item->pengaduan->warga->nama ?? '-' }}
                                        </span>
                                    </div>

                                    <!-- No Tiket -->
                                    <div class="user-info-item">
                                        <i class="bi bi-ticket"></i>
                                        <span class="user-info-text tiket-number">
                                            {{ $item->pengaduan->nomor_tiket ?? '-' }}
                                        </span>
                                    </div>

                                    <!-- Rating Bintang -->
                                    <div class="user-info-item">
                                        <i class="bi bi-star"></i>
                                        <span class="user-info-text">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $item->rating)
                                                    <i class="bi bi-star-fill text-warning"
                                                        style="font-size: 0.85em;"></i>
                                                @else
                                                    <i class="bi bi-star text-muted" style="font-size: 0.85em;"></i>
                                                @endif
                                            @endfor
                                            ({{ $item->rating }}/5)
                                        </span>
                                    </div>

                                    <!-- Komentar -->
                                    <div class="user-info-item">
                                        <i class="bi bi-chat-left-text"></i>
                                        <span class="user-info-text">
                                            {{ $item->komentar ? Str::limit($item->komentar, 50) : '-' }}
                                        </span>
                                    </div>

                                    <!-- Tanggal Penilaian -->
                                    <div class="user-info-item">
                                        <i class="bi bi-calendar-event"></i>
                                        <span class="user-info-text">
                                            {{ $item->created_at->format('d M Y') ?? '-' }}
                                        </span>
                                    </div>

                                    <!-- Status Waktu Edit - SELALU ADA DI BAWAH -->
                                    <div
                                        class="file-info-compact {{ $item->created_at->diffInHours(now()) <= 24 ? 'can-edit' : 'cannot-edit' }}">
                                        <div class="file-icon-small">
                                            <i class="bi bi-clock"></i>
                                        </div>
                                        <div>
                                            <span class="file-number">
                                                @if ($item->created_at->diffInHours(now()) <= 24)
                                                    <span class="text-success">Bisa Edit</span>
                                                @else
                                                    <span class="text-secondary">Locked</span>
                                                @endif
                                            </span>
                                            <span class="file-text-small">
                                                {{ $item->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Penilaian Card -->
                    @endforeach
                </div>

                {{-- START: Pagination Links --}}
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $penilaian->links('pagination::bootstrap-5') }}
                    </div>
                </div>
                {{-- END: Pagination Links --}}

                @if ($penilaian->isEmpty())
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="empty-state" data-aos="fade-up">
                                <i class="bi bi-star display-1 text-muted"></i>
                                <h3 class="mt-3">Belum Ada Penilaian</h3>
                                <p class="text-muted">Mulai dengan memberikan penilaian pertama.</p>
                                <a href="{{ route('penilaian_layanan.create') }}" class="btn btn-primary mt-3">
                                    <i class="bi bi-star-fill"></i> Beri Penilaian Pertama
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

        </section><!-- /Data Penilaian Section -->

    </main>

    <style>
        /* ===========================================
                           CARD PENILAIAN LAYANAN DESAIN BULAT - 4 KOLOM
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
            width: 95px;
            height: 95px;
            margin: 0 auto 10px auto;
            flex-shrink: 0;
        }

        /* Lingkaran untuk Rating Avatar */
        .user-picture-circle {
            width: 95px;
            height: 95px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #f0f5ff;
            background: #f8f9fa;
            position: relative;
            z-index: 1;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        /* Warna Rating Avatar */
        .rating-5 {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
        }

        .rating-4 {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        }

        .rating-3 {
            background: linear-gradient(135deg, #f1c40f 0%, #f39c12 100%);
        }

        .rating-2 {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        }

        .rating-1 {
            background: linear-gradient(135deg, #7f8c8d 0%, #34495e 100%);
        }

        /* Avatar untuk Rating */
        /* Style untuk emoji di avatar */
        .rating-avatar {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .rating-avatar i {
            font-size: 2.5rem;
            /* Besarkan emoji */
            color: white;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
            transition: all 0.3s ease;
        }

        /* Efek hover */
        .user-card:hover .rating-avatar i {
            transform: scale(1.2) rotate(10deg);
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

        /* User Content - FIXED HEIGHT */
        .user-content {
            padding: 0 3px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-grow: 1;
            min-height: 220px;
        }

        /* Judul Pengaduan */
        .user-name {
            color: #2c3e50;
            margin-bottom: 5px;
            font-weight: 700;
            font-size: 0.9rem;
            line-height: 1.3;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding: 0 3px;
        }

        /* Badge Rating */
        .user-role-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 0.7rem;
            font-weight: 600;
            margin-bottom: 10px;
            border: 1px solid transparent;
            white-space: nowrap;
        }

        /* Warna Badge Rating */
        .rating-5-badge {
            background: #d4edda;
            color: #155724;
            border-color: #c3e6cb;
        }

        .rating-4-badge {
            background: #cce5ff;
            color: #004085;
            border-color: #b8daff;
        }

        .rating-3-badge {
            background: #fff3cd;
            color: #856404;
            border-color: #ffeaa7;
        }

        .rating-2-badge {
            background: #f8d7da;
            color: #721c24;
            border-color: #f5c6cb;
        }

        .rating-1-badge {
            background: #e2e3e5;
            color: #383d41;
            border-color: #d6d8db;
        }

        /* Info Item - 5 ITEM TETAP */
        .user-info-container {
            width: 100%;
            flex: 1;
            margin-bottom: 10px;
        }

        .user-info-item {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 6px;
            font-size: 0.75rem;
            margin-bottom: 6px;
            width: 100%;
            text-align: left;
            padding: 3px 5px;
            min-height: 22px;
            border-radius: 6px;
        }

        .user-info-item.empty {
            opacity: 0.6;
        }

        .user-info-item i {
            color: #175cdd;
            flex-shrink: 0;
            font-size: 0.8rem;
            width: 16px;
            text-align: center;
        }

        .user-info-item.empty i {
            color: #6c757d;
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

        .user-info-item.empty .user-info-text {
            color: #adb5bd;
            font-style: italic;
        }

        .tiket-number {
            font-family: 'Courier New', monospace;
            font-weight: 600;
            color: #495057;
        }

        /* Status Waktu Edit - SELALU DI BAWAH */
        .file-info-compact {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-top: auto;
            width: 100%;
            justify-content: center;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
            min-height: 36px;
        }

        .file-info-compact.can-edit {
            background: #d4edda;
            border-color: #c3e6cb;
        }

        .file-info-compact.cannot-edit {
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
            font-size: 0.7rem;
            transition: all 0.3s ease;
        }

        .file-info-compact.can-edit .file-icon-small {
            background: #28a745;
        }

        .file-info-compact.cannot-edit .file-icon-small {
            background: #6c757d;
        }

        .file-number {
            font-size: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .file-info-compact.can-edit .file-number {
            color: #28a745;
        }

        .file-info-compact.cannot-edit .file-number {
            color: #6c757d;
        }

        .file-text-small {
            font-size: 0.65rem;
            color: #6c757d;
            margin-left: 4px;
        }

        /* Statistik */
        .stat-box {
            padding: 15px;
            border-radius: 10px;
            background: #f8f9fa;
            margin-bottom: 10px;
            transition: transform 0.3s ease;
        }

        .stat-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-box h3 {
            margin: 0;
            font-size: 2rem;
            color: #2c3e50;
            font-weight: bold;
        }

        .stat-box p {
            margin: 5px 0 0;
            color: #6c757d;
            font-size: 0.9em;
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

        /* Responsive untuk 4 Kolom */
        @media (max-width: 1400px) {
            .col-xl-3 {
                flex: 0 0 25%;
                max-width: 25%;
            }
        }

        @media (max-width: 1200px) {
            .col-lg-4 {
                flex: 0 0 33.333%;
                max-width: 33.333%;
            }

            .user-picture-area {
                width: 75px;
                height: 75px;
            }

            .user-picture-circle {
                width: 75px;
                height: 75px;
            }

            .user-info-text {
                max-width: 140px;
            }
        }

        @media (max-width: 992px) {
            .col-md-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            .user-picture-area {
                width: 70px;
                height: 70px;
            }

            .user-picture-circle {
                width: 70px;
                height: 70px;
            }

            .rating-avatar {
                font-size: 2rem;
                font-weight: bold;
            }

            .user-name {
                font-size: 0.85rem;
            }

            .user-info-text {
                max-width: 120px;
            }

            .user-card {
                min-height: 300px;
                padding: 15px 10px;
            }

            .user-action-btn {
                width: 22px;
                height: 22px;
                font-size: 0.65rem;
            }

            .user-info-item {
                padding: 2px 4px;
                margin-bottom: 5px;
                font-size: 0.7rem;
                gap: 5px;
            }

            .user-info-item i {
                font-size: 0.75rem;
                width: 14px;
            }
        }

        @media (max-width: 768px) {
            .col-md-6 {
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

            .user-info-text {
                max-width: 150px;
            }

            .user-card {
                min-height: 310px;
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

            .stat-box {
                margin-bottom: 15px;
            }
        }

        @media (max-width: 576px) {
            .col-md-6 {
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
                min-height: 300px;
                padding: 15px 12px;
            }
        }

        @media (max-width: 480px) {
            .user-info-text {
                max-width: 180px;
            }

            .user-card {
                min-height: 290px;
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

            .user-info-item {
                font-size: 0.65rem;
                margin-bottom: 4px;
                padding: 2px 3px;
            }

            .user-info-item i {
                font-size: 0.7rem;
                width: 12px;
            }

            .user-action-btn {
                width: 20px;
                height: 20px;
                font-size: 0.6rem;
            }

            .stat-box h3 {
                font-size: 1.5rem;
            }

            .stat-box p {
                font-size: 0.8rem;
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
