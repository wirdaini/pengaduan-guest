{{-- resources/views/pages/user/edit.blade.php --}}
@extends('layouts.guest.app')

@section('title', 'Edit User - Bina Desa')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Edit User</h1>
                            <p class="mb-0">
                                Update data user dengan informasi yang terbaru. Pastikan informasi yang diubah akurat dan
                                lengkap.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('user.index') }}">Data User</a></li>
                        <li class="current">Edit User</li>
                    </ol>
                </div>
            </nav>
        </div>
        <!-- End Page Title -->

        <!-- Edit User Section -->
        <section id="user" class="appointmnet section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="booking-wrapper">

                            <div class="booking-header text-center" data-aos="fade-up" data-aos-delay="200">
                                <h2>Form Edit User</h2>
                                <p>Perbarui data user untuk memastikan informasi yang akurat dan terkini.</p>
                            </div>

                            <div class="appointment-form" data-aos="fade-up" data-aos-delay="300">

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <form action="{{ route('user.update', $user->id) }}" method="POST" class="php-email-form">
                                    @csrf
                                    @method('PUT')

                                    <div class="row gy-4">

                                        <!-- Nama Lengkap -->
                                        <div class="col-12">
                                            <label for="name" class="form-label">Nama Lengkap *</label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name', $user->name) }}" placeholder="Nama Lengkap" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email *</label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email', $user->email) }}" placeholder="Alamat Email"
                                                required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- ROLE (TAMBAHKAN INI) -->
                                        <div class="col-12">
                                            <label for="role" class="form-label">Role *</label>
                                            <select name="role" class="form-control @error('role') is-invalid @enderror"
                                                required>
                                                <option value="">Pilih Role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role }}"
                                                        {{ old('role', $user->role) == $role ? 'selected' : '' }}>
                                                        {{ ucfirst($role) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('role')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Password -->
                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Kosongkan jika tidak ingin mengubah password">
                                            <small class="text-muted">Minimal 8 karakter</small>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Konfirmasi Password -->
                                        <div class="col-12">
                                            <label for="password_confirmation" class="form-label">Konfirmasi
                                                Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Konfirmasi password">
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn-book">Update User</button>
                                            <a href="{{ route('user.index') }}" class="btn btn-secondary mt-2">Kembali</a>
                                        </div>

                                    </div>
                                </form>
                            </div>

                            <div class="emergency-info text-center mt-4" data-aos="fade-up" data-aos-delay="400">
                                <p><i class="bi bi-info-circle"></i> Perubahan data user akan segera diperbarui dalam
                                    sistem. Pastikan informasi yang diubah sudah benar.</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Edit User Section -->

    </main>
@endsection
