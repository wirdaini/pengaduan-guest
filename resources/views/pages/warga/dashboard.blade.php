@extends('layouts.app')

@section('title', 'Tambah Data Warga - Bina Desa')

@section('content')
<div class="container">
    <h2>Tambah Data Warga</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- PERBAIKAN: route('warga.store') -->
    <form action="{{ route('warga.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="no_ktp">No KTP *</label>
                    <input type="text" class="form-control" id="no_ktp" name="no_ktp"
                           value="{{ old('no_ktp') }}" maxlength="16" required>
                    <small class="form-text text-muted">16 digit angka</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama">Nama Lengkap *</label>
                    <input type="text" class="form-control" id="nama" name="nama"
                           value="{{ old('nama') }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin *</label>
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="agama">Agama *</label>
                    <input type="text" class="form-control" id="agama" name="agama"
                           value="{{ old('agama') }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="pekerjaan">Pekerjaan *</label>
                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                           value="{{ old('pekerjaan') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="telp">No Telepon *</label>
                    <input type="text" class="form-control" id="telp" name="telp"
                           value="{{ old('telp') }}" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="{{ old('email') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Data Warga</button>
        <a href="{{ route('warga.index') }}" class="btn btn-secondary">Lihat Dashboard</a>
    </form>
</div>
@endsection
