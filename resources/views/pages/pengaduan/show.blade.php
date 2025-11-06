@extends('layouts.app')

@section('title', 'Detail Pengaduan')

@section('content')
<main class="main">

    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Detail Pengaduan</h1>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('pengaduan.index') }}">Data Pengaduan</a></li>
                    <li class="current">Detail Pengaduan</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Detail Pengaduan Section -->
    <section id="detail-pengaduan" class="detail-pengaduan section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Informasi Pengaduan</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>No Tiket:</strong>
                                    <p class="text-muted">{{ $pengaduan->nomon_tiket }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Status:</strong>
                                    <p>
                                        @if($pengaduan->status == 'menunggu')
                                            <span class="badge bg-warning">Menunggu</span>
                                        @elseif($pengaduan->status == 'diproses')
                                            <span class="badge bg-primary">Diproses</span>
                                        @elseif($pengaduan->status == 'selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @elseif($pengaduan->status == 'ditolak')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-12">
                                    <strong>Nama Warga:</strong>
                                    <p class="text-muted">{{ $pengaduan->warga->nama }} ({{ $pengaduan->warga->no_ktp }})</p>
                                </div>
                                <div class="col-12">
                                    <strong>Judul Pengaduan:</strong>
                                    <p class="text-muted">{{ $pengaduan->judul }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Kategori:</strong>
                                    <p class="text-muted">{{ $pengaduan->kategori }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Lokasi:</strong>
                                    <p class="text-muted">{{ $pengaduan->lokasi_text }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>PT:</strong>
                                    <p class="text-muted">{{ $pengaduan->pt }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>RW:</strong>
                                    <p class="text-muted">{{ $pengaduan->rw }}</p>
                                </div>
                                <div class="col-12">
                                    <strong>Deskripsi:</strong>
                                    <p class="text-muted">{{ $pengaduan->desknipsi }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Tanggal Diajukan:</strong>
                                    <p class="text-muted">{{ $pengaduan->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Terakhir Diupdate:</strong>
                                    <p class="text-muted">{{ $pengaduan->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('pengaduan.edit', $pengaduan->pengaduan_id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section><!-- /Detail Pengaduan Section -->

</main>
@endsection
