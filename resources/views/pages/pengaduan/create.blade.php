@extends('layouts.app')

@section('title', 'Ajukan Pengaduan')

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
                            Sampaikan keluhan atau masalah yang Anda alami untuk kami tindak lanjuti.
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
    </div><!-- End Page Title -->

    <!-- Pengaduan Section -->
    <section id="pengaduan" class="pengaduan section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('pengaduan.store') }}" method="POST">
                        @csrf

                        <div class="row gy-4">
                            <div class="col-12">
                                <label for="warga_id" class="form-label">Data Diri *</label>
                                <select name="warga_id" class="form-select" required>
                                    <option value="">Pilih Data Diri</option>
                                    @foreach($warga as $item)
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
                                <select name="kategori" class="form-select" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Infrastruktur">Infrastruktur</option>
                                    <option value="Lingkungan">Lingkungan</option>
                                    <option value="Kesehatan">Kesehatan</option>
                                    <option value="Keamanan">Keamanan</option>
                                    <option value="Lainnya">Lainnya</option>
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
                                <textarea name="deskripsi" class="form-control" rows="6"
                                          placeholder="Jelaskan detail pengaduan Anda..." required></textarea>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Ajukan Pengaduan</button>
                                <a href="{{ url('/') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /Pengaduan Section -->

</main>
@endsection
