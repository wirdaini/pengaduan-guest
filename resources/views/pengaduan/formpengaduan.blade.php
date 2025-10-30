
@extends('layouts.app')

@section('title', 'Form Pengaduan - PBN')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Pengaduan Masyarakat</h1>
    </div>

    <!-- Form Section -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pengaduan</h6>
                </div>
                <div class="card-body">
                    <form action="#" method="POST">
                        @csrf

                        <!-- Data Pelapor -->
                        <div class="form-group">
                            <label for="nama">Nama Lengkap *</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nik">NIK *</label>
                                    <input type="text" class="form-control" id="nik" name="nik" maxlength="16" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telepon">No. Telepon *</label>
                                    <input type="tel" class="form-control" id="telepon" name="telepon" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat Lengkap *</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                        </div>

                        <!-- Data Pengaduan -->
                        <div class="form-group">
                            <label for="jenis_pengaduan">Jenis Pengaduan *</label>
                            <select class="form-control" id="jenis_pengaduan" name="jenis_pengaduan" required>
                                <option value="">Pilih Jenis Pengaduan</option>
                                <option value="infrastruktur">Infrastruktur & Fasilitas Umum</option>
                                <option value="pelayanan">Pelayanan Publik</option>
                                <option value="lingkungan">Lingkungan Hidup</option>
                                <option value="sosial">Masalah Sosial</option>
                                <option value="keamanan">Keamanan & Ketertiban</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="judul">Judul Pengaduan *</label>
                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Contoh: Jalan Rusak di RT 05" required>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi Lengkap *</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" placeholder="Jelaskan secara detail masalah yang ingin dilaporkan..." required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="lokasi">Lokasi Kejadian *</label>
                            <textarea class="form-control" id="lokasi" name="lokasi" rows="3" placeholder="Alamat lengkap lokasi kejadian..." required></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Kirim Pengaduan</button>
                            <a href="{{ url('/') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
