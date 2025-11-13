<!-- resources/views/pages/auth/register.blade.php -->
@extends('layouts.guest.app')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Daftar</h1>
                            <p class="mb-0">Buat akun Anda untuk mengakses layanan pengaduan desa</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="current">Daftar</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Register Section -->
        <section id="register" class="register section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="register-wrapper">
                            <div class="register-header text-center">
                                <h2>Buat Akun Anda</h2>
                                <p>Bergabung dengan platform kami untuk mengakses layanan pengaduan desa</p>
                            </div>
                            {{--
                            <!-- Tampilkan error messages secara custom -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif --}}

                            <!-- Tampilkan success message -->
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="register-form">
                                <form method="POST" action="{{ route('register.post') }}" id="registerForm">
                                    @csrf
                                    <div class="row gy-4">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Nama Lengkap</label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}"
                                                required>
                                            <!-- Error message untuk name -->
                                            @error('name')
                                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Alamat Email</label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Masukkan alamat email Anda" value="{{ old('email') }}"
                                                required>
                                            <!-- Error message untuk email -->
                                            @error('email')
                                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="password" class="form-label">Kata Sandi</label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Masukkan kata sandi Anda" required>
                                            <!-- Error message untuk password -->
                                            @error('password')
                                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="password_confirmation" class="form-label">Konfirmasi Kata
                                                Sandi</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Konfirmasi kata sandi Anda" required>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="terms"
                                                    id="terms" required>
                                                <label class="form-check-label" for="terms">
                                                    Saya setuju dengan Syarat Layanan dan Kebijakan Privasi
                                                </label>
                                            </div>
                                            <!-- Error message untuk terms -->
                                            @error('terms')
                                                <small class="text-danger d-block mt-1">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn-register w-100" id="submitBtn">
                                                Buat Akun
                                            </button>
                                        </div>
                                        <div class="col-12 text-center">
                                            <p class="mt-3 mb-0">Sudah punya akun?
                                                <a href="{{ route('login') }}" class="login-link">Masuk di sini</a>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Register Section -->

    </main>

    <style>
        .register .register-wrapper {
            background-color: var(--surface-color);
            border-radius: 15px;
            padding: 60px 40px;
            box-shadow: 0 5px 25px color-mix(in srgb, var(--default-color), transparent 90%);
        }

        .register .register-header {
            margin-bottom: 40px;
        }

        .register .register-header h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--heading-color);
        }

        .register .register-header p {
            font-size: 1.1rem;
            color: color-mix(in srgb, var(--default-color), transparent 20%);
            max-width: 500px;
            margin: 0 auto;
        }

        .register .register-form input[type=text],
        .register .register-form input[type=email],
        .register .register-form input[type=password] {
            color: var(--default-color);
            background-color: transparent;
            font-size: 14px;
            border: 2px solid color-mix(in srgb, var(--default-color), transparent 80%);
            border-radius: 8px;
            padding: 15px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .register .register-form input[type=text]:focus,
        .register .register-form input[type=email]:focus,
        .register .register-form input[type=password]:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem color-mix(in srgb, var(--accent-color), transparent 80%);
            outline: none;
        }

        .register .register-form .btn-register {
            background-color: var(--accent-color);
            color: var(--contrast-color);
            padding: 15px 40px;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            width: 100%;
            cursor: pointer;
        }

        .register .register-form .btn-register:hover {
            background-color: color-mix(in srgb, var(--accent-color), black 10%);
            transform: translateY(-2px);
        }

        .register .register-form .btn-register:active {
            transform: translateY(0);
        }

        .register .register-form .login-link {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register .register-form .login-link:hover {
            color: color-mix(in srgb, var(--accent-color), black 20%);
            text-decoration: underline;
        }

        /* Style untuk error messages - SAMA DENGAN LOGIN */
        .alert {
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }

        /* .alert-danger {
                background-color: #f8d7da;
                border-color: #f5c6cb;
                color: #721c24;
            } */

        .alert-success {
            background-color: #d1edff;
            border-color: #b3d9ff;
            color: #004085;
        }

        .text-danger {
            color: #dc3545 !important;
            font-size: 0.875rem;
            margin-top: 5px;
            display: block;
        }

        @media (max-width: 768px) {
            .register .register-wrapper {
                padding: 40px 25px;
            }

            .register .register-header h2 {
                font-size: 1.8rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registerForm');
            const submitBtn = document.getElementById('submitBtn');

            form.addEventListener('submit', function(e) {
                console.log('Form submitted');
            });

            submitBtn.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
    </script>
@endsection
