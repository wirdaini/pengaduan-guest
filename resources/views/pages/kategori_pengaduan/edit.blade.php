@extends('layouts.guest.app')

@section('title', 'Edit Kategori Pengaduan - Bina Desa')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Edit Kategori Pengaduan</h1>
                            <p class="mb-0">
                                Update data kategori pengaduan. Perubahan akan mempengaruhi klasifikasi pengaduan warga.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('kategori_pengaduan.index') }}">Kategori Pengaduan</a></li>
                        <li class="current">Edit Kategori</li>
                    </ol>
                </div>
            </nav>
        </div>
        <!-- End Page Title -->

        <!-- Edit Kategori Pengaduan Section -->
        <section id="kategori_pengaduan" class="appointmnet section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="booking-wrapper">

                            <div class="booking-header text-center" data-aos="fade-up" data-aos-delay="200">
                                <h2>Form Edit Kategori Pengaduan</h2>
                                <p>Perbarui data kategori untuk memastikan klasifikasi dan penanganan yang tepat.</p>
                            </div>

                            <div class="appointment-form" data-aos="fade-up" data-aos-delay="300">

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('kategori_pengaduan.update', $kategori->kategori_id) }}" method="POST" class="php-email-form">
                                    @csrf
                                    @method('PUT')

                                    <div class="row gy-4">

                                        <div class="col-12">
                                            <label for="nama" class="form-label">Nama Kategori *</label>
                                            <input type="text" name="nama" class="form-control"
                                                placeholder="Contoh: Infrastruktur Jalan"
                                                value="{{ old('nama', $kategori->nama) }}" required>
                                            <small class="text-muted">Nama kategori yang akan ditampilkan di form pengaduan</small>
                                        </div>

                                        <div class="col-12">
                                            <label for="sla_hari" class="form-label">SLA (Hari) *</label>
                                            <input type="number" name="sla_hari" class="form-control"
                                                placeholder="Contoh: 7"
                                                value="{{ old('sla_hari', $kategori->sla_hari) }}" min="1" max="30" required>
                                            <small class="text-muted">Service Level Agreement - Target penyelesaian dalam hari (1-30 hari)</small>
                                        </div>

                                        <div class="col-12">
                                            <label for="prioritas" class="form-label">Prioritas *</label>
                                            <select name="prioritas" class="form-select" required>
                                                <option value="">Pilih Prioritas</option>
                                                <option value="Rendah" {{ old('prioritas', $kategori->prioritas) == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                                                <option value="Sedang" {{ old('prioritas', $kategori->prioritas) == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                                <option value="Tinggi" {{ old('prioritas', $kategori->prioritas) == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                                                <option value="Kritis" {{ old('prioritas', $kategori->prioritas) == 'Kritis' ? 'selected' : '' }}>Kritis</option>
                                            </select>
                                            <small class="text-muted">Tingkat urgensi penanganan pengaduan</small>
                                        </div>

                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn-book">Update Kategori</button>
                                            <a href="{{ route('kategori_pengaduan.index') }}"
                                                class="btn btn-secondary mt-2">Kembali ke Daftar</a>
                                        </div>

                                    </div>
                                </form>
                            </div>

                            <div class="emergency-info text-center mt-4" data-aos="fade-up" data-aos-delay="400">
                                <p><i class="bi bi-info-circle"></i> Perubahan kategori akan mempengaruhi pengaduan yang menggunakan kategori ini.</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Edit Kategori Pengaduan Section -->

    </main>
@endsection
