@extends('layouts.app')

@section('title', 'Edit Pengaduan')

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
                            Update data pengaduan yang telah diajukan.
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
    </div><!-- End Page Title -->

    <!-- Edit Pengaduan Section -->
    <section id="edit-pengaduan" class="edit-pengaduan section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('pengaduan.update', $pengaduan->pengaduan_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row gy-4">
                            <div class="col-12">
                                <label class="form-label">No Tiket</label>
                                <input type="text" class="form-control" value="{{ $pengaduan->nomon_tiket }}" readonly>
                                <small class="text-muted">No tiket tidak dapat diubah</small>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Nama Warga</label>
                                <input type="text" class="form-control" value="{{ $pengaduan->warga->nama }} - {{ $pengaduan->warga->no_ktp }}" readonly>
                            </div>

                            <div class="col-12">
                                <label for="judul" class="form-label">Judul Pengaduan *</label>
                                <input type="text" name="judul" class="form-control"
                                       value="{{ old('judul', $pengaduan->judul) }}" required>
                            </div>

                            <div class="col-12">
                                <label for="kategori" class="form-label">Kategori *</label>
                                <select name="kategori" class="form-select" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Infrastruktur" {{ old('kategori', $pengaduan->kategori) == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                                    <option value="Lingkungan" {{ old('kategori', $pengaduan->kategori) == 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                                    <option value="Kesehatan" {{ old('kategori', $pengaduan->kategori) == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                    <option value="Keamanan" {{ old('kategori', $pengaduan->kategori) == 'Keamanan' ? 'selected' : '' }}>Keamanan</option>
                                    <option value="Lainnya" {{ old('kategori', $pengaduan->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="lokasi_text" class="form-label">Lokasi Kejadian *</label>
                                <input type="text" name="lokasi_text" class="form-control"
                                       value="{{ old('lokasi_text', $pengaduan->lokasi_text) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="rt" class="form-label">RT *</label>
                                <input type="text" name="rt" class="form-control"
                                       value="{{ old('rt', $pengaduan->rt) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="rw" class="form-label">RW *</label>
                                <input type="text" name="rw" class="form-control"
                                       value="{{ old('rw', $pengaduan->rw) }}" required>
                            </div>

                            <div class="col-12">
                                <label for="deskripsi" class="form-label">Deskripsi Pengaduan *</label>
                                <textarea name="deskripsi" class="form-control" rows="6" required>{{ old('deskripsi', $pengaduan->deskripsi) }}</textarea>
                            </div>

                            <div class="col-12">
                                <label for="status" class="form-label">Status *</label>
                                <select name="status" class="form-select" required>
                                    <option value="menunggu" {{ old('status', $pengaduan->status) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="diproses" {{ old('status', $pengaduan->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="selesai" {{ old('status', $pengaduan->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="ditolak" {{ old('status', $pengaduan->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update Pengaduan</button>
                                <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /Edit Pengaduan Section -->

</main>
@endsection
