@extends('layouts.guest.app')

@section('title', 'Tambah Tindak Lanjut - Bina Desa')

@section('content')

    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Tambah Tindak Lanjut</h1>
                            <p class="mb-0">
                                Catat tindak lanjut dari pengaduan warga untuk memastikan penanganan yang tepat.
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
                        <li class="current">Tambah Tindak Lanjut</li>
                    </ol>
                </div>
            </nav>
        </div>
        <!-- End Page Title -->

        <!-- Tindak Lanjut Section -->
        <section id="tindak-lanjut" class="appointmnet section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="booking-wrapper">

                            <div class="booking-header text-center" data-aos="fade-up" data-aos-delay="200">
                                <h2>Form Tindak Lanjut</h2>
                                <p>Isi data dengan lengkap untuk mencatat tindakan yang telah dilakukan.</p>
                            </div>

                            <div class="appointment-form" data-aos="fade-up" data-aos-delay="300">

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                {{-- ⭐⭐ TAMBAH: enctype="multipart/form-data" ⭐⭐ --}}
                                <form action="{{ route('tindak_lanjut.store') }}" method="POST" class="php-email-form"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row gy-4">

                                        <div class="col-12">
                                            <label for="pengaduan_id" class="form-label">Pilih Pengaduan *</label>
                                            <select name="pengaduan_id" class="form-select" required>
                                                <option value="">Pilih Pengaduan</option>
                                                @foreach ($pengaduan as $item)
                                                    <option value="{{ $item->pengaduan_id }}">
                                                        {{ $item->nomor_tiket }} - {{ Str::limit($item->judul, 50) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted">Hanya menampilkan pengaduan dengan status 'menunggu'
                                                atau 'diproses'</small>
                                        </div>

                                        <div class="col-12">
                                            <label for="petugas" class="form-label">Nama Petugas *</label>
                                            <input type="text" name="petugas" class="form-control"
                                                placeholder="Contoh: Budi Santoso" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="aksi" class="form-label">Aksi yang Dilakukan *</label>
                                            <textarea name="aksi" class="form-control" rows="4" placeholder="Jelaskan tindakan yang telah dilakukan..."
                                                required></textarea>
                                        </div>

                                        <div class="col-12">
                                            <label for="catatan" class="form-label">Catatan Tambahan</label>
                                            <textarea name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                                        </div>

                                        {{-- ⭐⭐ TAMBAH: SECTION UPLOAD FILE ⭐⭐ --}}
                                        <div class="col-12">
                                            <div class="card border-warning mt-3">
                                                <div class="card-header bg-warning">
                                                    <h5 class="mb-0">
                                                        <i class="bi bi-plus-circle"></i> Upload Dokumentasi
                                                        <small class="text-dark">(Opsional, bisa lebih dari satu)</small>
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
                                                        <label class="form-label">Keterangan File</label>
                                                        <textarea name="caption" class="form-control" rows="2"
                                                            placeholder="Keterangan untuk semua file (misal: Foto kondisi, Laporan teknis, dll)"></textarea>
                                                    </div>

                                                    {{-- Preview file yang dipilih --}}
                                                    <div id="file-preview" class="mt-3"></div>

                                                    <script>
                                                        document.getElementById('files').addEventListener('change', function(e) {
                                                            const preview = document.getElementById('file-preview');
                                                            preview.innerHTML = '';

                                                            if (e.target.files.length > 0) {
                                                                let html = '<div class="alert alert-light"><h6>File yang akan diupload:</h6><ul class="mb-0">';

                                                                Array.from(e.target.files).forEach((file, index) => {
                                                                    html += `
                                                                        <li class="d-flex justify-content-between align-items-center mb-2">
                                                                            <div>
                                                                                <span class="badge bg-secondary me-2">${index + 1}</span>
                                                                                ${file.name}
                                                                                <br>
                                                                                <small class="text-muted">
                                                                                    <i class="bi bi-file-earmark"></i> ${file.type} •
                                                                                    ${(file.size/1024).toFixed(2)} KB
                                                                                </small>
                                                                            </div>
                                                                        </li>`;
                                                                });

                                                                html += '</ul></div>';
                                                                preview.innerHTML = html;
                                                            }
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- ⭐⭐ END OF UPLOAD SECTION ⭐⭐ --}}

                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn-book">Simpan Tindak Lanjut</button>
                                            <a href="{{ route('tindak_lanjut.index') }}"
                                                class="btn btn-secondary mt-2">Kembali</a>
                                        </div>

                                    </div>
                                </form>
                            </div>

                            <div class="emergency-info text-center mt-4" data-aos="fade-up" data-aos-delay="400">
                                <p><i class="bi bi-info-circle"></i> Setelah menyimpan tindak lanjut, status pengaduan akan
                                    otomatis berubah menjadi 'diproses'.</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Tindak Lanjut Section -->

    </main>

@endsection
