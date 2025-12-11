@extends('layouts.guest.app')

@section('title', 'Edit Pengaduan - Bina Desa')

@section('content')
    <main class="main">
        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Edit Pengaduan</h1>
                            <p class="mb-0">
                                Update data pengaduan yang telah diajukan. Pastikan informasi yang diubah akurat dan
                                lengkap.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('pengaduan.index') }}">Data Pengaduan</a></li>
                        <li class="current">Edit Pengaduan</li>
                    </ol>
                </div>
            </nav>
        </div>

        <!-- Edit Pengaduan Section -->
        <section id="pengaduan" class="appointmnet section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="booking-wrapper">
                            <div class="booking-header text-center" data-aos="fade-up" data-aos-delay="200">
                                <h2>Form Edit Pengaduan</h2>
                                <p>Perbarui data pengaduan untuk memastikan penanganan yang tepat dan cepat.</p>
                            </div>

                            <div class="appointment-form" data-aos="fade-up" data-aos-delay="300">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form action="{{ route('pengaduan.update', $pengaduan->pengaduan_id) }}" method="POST"
                                    class="php-email-form" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row gy-4">
                                        <!-- No Tiket (Readonly) -->
                                        <div class="col-12">
                                            <label class="form-label">No Tiket</label>
                                            <input type="text" class="form-control" value="{{ $pengaduan->nomor_tiket }}"
                                                readonly>
                                            <small class="text-muted">No tiket tidak dapat diubah</small>
                                        </div>

                                        <!-- Nama Warga (Readonly) -->
                                        <div class="col-12">
                                            <label class="form-label">Nama Warga</label>
                                            <input type="text" class="form-control"
                                                value="{{ $pengaduan->warga->nama }} - {{ $pengaduan->warga->no_ktp }}"
                                                readonly>
                                        </div>

                                        <!-- Judul Pengaduan -->
                                        <div class="col-12">
                                            <label for="judul" class="form-label">Judul Pengaduan *</label>
                                            <input type="text" name="judul" class="form-control"
                                                value="{{ old('judul', $pengaduan->judul) }}"
                                                placeholder="Contoh: Jalan Rusak di RT 05" required>
                                        </div>

                                        <!-- Kategori -->
                                        <div class="col-12">
                                            <label for="kategori_id" class="form-label">Kategori *</label>
                                            <select name="kategori_id" class="form-select" required>
                                                <option value="">Pilih Kategori</option>
                                                @foreach ($kategori as $kat)
                                                    <option value="{{ $kat->kategori_id }}"
                                                        {{ old('kategori_id', $pengaduan->kategori_id) == $kat->kategori_id ? 'selected' : '' }}>
                                                        {{ $kat->nama }} - SLA: {{ $kat->sla_hari }} hari
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Lokasi Kejadian -->
                                        <div class="col-12">
                                            <label for="lokasi_text" class="form-label">Lokasi Kejadian *</label>
                                            <input type="text" name="lokasi_text" class="form-control"
                                                value="{{ old('lokasi_text', $pengaduan->lokasi_text) }}"
                                                placeholder="Contoh: Jl. Merdeka No. 10, RT 05/RW 02" required>
                                        </div>

                                        <!-- RT & RW -->
                                        <div class="col-md-6">
                                            <label for="rt" class="form-label">RT *</label>
                                            <input type="text" name="rt" class="form-control"
                                                value="{{ old('rt', $pengaduan->rt) }}" placeholder="Contoh: 001" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="rw" class="form-label">RW *</label>
                                            <input type="text" name="rw" class="form-control"
                                                value="{{ old('rw', $pengaduan->rw) }}" placeholder="Contoh: 002" required>
                                        </div>

                                        <!-- Deskripsi -->
                                        <div class="col-12">
                                            <label for="deskripsi" class="form-label">Deskripsi Pengaduan *</label>
                                            <textarea name="deskripsi" class="form-control" rows="6" placeholder="Jelaskan detail pengaduan Anda..." required>{{ old('deskripsi', $pengaduan->deskripsi) }}</textarea>
                                        </div>

                                        <!-- Status -->
                                        <div class="col-12">
                                            <label for="status" class="form-label">Status *</label>
                                            <select name="status" class="form-select" required>
                                                <option value="menunggu"
                                                    {{ old('status', $pengaduan->status) == 'menunggu' ? 'selected' : '' }}>
                                                    Menunggu</option>
                                                <option value="diproses"
                                                    {{ old('status', $pengaduan->status) == 'diproses' ? 'selected' : '' }}>
                                                    Diproses</option>
                                                <option value="selesai"
                                                    {{ old('status', $pengaduan->status) == 'selesai' ? 'selected' : '' }}>
                                                    Selesai</option>
                                                <option value="ditolak"
                                                    {{ old('status', $pengaduan->status) == 'ditolak' ? 'selected' : '' }}>
                                                    Ditolak</option>
                                            </select>
                                        </div>

                                        <!-- TAMBAH: Upload File Baru -->
                                        <div class="col-12">
                                            <div class="card border-warning mt-3">
                                                <div class="card-header bg-warning">
                                                    <h5 class="mb-0">
                                                        <i class="bi bi-plus-circle"></i> Tambah File Baru
                                                        <small class="text-dark">(File lama tetap tersimpan)</small>
                                                    </h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <label for="files" class="form-label">Pilih File</label>
                                                        <input type="file" name="files[]" id="files"
                                                            class="form-control" multiple
                                                            accept="image/*,.pdf,.doc,.docx,.xlsx">
                                                        <div class="form-text">
                                                            Format: JPG, PNG, PDF, DOC, XLSX. Max 10MB per file.
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Keterangan File Baru</label>
                                                        <textarea name="caption" class="form-control" rows="2" placeholder="Keterangan untuk file baru"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn-book">Update Pengaduan</button>
                                            <a href="{{ route('pengaduan.index') }}"
                                                class="btn btn-secondary mt-2">Kembali</a>
                                        </div>
                                    </div>
                                </form>

                                <!-- TAMBAH: Tampilkan File yang sudah ada (di luar form) -->
                                @if (isset($mediaFiles) && $mediaFiles->count() > 0)
                                    <div class="mt-4">
                                        <div class="card">
                                            <div class="card-header bg-info text-white">
                                                <h5 class="mb-0"><i class="bi bi-files"></i> File Terupload
                                                    ({{ $mediaFiles->count() }})</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    @foreach ($mediaFiles as $media)
                                                        <div class="col-md-6 col-lg-4 mb-3">
                                                            <div class="card h-100">
                                                                @if (str_starts_with($media->mime_type, 'image/'))
                                                                    <img src="{{ asset('storage/' . $media->caption) }}"
                                                                        class="card-img-top"
                                                                        style="height: 120px; object-fit: cover;">
                                                                @else
                                                                    <div class="card-body text-center py-3">
                                                                        @if ($media->mime_type == 'application/pdf')
                                                                            <i
                                                                                class="bi bi-file-earmark-pdf text-danger fa-2x"></i>
                                                                        @else
                                                                            <i
                                                                                class="bi bi-file-earmark text-secondary fa-2x"></i>
                                                                        @endif
                                                                        <p class="small mt-2 mb-0">
                                                                            {{ basename($media->file_name) }}</p>
                                                                    </div>
                                                                @endif
                                                                <div class="card-footer text-center">
                                                                    <a href="{{ route('pengaduan.download.media', [$pengaduan->pengaduan_id, $media->media_id]) }}"
                                                                        class="btn btn-sm btn-outline-success">
                                                                        <i class="bi bi-download"></i>
                                                                    </a>
                                                                    <form
                                                                        action="{{ route('pengaduan.destroy.media', [$pengaduan->pengaduan_id, $media->media_id]) }}"
                                                                        method="POST" class="d-inline"
                                                                        onsubmit="return confirm('Hapus file ini?')">
                                                                        @csrf @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-sm btn-outline-danger">
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
                                <p><i class="bi bi-info-circle"></i> Perubahan data pengaduan akan segera diperbarui dalam
                                    sistem. Pastikan informasi yang diubah sudah benar.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
