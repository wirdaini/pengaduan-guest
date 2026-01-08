@extends('layouts.guest.app')

@section('title', 'Edit Pengaduan - Bina Desa')

@section('content')
    <main class="main">
        <!-- Page Title -->
        <div class="page-title">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
                        <li><a href="{{ route('pengaduan.index') }}">Data Pengaduan</a></li>
                        <li class="current">Edit Pengaduan</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Edit Pengaduan Section -->
        <section id="edit-pengaduan" class="edit-pengaduan section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <!-- Header Section -->
                <div class="edit-header mb-4">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="edit-icon-circle">
                                <div class="edit-icon">
                                    <i class="bi bi-pencil-square"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <h2 class="edit-title mb-1">Edit Pengaduan</h2>
                            <div class="edit-subtitle">
                                <span class="badge bg-warning text-dark me-2">
                                    <i class="bi bi-exclamation-triangle me-1"></i>Mode Edit
                                </span>
                                <span class="text-muted">
                                    <i class="bi bi-ticket me-1"></i>{{ $pengaduan->nomor_tiket }}
                                </span>
                                <span class="badge status-{{ $pengaduan->status }} ms-2">
                                    @if ($pengaduan->status == 'menunggu')
                                        <i class="bi bi-clock me-1"></i>Menunggu
                                    @elseif($pengaduan->status == 'diproses')
                                        <i class="bi bi-gear me-1"></i>Diproses
                                    @elseif($pengaduan->status == 'selesai')
                                        <i class="bi bi-check-circle me-1"></i>Selesai
                                    @elseif($pengaduan->status == 'ditolak')
                                        <i class="bi bi-x-circle me-1"></i>Ditolak
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="action-buttons">
                                <a href="{{ route('pengaduan.show', $pengaduan->pengaduan_id) }}"
                                    class="btn btn-outline-info btn-sm">
                                    <i class="bi bi-eye me-1"></i>Detail
                                </a>
                                <a href="{{ route('pengaduan.index') }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-arrow-left me-1"></i>Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Form Card -->
                <div class="edit-card">
                    <div class="row">
                        <div class="col-lg-10 mx-auto">
                            <!-- Notifikasi -->
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert"
                                    style="border-radius: 12px; border: 1px solid #d4edda;">
                                    <i class="bi bi-check-circle me-2"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
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
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <!-- Form Edit -->
                            <form action="{{ route('pengaduan.update', $pengaduan->pengaduan_id) }}" method="POST"
                                class="php-email-form" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- ✅ TAMBAHKAN INPUT HIDDEN UNTUK warga_id -->
                                <input type="hidden" name="warga_id" value="{{ $pengaduan->warga_id }}">

                                <!-- TAMBAHKAN JUGA UNTUK ADMIN/PETUGAS: -->
                                @if (auth()->user()->role != 'warga')
                                    <div class="form-item">
                                        <label for="warga_id" class="form-label">
                                            <i class="bi bi-person me-1"></i>Warga Pemilik *
                                        </label>
                                        <div class="form-input-wrapper">
                                            <select name="warga_id" id="warga_id" class="form-select" required>
                                                <option value="">Pilih Warga</option>
                                                @foreach ($wargaList as $w)
                                                    <option value="{{ $w->warga_id }}"
                                                        {{ old('warga_id', $pengaduan->warga_id) == $w->warga_id ? 'selected' : '' }}>
                                                        {{ $w->nama }} - {{ $w->no_ktp }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="form-icon">
                                                <i class="bi bi-person-circle"></i>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Informasi Dasar -->
                                <div class="form-section mb-4">
                                    <h5 class="section-title mb-3">
                                        <i class="bi bi-info-circle me-2"></i>Informasi Dasar
                                    </h5>
                                    <div class="form-grid">
                                        <!-- No Tiket (Readonly) -->
                                        <div class="form-item">
                                            <label class="form-label">
                                                <i class="bi bi-ticket me-1"></i>No Tiket
                                            </label>
                                            <div class="form-input-wrapper">
                                                <input type="text" class="form-control"
                                                    value="{{ $pengaduan->nomor_tiket }}" readonly>
                                                <div class="form-icon">
                                                    <i class="bi bi-ticket"></i>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted">
                                                No tiket tidak dapat diubah
                                            </small>
                                        </div>

                                        <!-- Nama Warga (Readonly) -->
                                        <div class="form-item">
                                            <label class="form-label">
                                                <i class="bi bi-person me-1"></i>Nama Warga
                                            </label>
                                            <div class="form-input-wrapper">
                                                <input type="text" class="form-control"
                                                    value="{{ $pengaduan->warga->nama }} - {{ $pengaduan->warga->no_ktp }}"
                                                    readonly>
                                                <div class="form-icon">
                                                    <i class="bi bi-person-circle"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Judul Pengaduan -->
                                        <div class="form-item">
                                            <label for="judul" class="form-label">
                                                <i class="bi bi-card-text me-1"></i>Judul Pengaduan *
                                            </label>
                                            <div class="form-input-wrapper">
                                                <input type="text" name="judul" id="judul" class="form-control"
                                                    value="{{ old('judul', $pengaduan->judul) }}"
                                                    placeholder="Contoh: Jalan Rusak di RT 05" required>
                                                <div class="form-icon">
                                                    <i class="bi bi-pencil"></i>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted">
                                                Ringkasan singkat pengaduan
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kategori & Status -->
                                <div class="form-section mb-4">
                                    <h5 class="section-title mb-3">
                                        <i class="bi bi-tags me-2"></i>Klasifikasi
                                    </h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-item">
                                                <label for="kategori_id" class="form-label">
                                                    <i class="bi bi-tags me-1"></i>Kategori *
                                                </label>
                                                <div class="form-input-wrapper">
                                                    <select name="kategori_id" id="kategori_id" class="form-select"
                                                        required>
                                                        <option value="">Pilih Kategori</option>
                                                        @foreach ($kategori as $kat)
                                                            <option value="{{ $kat->kategori_id }}"
                                                                {{ old('kategori_id', $pengaduan->kategori_id) == $kat->kategori_id ? 'selected' : '' }}>
                                                                {{ $kat->nama }} - SLA: {{ $kat->sla_hari }} hari
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <div class="form-icon">
                                                        <i class="bi bi-tag"></i>
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted">
                                                    Pilih kategori yang sesuai
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-item">
                                                <label for="status" class="form-label">
                                                    <i class="bi bi-clock me-1"></i>Status *
                                                </label>
                                                <div class="form-input-wrapper">
                                                    <select name="status" id="status" class="form-select" required>
                                                        <option value="menunggu"
                                                            {{ old('status', $pengaduan->status) == 'menunggu' ? 'selected' : '' }}>
                                                            Menunggu
                                                        </option>
                                                        <option value="diproses"
                                                            {{ old('status', $pengaduan->status) == 'diproses' ? 'selected' : '' }}>
                                                            Diproses
                                                        </option>
                                                        <option value="selesai"
                                                            {{ old('status', $pengaduan->status) == 'selesai' ? 'selected' : '' }}>
                                                            Selesai
                                                        </option>
                                                        <option value="ditolak"
                                                            {{ old('status', $pengaduan->status) == 'ditolak' ? 'selected' : '' }}>
                                                            Ditolak
                                                        </option>
                                                    </select>
                                                    <div class="form-icon">
                                                        <i class="bi bi-clock-history"></i>
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted">
                                                    Status penanganan pengaduan
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Lokasi Pengaduan -->
                                <div class="form-section mb-4">
                                    <h5 class="section-title mb-3">
                                        <i class="bi bi-geo-alt me-2"></i>Lokasi Pengaduan
                                    </h5>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-item">
                                                <label for="lokasi_text" class="form-label">
                                                    <i class="bi bi-geo me-1"></i>Lokasi Kejadian *
                                                </label>
                                                <div class="form-input-wrapper">
                                                    <input type="text" name="lokasi_text" id="lokasi_text"
                                                        class="form-control"
                                                        value="{{ old('lokasi_text', $pengaduan->lokasi_text) }}"
                                                        placeholder="Contoh: Jl. Merdeka No. 10, RT 05/RW 02" required>
                                                    <div class="form-icon">
                                                        <i class="bi bi-geo-alt"></i>
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted">
                                                    Alamat lengkap lokasi kejadian
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-item">
                                                <label for="rt" class="form-label">
                                                    <i class="bi bi-house-door me-1"></i>RT *
                                                </label>
                                                <div class="form-input-wrapper">
                                                    <input type="text" name="rt" id="rt"
                                                        class="form-control" value="{{ old('rt', $pengaduan->rt) }}"
                                                        placeholder="Contoh: 001" required>
                                                    <div class="form-icon">
                                                        <i class="bi bi-house"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-item">
                                                <label for="rw" class="form-label">
                                                    <i class="bi bi-building me-1"></i>RW *
                                                </label>
                                                <div class="form-input-wrapper">
                                                    <input type="text" name="rw" id="rw"
                                                        class="form-control" value="{{ old('rw', $pengaduan->rw) }}"
                                                        placeholder="Contoh: 002" required>
                                                    <div class="form-icon">
                                                        <i class="bi bi-buildings"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Deskripsi Pengaduan -->
                                <div class="form-section mb-4">
                                    <h5 class="section-title mb-3">
                                        <i class="bi bi-card-text me-2"></i>Deskripsi Pengaduan
                                    </h5>
                                    <div class="form-item">
                                        <div class="form-input-wrapper">
                                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="6"
                                                placeholder="Jelaskan detail pengaduan Anda..." required>{{ old('deskripsi', $pengaduan->deskripsi) }}</textarea>
                                            <div class="form-icon">
                                                <i class="bi bi-card-text"></i>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            Jelaskan dengan detail tentang masalah yang diadukan
                                        </small>
                                    </div>
                                </div>

                                <!-- File Attachments -->
                                <div class="form-section mb-4">
                                    <h5 class="section-title mb-3">
                                        <i class="bi bi-paperclip me-2"></i>File Bukti Pendukung
                                        @if (isset($mediaFiles) && $mediaFiles->count() > 0)
                                            <span class="badge bg-primary ms-2">{{ $mediaFiles->count() }} file
                                                tersedia</span>
                                        @endif
                                    </h5>

                                    <!-- Upload File Baru -->
                                    <div class="form-item">
                                        <label for="files" class="form-label">
                                            <i class="bi bi-plus-circle me-1"></i>Tambah File Baru
                                        </label>
                                        <div class="form-input-wrapper">
                                            <input type="file" name="files[]" id="files" class="form-control"
                                                multiple accept="image/*,.pdf,.doc,.docx,.xlsx,.xls,.txt">
                                            <div class="form-icon">
                                                <i class="bi bi-upload"></i>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            Format: JPG, PNG, PDF, DOC, XLS, TXT. Max 10MB per file.
                                        </small>
                                    </div>

                                    <!-- Keterangan File -->
                                    <div class="form-item">
                                        <label for="caption" class="form-label">
                                            <i class="bi bi-chat-text me-1"></i>Keterangan File (Opsional)
                                        </label>
                                        <div class="form-input-wrapper">
                                            <textarea name="caption" id="caption" class="form-control" rows="2"
                                                placeholder="Keterangan untuk file baru">{{ old('caption') }}</textarea>
                                            <div class="form-icon">
                                                <i class="bi bi-card-text"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- File yang sudah ada -->
                                    @if (isset($mediaFiles) && $mediaFiles->count() > 0)
                                        <div class="mt-4">
                                            <h6 class="mb-3"
                                                style="color: #2c3e50; font-size: 0.95rem; font-weight: 600;">
                                                <i class="bi bi-files me-2"></i>File Terupload
                                            </h6>
                                            <div class="row">
                                                @foreach ($mediaFiles as $media)
                                                    <div class="col-md-4 col-lg-3 mb-3">
                                                        <div class="file-card">
                                                            @if (str_starts_with($media->mime_type, 'image/'))
                                                                <div class="file-image">
                                                                    <img src="{{ asset('storage/' . $media->file_name) }}"
                                                                        class="file-preview"
                                                                        onclick="openImageModal('{{ asset('storage/' . $media->file_name) }}')"
                                                                        alt="{{ basename($media->file_name) }}">
                                                                    <span class="file-badge badge-image">Gambar</span>
                                                                </div>
                                                            @elseif($media->mime_type == 'application/pdf')
                                                                <div class="file-icon pdf-icon">
                                                                    <i class="bi bi-file-earmark-pdf"></i>
                                                                    <span class="file-badge badge-pdf">PDF</span>
                                                                </div>
                                                            @else
                                                                <div class="file-icon doc-icon">
                                                                    <i class="bi bi-file-earmark-text"></i>
                                                                    <span class="file-badge badge-doc">Dokumen</span>
                                                                </div>
                                                            @endif

                                                            @if ($media->caption)
                                                                <div class="file-caption">{{ $media->caption }}</div>
                                                            @else
                                                                <div class="file-name">
                                                                    {{ Str::limit(basename($media->file_name), 20) }}</div>
                                                            @endif

                                                            <div class="file-actions">
                                                                <a href="{{ asset('storage/' . $media->file_name) }}"
                                                                    target="_blank" class="file-action-btn view-btn">
                                                                    <i class="bi bi-eye"></i>
                                                                </a>
                                                                <a href="{{ route('pengaduan.download.media', [$pengaduan->pengaduan_id, $media->media_id]) }}"
                                                                    class="file-action-btn download-btn">
                                                                    <i class="bi bi-download"></i>
                                                                </a>
                                                                <form
                                                                    action="{{ route('pengaduan.destroy.media', [$pengaduan->pengaduan_id, $media->media_id]) }}"
                                                                    method="POST" class="d-inline"
                                                                    onsubmit="return confirm('Hapus file ini?')">
                                                                    @csrf @method('DELETE')
                                                                    <button type="submit"
                                                                        class="file-action-btn delete-btn">
                                                                        <i class="bi bi-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Action Buttons -->
                                <div class="form-section text-center mt-4">
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                            <i class="bi bi-check-circle me-2"></i>Update Pengaduan
                                        </button>
                                        <button type="reset" class="btn btn-outline-secondary btn-lg ms-2"
                                            id="resetBtn">
                                            <i class="bi bi-arrow-clockwise me-2"></i>Reset Form
                                        </button>
                                    </div>
                                    <div class="form-info mt-3">
                                        <p class="text-muted mb-0">
                                            <i class="bi bi-info-circle me-1"></i>
                                            Perubahan data pengaduan akan segera diperbarui dalam sistem.
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Edit Pengaduan Section -->

        <!-- Modal untuk gambar -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Preview Gambar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="modalImage" src="" class="img-fluid" alt="Preview">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        /* ===========================================
               STYLING EDIT PENGADUAN - KONSISTEN DENGAN LAINNYA
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
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid #fff3cd;
            box-shadow: 0 2px 8px rgba(255, 193, 7, 0.2);
            transition: all 0.3s ease;
        }

        .edit-header:hover .edit-icon-circle {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
        }

        .edit-icon {
            color: white;
            font-size: 1.8rem;
            transition: transform 0.3s ease;
        }

        .edit-header:hover .edit-icon {
            transform: rotate(-15deg);
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

        /* Badge Status (sama dengan show) */
        .badge.status-menunggu,
        .badge.status-diproses,
        .badge.status-selesai,
        .badge.status-ditolak {
            padding: 0.25rem 0.6rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.75rem;
            transition: all 0.3s ease;
        }

        .badge.status-menunggu {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .badge.status-diproses {
            background: #cce5ff;
            color: #004085;
            border: 1px solid #b8daff;
        }

        .badge.status-selesai {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .badge.status-ditolak {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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

        .form-control[readonly] {
            background-color: #f8f9fa;
            color: #6c757d;
            border-color: #e9ecef;
        }

        .form-control[readonly]:hover {
            border-color: #e9ecef;
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

        .form-control:focus+.form-icon,
        .form-select:focus+.form-icon {
            color: #175cdd;
            transform: translateY(-50%) scale(1.2);
        }

        /* File Input */
        .form-control[type="file"] {
            padding: 0.75rem 1rem 0.75rem 0.875rem;
        }

        .form-control[type="file"]+.form-icon {
            left: auto;
            right: 0.875rem;
        }

        /* Textarea */
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }

        /* Form Text */
        .form-text {
            font-size: 0.825rem;
            color: #6c757d;
            margin-top: 0.25rem;
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

        /* File Card Styling (sama dengan show) */
        .file-card {
            background: #fff;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .file-card:hover {
            border-color: #175cdd;
            box-shadow: 0 4px 12px rgba(23, 92, 221, 0.1);
            transform: translateY(-3px);
        }

        .file-image {
            position: relative;
            width: 100%;
            height: 100px;
            overflow: hidden;
            border-radius: 8px;
            margin-bottom: 0.75rem;
        }

        .file-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .file-card:hover .file-preview {
            transform: scale(1.05);
        }

        .file-icon {
            font-size: 2.5rem;
            margin-bottom: 0.75rem;
            color: #175cdd;
            transition: transform 0.3s ease;
        }

        .file-card:hover .file-icon {
            transform: scale(1.1);
        }

        .pdf-icon {
            color: #dc3545;
        }

        .doc-icon {
            color: #0d6efd;
        }

        .file-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            font-size: 0.6rem;
            padding: 0.2rem 0.5rem;
        }

        .badge-image {
            background: rgba(40, 167, 69, 0.9);
            color: white;
        }

        .badge-pdf {
            background: rgba(220, 53, 69, 0.9);
            color: white;
        }

        .badge-doc {
            background: rgba(13, 110, 253, 0.9);
            color: white;
        }

        .file-name,
        .file-caption {
            font-size: 0.8rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
            text-align: center;
            flex-grow: 1;
            word-break: break-all;
        }

        .file-actions {
            display: flex;
            gap: 0.5rem;
            width: 100%;
            justify-content: center;
        }

        .file-action-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #dee2e6;
            background: #fff;
            color: #6c757d;
            transition: all 0.3s ease;
            text-decoration: none;
            cursor: pointer;
        }

        .view-btn:hover {
            background: #175cdd;
            color: white;
            border-color: #175cdd;
        }

        .download-btn:hover {
            background: #28a745;
            color: white;
            border-color: #28a745;
        }

        .delete-btn:hover {
            background: #dc3545;
            color: white;
            border-color: #dc3545;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .edit-header {
                padding: 1rem;
            }

            .edit-title {
                font-size: 1.25rem;
            }

            .edit-icon-circle {
                width: 50px;
                height: 50px;
            }

            .edit-icon {
                font-size: 1.5rem;
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

            .form-actions {
                flex-direction: column;
            }

            .btn-primary,
            .btn-outline-secondary {
                width: 100%;
                justify-content: center;
            }

            .form-grid {
                gap: 1rem;
            }

            .col-md-6 {
                margin-bottom: 1rem;
            }

            .file-card {
                padding: 0.75rem;
            }

            .file-image {
                height: 80px;
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

            .col-lg-10 {
                padding: 0;
            }
        }
    </style>

    <script>
        function openImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        }

        // File size validation
        document.getElementById('files')?.addEventListener('change', function() {
            const maxSize = 10 * 1024 * 1024; // 10MB
            const files = this.files;

            for (let i = 0; i < files.length; i++) {
                if (files[i].size > maxSize) {
                    showToast(`File "${files[i].name}" melebihi ukuran maksimum 10MB`, 'error');
                    this.value = '';
                    return;
                }
            }
        });

        // Character counter for textarea
        document.getElementById('deskripsi')?.addEventListener('input', function() {
            const charCount = this.value.length;
            const maxChars = 5000;

            if (charCount > maxChars) {
                this.value = this.value.substring(0, maxChars);
                showToast('Deskripsi maksimal 5000 karakter', 'warning');
            }
        });

        // Character counter for judul
        document.getElementById('judul')?.addEventListener('input', function() {
            const charCount = this.value.length;
            const maxChars = 100;

            if (charCount > maxChars) {
                this.value = this.value.substring(0, maxChars);
                showToast('Judul maksimal 100 karakter', 'warning');
            }
        });

        // Form validation with minimal interference
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const submitBtn = document.getElementById('submitBtn');
            const resetBtn = document.getElementById('resetBtn');

            // Simple validation before submit
            form.addEventListener('submit', function(e) {
                // Validate required fields
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.style.borderColor = '#dc3545';
                        field.style.boxShadow = '0 0 0 0.25rem rgba(220, 53, 69, 0.25)';
                        isValid = false;

                        // Focus on first invalid field
                        if (isValid === false) {
                            field.focus();
                        }
                    } else {
                        field.style.borderColor = '#dee2e6';
                        field.style.boxShadow = '';
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    showToast('Harap lengkapi semua field yang wajib diisi', 'error');
                    return;
                }

                // Validate SLA for kategori if exists
                const kategoriSelect = document.getElementById('kategori_id');
                if (kategoriSelect) {
                    const selectedOption = kategoriSelect.options[kategoriSelect.selectedIndex];
                    if (selectedOption.text.includes('SLA:')) {
                        // Extract SLA number from option text
                        const slaMatch = selectedOption.text.match(/SLA:\s*(\d+)/);
                        if (slaMatch) {
                            const slaDays = parseInt(slaMatch[1]);
                            if (slaDays < 1 || slaDays > 30) {
                                e.preventDefault();
                                showToast('SLA harus antara 1-30 hari', 'error');
                                return;
                            }
                        }
                    }
                }

                // Show loading state
                if (submitBtn) {
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i> Memproses...';
                    submitBtn.disabled = true;

                    // Allow form to submit naturally
                    // If form doesn't submit in 10 seconds, re-enable button
                    setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }, 10000);
                }
            });

            // Reset button functionality
            if (resetBtn) {
                resetBtn.addEventListener('click', function() {
                    // Clear validation styles
                    const fields = form.querySelectorAll('.form-control, .form-select');
                    fields.forEach(field => {
                        field.style.borderColor = '';
                        field.style.boxShadow = '';
                    });

                    showToast('Form telah direset', 'info');
                });
            }

            // Real-time validation feedback
            const inputs = form.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.hasAttribute('required') && !this.value.trim()) {
                        this.style.borderColor = '#dc3545';
                        this.style.boxShadow = '0 0 0 0.25rem rgba(220, 53, 69, 0.25)';
                    } else if (this.value.trim()) {
                        this.style.borderColor = '#198754';
                        this.style.boxShadow = '0 0 0 0.25rem rgba(25, 135, 84, 0.25)';
                        setTimeout(() => {
                            this.style.borderColor = '';
                            this.style.boxShadow = '';
                        }, 1000);
                    }
                });
            });

            // Helper function to show toast
            function showToast(message, type = 'info') {
                // Remove existing toast
                const existingToast = document.querySelector('.custom-toast');
                if (existingToast) {
                    existingToast.remove();
                }

                // Create toast element
                const toast = document.createElement('div');
                toast.className = `custom-toast`;
                toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 12px 20px;
                border-radius: 8px;
                color: white;
                font-weight: 500;
                z-index: 9999;
                animation: slideIn 0.3s ease;
                display: flex;
                align-items: center;
                gap: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            `;

                // Set background color based on type
                if (type === 'error') {
                    toast.style.background = '#dc3545';
                    toast.innerHTML = `<i class="bi bi-exclamation-circle"></i> ${message}`;
                } else if (type === 'warning') {
                    toast.style.background = '#ffc107';
                    toast.style.color = '#212529';
                    toast.innerHTML = `<i class="bi bi-exclamation-triangle"></i> ${message}`;
                } else if (type === 'success') {
                    toast.style.background = '#198754';
                    toast.innerHTML = `<i class="bi bi-check-circle"></i> ${message}`;
                } else {
                    toast.style.background = '#0d6efd';
                    toast.innerHTML = `<i class="bi bi-info-circle"></i> ${message}`;
                }

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
