@extends('layouts.app')

@section('title', 'Edit Data Warga')

@section('content')
<main class="main">

    <!-- Page Title -->
    <div class="page-title">
        <div class="heading">
            <div class="container">
                <div class="row d-flex justify-content-center text-center">
                    <div class="col-lg-8">
                        <h1 class="heading-title">Edit Data Warga</h1>
                        <p class="mb-0">
                            Update data warga dengan informasi yang terbaru.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <nav class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('warga.index') }}">Data Warga</a></li>
                    <li class="current">Edit Data</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <!-- Edit Section -->
    <section id="edit-warga" class="edit-warga section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="edit-form">
                        <form action="{{ route('warga.update', $warga->warga_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <label for="no_ktp" class="form-label">NIK *</label>
                                    <input type="text" name="no_ktp" class="form-control"
                                           value="{{ old('no_ktp', $warga->no_ktp) }}"
                                           placeholder="16 digit NIK" maxlength="16" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="nama" class="form-label">Nama Lengkap *</label>
                                    <input type="text" name="nama" class="form-control"
                                           value="{{ old('nama', $warga->nama) }}"
                                           placeholder="Nama Lengkap" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin *</label>
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="agama" class="form-label">Agama *</label>
                                    <select name="agama" class="form-select" required>
                                        <option value="">Pilih Agama</option>
                                        <option value="Islam" {{ old('agama', $warga->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ old('agama', $warga->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="Katolik" {{ old('agama', $warga->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Hindu" {{ old('agama', $warga->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Buddha" {{ old('agama', $warga->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                        <option value="Konghucu" {{ old('agama', $warga->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="pekerjaan" class="form-label">Pekerjaan *</label>
                                    <input type="text" name="pekerjaan" class="form-control"
                                           value="{{ old('pekerjaan', $warga->pekerjaan) }}"
                                           placeholder="Pekerjaan" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="telp" class="form-label">No Telepon *</label>
                                    <input type="tel" name="telp" class="form-control"
                                           value="{{ old('telp', $warga->telp) }}"
                                           placeholder="Nomor Telepon" required>
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control"
                                           value="{{ old('email', $warga->email) }}"
                                           placeholder="Alamat Email" required>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update Data</button>
                                    <a href="{{ route('warga.index') }}" class="btn btn-secondary">Kembali ke Data Warga</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Edit Section -->

</main>
@endsection
