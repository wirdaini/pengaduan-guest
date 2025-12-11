@extends('layouts.guest.app')

@section('title', 'Edit Tindak Lanjut - Bina Desa')

@section('content')

    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Edit Tindak Lanjut</h1>
                            <p class="mb-0">
                                Update data tindak lanjut yang telah dicatat. Pastikan informasi yang diubah akurat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('tindak_lanjut.index') }}">Data Tindak Lanjut</a></li>
                        <li class="current">Edit Tindak Lanjut</li>
                    </ol>
                </div>
            </nav>
        </div>
        <!-- End Page Title -->

        <!-- Edit Tindak Lanjut Section -->
        <section id="tindak-lanjut" class="appointmnet section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="booking-wrapper">

                            <div class="booking-header text-center" data-aos="fade-up" data-aos-delay="200">
                                <h2>Form Edit Tindak Lanjut</h2>
                                <p>Perbarui data tindak lanjut untuk memastikan pencatatan yang tepat.</p>
                            </div>

                            <div class="appointment-form" data-aos="fade-up" data-aos-delay="300">

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form action="{{ route('tindak_lanjut.update', $tindakLanjut->tindak_id) }}" method="POST"
                                    class="php-email-form" enctype="multipart/form-data"> <!-- TAMBAH: enctype -->
                                    @csrf
                                    @method('PUT')

                                    <div class="row gy-4">

                                        <!-- Pengaduan (Readonly) -->
                                        <div class="col-12">
                                            <label class="form-label">Pengaduan</label>
                                            <input type="text" class="form-control"
                                                value="{{ $tindakLanjut->pengaduan->nomor_tiket }} - {{ $tindakLanjut->pengaduan->judul }}"
                                                readonly>
                                            <small class="text-muted">Pengaduan tidak dapat diubah</small>
                                        </div>

                                        <!-- Petugas -->
                                        <div class="col-12">
                                            <label for="petugas" class="form-label">Nama Petugas *</label>
                                            <input type="text" name="petugas" class="form-control"
                                                value="{{ old('petugas', $tindakLanjut->petugas) }}"
                                                placeholder="Contoh: Budi Santoso" required>
                                        </div>

                                        <!-- Aksi -->
                                        <div class="col-12">
                                            <label for="aksi" class="form-label">Aksi yang Dilakukan *</label>
                                            <textarea name="aksi" class="form-control" rows="4" placeholder="Jelaskan tindakan yang telah dilakukan..." required>{{ old('aksi', $tindakLanjut->aksi) }}</textarea>
                                        </div>

                                        <!-- Catatan -->
                                        <div class="col-12">
                                            <label for="catatan" class="form-label">Catatan Tambahan</label>
                                            <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan jika diperlukan...">{{ old('catatan', $tindakLanjut->catatan) }}</textarea>
                                        </div>

                                        <!-- TAMBAH: Upload File Baru -->
                                        <div class="col-12">
                                            <div class="card border-warning mt-3">
                                                <div class="card-header bg-warning">
                                                    <h5 class="mb-0">
                                                        <i class="bi bi-plus-circle"></i> Tambah File Baru
                                                        <small class="text-dark">(Opsional, bisa lebih dari satu)</small>
                                                    </h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label for="files" class="form-label">Pilih File</label>
                                                        <input type="file"
                                                               name="files[]"
                                                               id="files"
                                                               class="form-control"
                                                               multiple
                                                               accept="image/*,.pdf,.doc,.docx,.xlsx">
                                                        <div class="form-text">
                                                            Format: JPG, PNG, PDF, DOC, XLSX. Max 10MB per file.
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Keterangan File</label>
                                                        <textarea name="caption"
                                                                  class="form-control"
                                                                  rows="2"
                                                                  placeholder="Keterangan untuk file baru"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn-book">Update Tindak Lanjut</button>
                                            <a href="{{ route('tindak_lanjut.index') }}"
                                                class="btn btn-secondary mt-2">Kembali</a>
                                        </div>
                                    </div>
                                </form>

                                <!-- TAMBAH: Tampilkan File yang sudah ada (di luar form) -->
                                @if(isset($mediaFiles) && $mediaFiles->count() > 0)
                                <div class="mt-4">
                                    <div class="card">
                                        <div class="card-header bg-info text-white">
                                            <h5 class="mb-0"><i class="bi bi-files"></i> File Terupload ({{ $mediaFiles->count() }})</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach($mediaFiles as $media)
                                                <div class="col-md-6 col-lg-4 mb-3">
                                                    <div class="card h-100">
                                                        @if(str_starts_with($media->mime_type, 'image/'))
                                                            <img src="{{ asset('storage/' . $media->file_name) }}"
                                                                 class="card-img-top"
                                                                 style="height: 120px; object-fit: cover;">
                                                        @else
                                                            <div class="card-body text-center py-3">
                                                                @if($media->mime_type == 'application/pdf')
                                                                    <i class="bi bi-file-earmark-pdf text-danger fa-2x"></i>
                                                                @else
                                                                    <i class="bi bi-file-earmark text-secondary fa-2x"></i>
                                                                @endif
                                                                <p class="small mt-2 mb-0">{{ basename($media->file_name) }}</p>
                                                            </div>
                                                        @endif
                                                        <div class="card-footer text-center">
                                                            <a href="{{ route('tindak_lanjut.download.media', [$tindakLanjut->tindak_id, $media->media_id]) }}"
                                                               class="btn btn-sm btn-outline-success">
                                                                <i class="bi bi-download"></i>
                                                            </a>
                                                            <form action="{{ route('tindak_lanjut.destroy.media', [$tindakLanjut->tindak_id, $media->media_id]) }}"
                                                                  method="POST"
                                                                  class="d-inline"
                                                                  onsubmit="return confirm('Hapus file ini?')">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                            </div>

                            <div class="emergency-info text-center mt-4" data-aos="fade-up" data-aos-delay="400">
                                <p><i class="bi bi-info-circle"></i> Perubahan data tindak lanjut akan segera diperbarui dalam sistem.</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Edit Tindak Lanjut Section -->

    </main>

@endsection
