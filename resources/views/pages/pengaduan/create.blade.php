@extends('layouts.guest.app')

@section('title', 'Ajukan Pengaduan - Bina Desa')

@section('content')

    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Ajukan Pengaduan</h1>
                            <p class="mb-0">
                                Sampaikan laporan Anda mengenai masalah di lingkungan sekitar secara mudah dan cepat.
                                Tim kami akan menindaklanjuti setiap pengaduan yang masuk dengan serius.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="current">Ajukan Pengaduan</li>
                    </ol>
                </div>
            </nav>
        </div>
        <!-- End Page Title -->

        <!-- Pengaduan Section -->
        <section id="pengaduan" class="appointmnet section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="booking-wrapper">

                            <div class="booking-header text-center" data-aos="fade-up" data-aos-delay="200">
                                <h2>Form Pengaduan Warga</h2>
                                <p>Isi data dengan lengkap untuk membantu kami menindaklanjuti laporan Anda dengan lebih
                                    cepat.</p>
                            </div>

                            <div class="appointment-form" data-aos="fade-up" data-aos-delay="300">

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form action="{{ route('pengaduan.store') }}" method="POST" class="php-email-form">
                                    @csrf

                                    <div class="row gy-4">

                                        <div class="col-12">
                                            <label for="warga_id" class="form-label">Data Diri *</label>
                                            <select name="warga_id" class="form-select" required>
                                                <option value="">Pilih Data Diri</option>
                                                @foreach ($warga as $item)
                                                    <option value="{{ $item->warga_id }}">
                                                        {{ $item->nama }} - {{ $item->no_ktp }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="judul" class="form-label">Judul Pengaduan *</label>
                                            <input type="text" name="judul" class="form-control"
                                                placeholder="Contoh: Jalan Rusak di RT 05" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="kategori" class="form-label">Kategori *</label>
                                            <select name="kategori_id" class="form-select" required>
                                                @foreach ($kategori as $kategori)
                                                    <option value="{{ $kategori->kategori_id }}">
                                                        {{ $kategori->nama }} - SLA: {{ $kategori->sla_hari }} hari
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="lokasi_text" class="form-label">Lokasi Kejadian *</label>
                                            <input type="text" name="lokasi_text" class="form-control"
                                                placeholder="Contoh: Jl. Merdeka No. 10, RT 05/RW 02" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="rt" class="form-label">RT *</label>
                                            <input type="text" name="rt" class="form-control"
                                                placeholder="Contoh: 001" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="rw" class="form-label">RW *</label>
                                            <input type="text" name="rw" class="form-control"
                                                placeholder="Contoh: 002" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="deskripsi" class="form-label">Deskripsi Pengaduan *</label>
                                            <textarea name="deskripsi" class="form-control" rows="6" placeholder="Jelaskan detail pengaduan Anda..." required></textarea>
                                        </div>

                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn-book">Ajukan Pengaduan</button>
                                            <a href="{{ route('pengaduan.index') }}"
                                                class="btn btn-secondary mt-2">Kembali</a>
                                        </div>

                                    </div>
                                </form>
                            </div>

                            <div class="emergency-info text-center mt-4" data-aos="fade-up" data-aos-delay="400">
                                <p><i class="bi bi-info-circle"></i> Pengaduan Anda akan segera diproses oleh pihak terkait.
                                    Harap isi data dengan benar agar kami dapat menghubungi Anda jika diperlukan.</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Pengaduan Section -->

    </main>

@endsection
