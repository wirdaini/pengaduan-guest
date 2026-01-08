@extends('layouts.guest.app')

@section('content')
    <main class="main">

        <!-- Page Title - DIPERKECIL -->
        <div class="page-title">
            <div class="heading">
                <nav class="breadcrumbs">
                    <div class="container">
                        <ol>
                            <li><a href="{{ url('/') }}"><i class="bi bi-house"></i></a></li>
                            <li class="current">Daftar</li>
                        </ol>
                    </div>
                </nav>
            </div><!-- End Page Title -->

            <!-- Register Section - SAMA DENGAN LOGIN TAPI LEBIH TINGGI -->
            <div class="login-container">
                <div class="login-box">
                    <!-- KIRI : FORM REGISTER -->
                    <div class="login-form-section">
                        <div class="login-form-wrapper">
                            <h1 class="login-title">Buat Akun Anda</h1>
                            <p class="login-subtitle">Bergabung dengan platform kami untuk mengakses layanan pengaduan desa</p>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <div class="alert-message">{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form method="POST" action="{{ route('register.post') }}" id="registerForm" class="login-form">
                                @csrf

                                <!-- Nama Lengkap -->
                                <div class="form-group">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" required>
                                    @error('name')
                                        <small class="error-message">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email" class="form-label">Alamat Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Masukkan alamat email Anda" value="{{ old('email') }}" required>
                                    @error('email')
                                        <small class="error-message">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label for="password" class="form-label">Kata Sandi</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Masukkan kata sandi Anda" required>
                                    @error('password')
                                        <small class="error-message">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Konfirmasi Password -->
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control" placeholder="Konfirmasi kata sandi Anda" required>
                                </div>

                                <!-- Checkbox Terms -->
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                                        <label class="form-check-label" for="terms">
                                            Saya setuju dengan Syarat Layanan dan Kebijakan Privasi
                                        </label>
                                    </div>
                                    @error('terms')
                                        <small class="error-message d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Tombol Buat Akun -->
                                <button type="submit" class="btn btn-login">Buat Akun</button>

                                <!-- Link Masuk -->
                                <div class="register-section">
                                    <p>Sudah punya akun?
                                        <a href="{{ route('login') }}" class="register-link">Masuk di sini</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- KANAN : BACKGROUND IMAGE - SAMA DENGAN LOGIN -->
                    <div class="login-image-section">
                        <img src="{{ asset('assets/img/login.jpeg') }}" alt="Register Background"
                            class="login-bg-image">
                    </div>
                </div>
            </div>
    </main>

    <style>
        /* ===============================
           VARIABLES & RESET - SAMA DENGAN LOGIN
        ================================ */
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --text-dark: #1e293b;
            --text-medium: #64748b;
            --text-light: #6b7280;
            --border-color: #d1d5db;
            --bg-light: #f9fafb;
            --danger-color: #991b1b;
            --danger-bg: #fee2e2;
            --success-color: #065f46;
            --success-bg: #d1fae5;
            --radius: 8px;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        /* ===============================
           PAGE TITLE - SAMA DENGAN LOGIN
        ================================ */
        .page-title {
            background: #f8fafc;
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 10px;
        }

        .breadcrumbs {
            font-size: 0.85rem;
            color: var(--text-medium);
        }

        .breadcrumbs ol {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 8px;
        }

        .breadcrumbs li {
            display: flex;
            align-items: center;
        }

        .breadcrumbs a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.2s;
        }

        .breadcrumbs a:hover {
            text-decoration: underline;
            color: var(--primary-hover);
        }

        .breadcrumbs li.current {
            color: var(--text-light);
        }

        /* ===============================
           LOGIN CONTAINER - SAMA DENGAN LOGIN
        ================================ */
        .login-container {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px;
            margin-top: -50px; /* SAMA DENGAN LOGIN */
        }

        /* ===============================
           LOGIN BOX - SAMA DENGAN LOGIN TAPI LEBIH TINGGI
        ================================ */
        .login-box {
            width: 100%;
            display: flex;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            height: 750px; /* LEBIH TINGGI DARI LOGIN (500px) */
        }

        /* ===============================
           FORM SECTION (KIRI) - SAMA DENGAN LOGIN
        ================================ */
        .login-form-section {
            flex: 1.2;
            padding: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
        }

        .login-form-wrapper {
            width: 100%;
            max-width: 360px; /* SAMA DENGAN LOGIN */
            animation: fadeInUp 0.5s ease-out 0.2s both;
        }

        /* Header - SAMA DENGAN LOGIN */
        .login-title {
            color: var(--text-dark);
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 8px;
            text-align: center;
        }

        .login-subtitle {
            color: var(--text-medium);
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        /* Form Elements - SAMA DENGAN LOGIN */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            color: var(--text-dark);
            font-weight: 500;
            margin-bottom: 6px;
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            padding: 11px 14px;
            font-size: 0.9rem;
            background-color: var(--bg-light);
            outline: none;
            transition: all 0.2s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: #1d4ed8;
            border-width: 1px;
            box-shadow: 0 0 0 2px rgba(29, 78, 216, 0.08);
            background-color: #ffffff;
            outline: none;
        }

        /* Checkbox Terms */
        .form-check {
            padding-left: 1.5em;
            margin-top: 5px;
        }

        .form-check-input {
            width: 1em;
            height: 1em;
            margin-top: 0.25em;
            vertical-align: top;
            background-color: white;
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            appearance: none;
            cursor: pointer;
            float: left;
            margin-left: -1.5em;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-input:checked[type=checkbox] {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
        }

        .form-check-label {
            color: var(--text-medium);
            font-size: 0.85rem;
            line-height: 1.4;
            cursor: pointer;
            display: block;
            margin-left: 0;
        }

        /* Login Button - SAMA DENGAN LOGIN */
        .btn-login {
            width: 100%;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--radius);
            padding: 12px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-bottom: 20px;
            margin-top: 10px;
        }

        .btn-login:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Register/Masuk Section - SAMA DENGAN LOGIN */
        .register-section {
            text-align: center;
            color: var(--text-light);
            font-size: 0.85rem;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            margin-top: 15px;
        }

        .register-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            margin-left: 4px;
            transition: color 0.2s;
        }

        .register-link:hover {
            text-decoration: underline;
            color: var(--primary-hover);
        }

        /* ===============================
           IMAGE SECTION (KANAN) - SAMA DENGAN LOGIN
        ================================ */
        .login-image-section {
            flex: 0.8;
            position: relative;
            overflow: hidden;
            min-width: 300px;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 100px 40px 10px;
        }

        .login-bg-image {
            width: 320px;
            height: 320px;
            object-fit: contain;
            display: block;
        }

        /* ===============================
           ALERTS - SAMA DENGAN LOGIN
        =============================== */
        .alert {
            padding: 14px 16px;
            border-radius: var(--radius);
            margin-bottom: 25px;
            font-size: 0.9rem;
            animation: fadeIn 0.3s ease-out;
            border: 1px solid transparent;
            position: relative;
            background-color: white;
            line-height: 1.5;
        }

        .alert-danger {
            background-color: #fef2f2;
            color: #991b1b;
            border-color: #fecaca;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .alert-success {
            background-color: #f0fdf4;
            color: #166534;
            border-color: #bbf7d0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .alert-message {
            margin: 0;
            padding: 0;
            font-weight: 400;
        }

        .alert-message:before {
            content: none;
        }

        .alert-danger .alert-message div {
            margin-bottom: 6px;
            padding: 0;
        }

        .alert-danger .alert-message div:last-child {
            margin-bottom: 0;
        }

        /* ===============================
           ANIMATIONS - SAMA DENGAN LOGIN
        ================================ */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===============================
           FORM VALIDATION ERRORS - SAMA DENGAN LOGIN
        ================================ */
        .form-control.error {
            border-color: var(--danger-color);
            background-color: #fef2f2;
        }

        .error-message {
            color: var(--danger-color);
            font-size: 13px;
            margin-top: 4px;
            display: block;
        }

        /* ===============================
           RESPONSIVE DESIGN - DISESUAIKAN DENGAN LOGIN
        ================================ */
        @media (max-width: 768px) {
            .page-title {
                padding: 10px 0;
                margin-bottom: 5px;
            }

            .login-container {
                padding: 0 15px;
                margin-top: 20px;
            }

            .login-box {
                flex-direction: column;
                height: auto; /* AUTO DI MOBILE */
                max-width: 100%;
                min-height: auto;
            }

            .login-image-section {
                flex: none;
                width: 100%;
                min-height: 250px;
                order: -1;
                padding: 30px;
            }

            .login-bg-image {
                width: 200px;
                max-height: 200px;
            }

            .login-form-section {
                flex: none;
                width: 100%;
                padding: 30px 25px;
            }

            .login-form-wrapper {
                max-width: 100%;
            }

            .login-title {
                font-size: 1.6rem;
            }

            .alert {
                margin-bottom: 20px;
                padding: 12px 15px;
            }
        }

        @media (min-width: 769px) and (max-width: 992px) {
            .login-container {
                max-width: 95%;
            }

            .login-box {
                height: 580px; /* LEBIH TINGGI DI TABLET */
            }

            .login-form-section {
                padding: 35px;
            }

            .login-image-section {
                flex: 0.7;
                min-width: 280px;
            }

            .login-bg-image {
                width: 250px;
            }

            .login-form-wrapper {
                max-width: 320px;
            }
        }

        @media (max-width: 480px) {
            .login-form-section {
                padding: 25px 20px;
            }

            .login-image-section {
                padding: 25px;
                min-height: 200px;
            }

            .login-bg-image {
                width: 180px;
                max-height: 180px;
            }

            .login-title {
                font-size: 1.5rem;
                margin-bottom: 6px;
            }

            .login-subtitle {
                font-size: 0.85rem;
                margin-bottom: 25px;
            }

            .form-control {
                padding: 10px 12px;
                font-size: 0.85rem;
            }

            .btn-login {
                padding: 11px;
                font-size: 0.9rem;
            }

            .register-section {
                font-size: 0.8rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto focus ke nama input
            const nameInput = document.getElementById('name');
            if (nameInput) {
                setTimeout(() => nameInput.focus(), 100);
            }

            // Form validation
            const form = document.getElementById('registerForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const name = form.querySelector('#name');
                    const email = form.querySelector('#email');
                    const password = form.querySelector('#password');
                    const passwordConfirm = form.querySelector('#password_confirmation');
                    const terms = form.querySelector('#terms');
                    let isValid = true;

                    // Reset error states
                    clearErrors();

                    // Name validation
                    if (!name.value.trim()) {
                        showError(name, 'Nama harus diisi');
                        isValid = false;
                    } else if (name.value.length < 3) {
                        showError(name, 'Nama minimal 3 karakter');
                        isValid = false;
                    }

                    // Email validation
                    if (!email.value.trim()) {
                        showError(email, 'Email harus diisi');
                        isValid = false;
                    } else if (!validateEmail(email.value)) {
                        showError(email, 'Format email tidak valid');
                        isValid = false;
                    }

                    // Password validation
                    if (!password.value.trim()) {
                        showError(password, 'Password harus diisi');
                        isValid = false;
                    } else if (password.value.length < 6) {
                        showError(password, 'Password minimal 6 karakter');
                        isValid = false;
                    }

                    // Password confirmation
                    if (!passwordConfirm.value.trim()) {
                        showError(passwordConfirm, 'Konfirmasi password harus diisi');
                        isValid = false;
                    } else if (password.value !== passwordConfirm.value) {
                        showError(passwordConfirm, 'Password tidak cocok');
                        isValid = false;
                    }

                    // Terms validation
                    if (!terms.checked) {
                        terms.classList.add('error');
                        showError(terms, 'Anda harus menyetujui syarat dan ketentuan');
                        isValid = false;
                    }

                    if (!isValid) {
                        e.preventDefault();
                        // Add shake animation to invalid fields
                        const errorFields = document.querySelectorAll('.form-control.error, .form-check-input.error');
                        errorFields.forEach(field => {
                            field.style.animation = 'shake 0.4s ease';
                            setTimeout(() => field.style.animation = '', 400);
                        });
                    }
                });
            }

            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            function showError(input, message) {
                input.classList.add('error');

                let errorDiv = input.parentNode.querySelector('.error-message');
                if (!errorDiv) {
                    errorDiv = document.createElement('small');
                    errorDiv.className = 'error-message';

                    if (input.type === 'checkbox') {
                        input.closest('.form-check').appendChild(errorDiv);
                    } else {
                        input.parentNode.appendChild(errorDiv);
                    }
                }
                errorDiv.textContent = message;
            }

            function clearErrors() {
                const errors = document.querySelectorAll('.error-message');
                errors.forEach(error => error.remove());

                const inputs = document.querySelectorAll('.form-control, .form-check-input');
                inputs.forEach(input => input.classList.remove('error'));
            }

            // Remove error on input
            const inputs = document.querySelectorAll('.form-control, .form-check-input');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    this.classList.remove('error');
                    const error = this.parentNode.querySelector('.error-message');
                    if (error) {
                        error.remove();
                    }
                });

                if (input.type === 'checkbox') {
                    input.addEventListener('change', function() {
                        this.classList.remove('error');
                        const error = this.closest('.form-check').querySelector('.error-message');
                        if (error) {
                            error.remove();
                        }
                    });
                }
            });
        });
    </script>
@endsection
