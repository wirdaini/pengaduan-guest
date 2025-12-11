@extends('layouts.guest.app')

@section('title', 'Detail Tindak Lanjut - Bina Desa')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Detail Tindak Lanjut</h1>
                            <p class="mb-0">Informasi lengkap tentang tindak lanjut pengaduan</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('tindak_lanjut.index') }}">Data Tindak Lanjut</a></li>
                        <li class="current">Detail Tindak Lanjut</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Detail Tindak Lanjut Section -->
        <section id="detail-tindak-lanjut" class="detail-tindak-lanjut section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-lg-10">

                        <div class="card shadow-sm">
                            <div class="card-header"
                                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                <h4 class="card-title mb-0">
                                    <i class="fas fa-clipboard-check me-2"></i>Informasi Tindak Lanjut
                                </h4>
                            </div>
                            <div class="card-body">
                                <!-- Action Buttons -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('tindak_lanjut.edit', $tindakLanjut->tindak_id) }}"
                                                class="btn btn-warning">
                                                <i class="fas fa-edit me-2"></i>Edit Tindak Lanjut
                                            </a>
                                            <a href="{{ route('tindak_lanjut.index') }}" class="btn btn-secondary">
                                                <i class="fas fa-arrow-left me-2"></i>Kembali
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Kolom Kiri - Informasi Tindak Lanjut -->
                                    <div class="col-md-6">
                                        <div class="info-section mb-4">
                                            <h5 class="section-title" style="color: #667eea;">
                                                <i class="fas fa-user-tie me-2"></i>Informasi Petugas
                                            </h5>
                                            <div class="info-item">
                                                <label class="fw-bold">Nama Petugas</label>
                                                <p class="info-value">{{ $tindakLanjut->petugas }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Tanggal Tindak Lanjut</label>
                                                <p class="info-value">
                                                    {{ $tindakLanjut->created_at->format('d/m/Y H:i') }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="info-section mb-4">
                                            <h5 class="section-title" style="color: #667eea;">
                                                <i class="fas fa-clipboard-list me-2"></i>Informasi Pengaduan
                                            </h5>
                                            <div class="info-item">
                                                <label class="fw-bold">No Tiket</label>
                                                <p class="info-value">{{ $tindakLanjut->pengaduan->nomor_tiket }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Judul Pengaduan</label>
                                                <p class="info-value">{{ $tindakLanjut->pengaduan->judul }}</p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Status Pengaduan</label>
                                                <p class="info-value">
                                                    @if ($tindakLanjut->pengaduan->status == 'menunggu')
                                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                                    @elseif($tindakLanjut->pengaduan->status == 'diproses')
                                                        <span class="badge bg-primary">Diproses</span>
                                                    @elseif($tindakLanjut->pengaduan->status == 'selesai')
                                                        <span class="badge bg-success">Selesai</span>
                                                    @elseif($tindakLanjut->pengaduan->status == 'ditolak')
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan - Aksi & Catatan -->
                                    <div class="col-md-6">
                                        <div class="info-section mb-4">
                                            <h5 class="section-title" style="color: #667eea;">
                                                <i class="fas fa-tasks me-2"></i>Detail Tindakan
                                            </h5>
                                            <div class="info-item">
                                                <label class="fw-bold">Aksi yang Dilakukan</label>
                                                <div class="description-box p-3 bg-light rounded">
                                                    <p class="mb-0">{{ $tindakLanjut->aksi }}</p>
                                                </div>
                                            </div>
                                            @if ($tindakLanjut->catatan)
                                                <div class="info-item">
                                                    <label class="fw-bold">Catatan Tambahan</label>
                                                    <div class="description-box p-3 bg-light rounded">
                                                        <p class="mb-0">{{ $tindakLanjut->catatan }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="info-section mb-4">
                                            <h5 class="section-title" style="color: #667eea;">
                                                <i class="fas fa-history me-2"></i>Riwayat Sistem
                                            </h5>
                                            <div class="info-item">
                                                <label class="fw-bold">Dibuat Pada</label>
                                                <p class="info-value">
                                                    {{ $tindakLanjut->created_at->format('d/m/Y H:i') }}
                                                </p>
                                            </div>
                                            <div class="info-item">
                                                <label class="fw-bold">Terakhir Diupdate</label>
                                                <p class="info-value">
                                                    {{ $tindakLanjut->updated_at->format('d/m/Y H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Info Warga -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="info-section">
                                            <h5 class="section-title" style="color: #667eea;">
                                                <i class="fas fa-user me-2"></i>Informasi Warga
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="info-item">
                                                        <label class="fw-bold">Nama Warga</label>
                                                        <p class="info-value">{{ $tindakLanjut->pengaduan->warga->nama }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="info-item">
                                                        <label class="fw-bold">NIK</label>
                                                        <p class="info-value">
                                                            {{ $tindakLanjut->pengaduan->warga->no_ktp }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="info-item">
                                                        <label class="fw-bold">Telepon</label>
                                                        <p class="info-value">{{ $tindakLanjut->pengaduan->warga->telp }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAMBAH: Section File Upload -->
                        @if ($mediaFiles && $mediaFiles->count() > 0)
                            <div class="card shadow-sm mt-4">
                                <div class="card-header"
                                    style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white;">
                                    <h4 class="card-title mb-0">
                                        <i class="fas fa-paperclip me-2"></i>Dokumentasi Tindak Lanjut
                                        <span class="badge bg-light text-dark ms-2">{{ $mediaFiles->count() }} file</span>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($mediaFiles as $media)
                                            <div class="col-md-4 col-lg-3 mb-4">
                                                <div class="card h-100 border-0 shadow-sm">
                                                    @if (str_starts_with($media->mime_type, 'image/'))
                                                        <!-- File Gambar -->
                                                        <div class="position-relative">
                                                            <img src="{{ asset('storage/' . $media->file_name) }}"
                                                                class="card-img-top"
                                                                style="height: 180px; object-fit: cover; border-radius: 8px 8px 0 0;"
                                                                alt="{{ $media->caption }}"
                                                                onclick="openImageModal('{{ asset('storage/' . $media->file_name) }}')"
                                                                style="cursor: pointer">
                                                            <div class="position-absolute top-0 end-0 m-2">
                                                                <span class="badge bg-success">Gambar</span>
                                                            </div>
                                                        </div>
                                                    @elseif($media->mime_type == 'application/pdf')
                                                        <!-- File PDF -->
                                                        <div class="card-body text-center py-4">
                                                            <div class="pdf-icon mb-3">
                                                                <i class="fas fa-file-pdf fa-4x text-danger"></i>
                                                            </div>
                                                            <h6 class="card-title text-truncate">
                                                                {{ basename($media->file_name) }}</h6>
                                                            <span class="badge bg-danger mt-2">PDF</span>
                                                        </div>
                                                    @else
                                                        <!-- File Dokumen Lain -->
                                                        <div class="card-body text-center py-4">
                                                            <div class="file-icon mb-3">
                                                                <i class="fas fa-file fa-4x text-primary"></i>
                                                            </div>
                                                            <h6 class="card-title text-truncate">
                                                                {{ basename($media->file_name) }}</h6>
                                                            <span class="badge bg-secondary mt-2">Dokumen</span>
                                                        </div>
                                                    @endif

                                                    <div class="card-footer bg-white border-top-0">
                                                        @if ($media->file_name)
                                                            <p class="small text-muted mb-2 text-center">
                                                                <i class="fas fa-comment me-1"></i>{{ $media->file_name }}
                                                            </p>
                                                        @endif

                                                        <div class="d-flex justify-content-center gap-2">
                                                            <a href="{{ asset('storage/' . $media->file_name) }}"
                                                                target="_blank" class="btn btn-sm btn-outline-primary"
                                                                title="Lihat File">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('tindak_lanjut.download.media', [$tindakLanjut->tindak_id, $media->media_id]) }}"
                                                                class="btn btn-sm btn-outline-success" title="Download">
                                                                <i class="fas fa-download"></i>
                                                            </a>
                                                            @if (auth()->check())
                                                                <form
                                                                    action="{{ route('tindak_lanjut.destroy.media', [$tindakLanjut->tindak_id, $media->media_id]) }}"
                                                                    method="POST" class="d-inline"
                                                                    onsubmit="return confirm('Hapus file ini?')">
                                                                    @csrf @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-outline-danger"
                                                                        title="Hapus">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Jika belum ada file -->
                            <div class="card shadow-sm mt-4">
                                <div class="card-header"
                                    style="background: linear-gradient(135deg, #6c757d 0%, #adb5bd 100%); color: white;">
                                    <h4 class="card-title mb-0">
                                        <i class="fas fa-paperclip me-2"></i>Dokumentasi Tindak Lanjut
                                    </h4>
                                </div>
                                <div class="card-body text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum Ada Dokumentasi</h5>
                                        <p class="text-muted mb-4">Belum ada file yang diupload untuk tindak lanjut ini</p>
                                        <a href="{{ route('tindak_lanjut.edit', $tindakLanjut->tindak_id) }}"
                                            class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Tambah File
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </section><!-- /Detail Tindak Lanjut Section -->

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
        .info-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            border-left: 4px solid #667eea;
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

        .description-box {
            background: #f8f9fa !important;
            border: 1px solid #e9ecef;
            border-radius: 8px;
        }

        .empty-state {
            max-width: 300px;
            margin: 0 auto;
        }

        .pdf-icon,
        .file-icon {
            transition: transform 0.3s;
        }

        .pdf-icon:hover,
        .file-icon:hover {
            transform: scale(1.1);
        }
    </style>

    <script>
        function openImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        }
    </script>
@endsection
