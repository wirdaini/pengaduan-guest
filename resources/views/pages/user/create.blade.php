@extends('layouts.guest.app')

@section('title', 'Tambah User')

@section('content')
    <main class="main">
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Tambah User Baru</h1>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('user.index') }}">Users</a></li>
                        <li class="current">Tambah User</li>
                    </ol>
                </div>
            </nav>
        </div>

        <section class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <!-- PERUBAHAN: Tambah enctype untuk upload file -->
                                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row gy-4">
                                        <!-- Foto Profil -->
                                        <div class="col-12">
                                            <label for="profile_picture" class="form-label">Foto Profil</label>
                                            <div class="mb-3">
                                                <div class="image-preview mb-2" id="imagePreview">
                                                    <div class="image-preview-default">
                                                        <i class="bi bi-person-circle"
                                                            style="font-size: 80px; color: #6c757d;"></i>
                                                        <p class="text-muted mt-2">Belum ada foto</p>
                                                    </div>
                                                </div>
                                                <input type="file" name="profile_picture" id="profile_picture"
                                                    class="form-control @error('profile_picture') is-invalid @enderror"
                                                    accept="image/*" onchange="previewImage(event)">
                                                @error('profile_picture')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <small class="text-muted">Format: JPEG, PNG, JPG, GIF. Maks: 2MB</small>
                                            </div>
                                        </div>

                                        <!-- Nama -->
                                        <div class="col-12">
                                            <label for="name" class="form-label">Nama Lengkap *</label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name') }}" placeholder="Nama Lengkap" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email *</label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" placeholder="Alamat Email" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- ROLE -->
                                        <div class="col-12">
                                            <label for="role" class="form-label">Role *</label>
                                            <select name="role" class="form-control @error('role') is-invalid @enderror"
                                                required>
                                                <option value="">Pilih Role</option>
                                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin
                                                </option>
                                                <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>
                                                    Petugas</option>
                                                <option value="warga" {{ old('role') == 'warga' ? 'selected' : '' }}>Warga
                                                </option>
                                            </select>
                                            @error('role')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Password -->
                                        <div class="col-12">
                                            <label for="password" class="form-label">Password *</label>
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Password" required>
                                            <small class="text-muted">Minimal 8 karakter</small>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Password Confirmation -->
                                        <div class="col-12">
                                            <label for="password_confirmation" class="form-label">Konfirmasi Password
                                                *</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Konfirmasi Password" required>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Simpan User</button>
                                            <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        .image-preview {
            width: 150px;
            height: 150px;
            border: 2px dashed #dee2e6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        .image-preview-default {
            text-align: center;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const imagePreview = document.getElementById('imagePreview');

            reader.onload = function() {
                imagePreview.innerHTML = `<img src="${reader.result}" alt="Preview" class="img-fluid">`;
            }

            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
@endsection
