<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Login</h1>
                            <p class="mb-0">Masuk ke akun Anda untuk mengakses layanan pengaduan desa</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="current">Login</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Login Section -->
        <section id="login" class="login section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="login-wrapper">
                            <div class="login-header text-center">
                                <h2>Masuk ke Akun Anda</h2>
                                <p>Akses pengaduan dan layanan desa Anda</p>
                            </div>

                            <div class="login-form">
                                <form method="POST" action="{{ route('login.post') }}" class="php-email-form">
                                    @csrf
                                    <div class="row gy-4">
                                        <div class="col-12">
                                            <label for="email" class="form-label">Alamat Email</label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Masukkan alamat email Anda" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="password" class="form-label">Kata Sandi</label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Masukkan kata sandi Anda" required>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember">
                                                <label class="form-check-label" for="remember">
                                                    Ingatkan saya
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <a href="#" class="forgot-password">Lupa Kata Sandi?</a>
                                        </div>
                                        <div class="col-12">
                                            <hr class="my-4">
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn-login w-100">Masuk</button>
                                        </div>
                                        <div class="col-12 text-center">
                                            <p class="mt-3 mb-0">Belum punya akun?
                                                <a href="{{ route('register') }}" class="register-link">Daftar di sini</a>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Login Section -->

    </main>

    <style>
        .login .login-wrapper {
            background-color: var(--surface-color);
            border-radius: 15px;
            padding: 60px 40px;
            box-shadow: 0 5px 25px color-mix(in srgb, var(--default-color), transparent 90%);
        }

        .login .login-header {
            margin-bottom: 40px;
        }

        .login .login-header h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--heading-color);
        }

        .login .login-header p {
            font-size: 1.1rem;
            color: color-mix(in srgb, var(--default-color), transparent 20%);
            max-width: 400px;
            margin: 0 auto;
        }

        .login .login-form .php-email-form input[type=email],
        .login .login-form .php-email-form input[type=password] {
            color: var(--default-color);
            background-color: transparent;
            font-size: 14px;
            border: 2px solid color-mix(in srgb, var(--default-color), transparent 80%);
            border-radius: 8px;
            padding: 15px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .login .login-form .php-email-form input[type=email]:focus,
        .login .login-form .php-email-form input[type=password]:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem color-mix(in srgb, var(--accent-color), transparent 80%);
            outline: none;
        }

        .login .login-form .php-email-form input[type=email]::placeholder,
        .login .login-form .php-email-form input[type=password]::placeholder {
            color: color-mix(in srgb, var(--default-color), transparent 70%);
        }

        .login .login-form .php-email-form .form-check-input:checked {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .login .login-form .php-email-form .form-check-label {
            color: var(--default-color);
            font-size: 0.9rem;
        }

        .login .login-form .php-email-form .forgot-password {
            color: var(--accent-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .login .login-form .php-email-form .forgot-password:hover {
            color: color-mix(in srgb, var(--accent-color), black 20%);
            text-decoration: underline;
        }

        .login .login-form .php-email-form hr {
            border-top: 2px solid color-mix(in srgb, var(--default-color), transparent 80%);
            margin: 25px 0;
        }

        .login .login-form .php-email-form .btn-login {
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

        .login .login-form .php-email-form .btn-login:hover {
            background-color: color-mix(in srgb, var(--accent-color), black 10%);
            transform: translateY(-2px);
        }

        .login .login-form .php-email-form .btn-login:active {
            transform: translateY(0);
        }

        .login .login-form .php-email-form .register-link {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login .login-form .php-email-form .register-link:hover {
            color: color-mix(in srgb, var(--accent-color), black 20%);
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .login .login-wrapper {
                padding: 40px 25px;
            }

            .login .login-header h2 {
                font-size: 1.8rem;
            }
        }
    </style>
@endsection
