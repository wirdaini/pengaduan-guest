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
                            <li class="current">Login</li>
                        </ol>
                    </div>
                </nav>
            </div><!-- End Page Title -->


            <!-- Login Section - DINAIKKAN POSISINYA -->
            <div class="login-container">
                <div class="login-box">
                    <!-- KIRI : FORM LOGIN -->
                    <div class="login-form-section">
                        <div class="login-form-wrapper">
                            <h1 class="login-title">Login</h1>
                            <p class="login-subtitle">Untuk mengakses akun, silakan mengisi data diri anda</p>

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

                            <form method="POST" action="{{ route('login.post') }}" class="login-form">
                                @csrf

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="{{ old('email') }}" placeholder="nama@email.com" required>
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Masukkan password" required>
                                </div>

                                <!-- Tombol Masuk -->
                                <button type="submit" class="btn btn-login">Masuk</button>

                                <!-- Link Daftar -->
                                <div class="register-section">
                                    <p>Belum memiliki akun?
                                        <a href="{{ route('register') }}" class="register-link">Daftar Disini</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- KANAN : BACKGROUND IMAGE -->
                    <div class="login-image-section">
                        <img src="{{ asset('assets/img/login.jpeg') }}" alt="Login Background"
                            class="login-bg-image">
                    </div>
                </div>
            </div>
    </main>

<style>
    /* ===============================
       VARIABLES & RESET
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
       PAGE TITLE - DIKECILKAN
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
       LOGIN CONTAINER
    ================================ */
    .login-container {
        width: 100%;
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 20px;
        margin-top: -50px;
    }

    .login-box {
        width: 100%;
        display: flex;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--shadow);
        height: 500px;
    }

    /* ===============================
       FORM SECTION (KIRI) - 60%
    ================================ */
    .login-form-section {
        flex: 1.2; /* Lebih besar */
        padding: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
    }

    .login-form-wrapper {
        width: 100%;
        max-width: 360px;
        animation: fadeInUp 0.5s ease-out 0.2s both;
    }

    /* Header */
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

    /* Form Elements */
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
    box-shadow: 0 0 0 2px rgba(29, 78, 216, 0.08); /* Shadow biru sangat tipis */
    background-color: #ffffff;
    outline: none;
}

    /* Forgot Password */
    .forgot-password {
        text-align: right;
        margin-bottom: 25px;
    }

    .forgot-link {
        color: var(--primary-color);
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: color 0.2s;
    }

    .forgot-link:hover {
        text-decoration: underline;
        color: var(--primary-hover);
    }

    /* Login Button */
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
    }

    .btn-login:hover {
        background-color: var(--primary-hover);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .btn-login:active {
        transform: translateY(0);
    }

    /* Register Section */
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
   IMAGE SECTION (KANAN) - NYATU DENGAN FORM
=============================== */
.login-image-section {
    flex: 0.8;
    position: relative;
    overflow: hidden;
    min-width: 300px;
    background: white; /* SAMA dengan background form */
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px 100px 40px 10px; /* top right bottom left */
}

.login-bg-image {
    width: 320px;           /* Lebar diperbesar */
    height: 320px;          /* Tinggi sama dengan lebar (persegi) */
    object-fit: contain;    /* Gambar tidak crop */
    display: block;
    /* Hapus efek yang membuat terlihat kotak terpisah */
}

/* RESPONSIVE - TANPA BORDER */
@media (max-width: 768px) {
    .login-image-section {
        flex: none;
        width: 100%;
        min-height: 250px;
        order: -1;
        padding: 30px;
        /* TANPA border */
    }

    .login-bg-image {
        width: 200px;
        max-height: 200px;
    }
}
    /* ===============================
       ALERTS - SIMPLE & PROFESSIONAL
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

    /* Hapus icon warning */
    .alert-message:before {
        content: none;
    }

    /* Tampilkan error dalam daftar */
    .alert-danger .alert-message div {
        margin-bottom: 6px;
        padding: 0;
    }

    .alert-danger .alert-message div:last-child {
        margin-bottom: 0;
    }

    /* ===============================
       ANIMATIONS
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
       FORM VALIDATION ERRORS
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
       RESPONSIVE DESIGN
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
            height: auto;
            max-width: 100%;
            min-height: auto;
        }

        .login-image-section {
            flex: none;
            width: 100%;
            min-height: 250px;
            order: -1; /* Gambar di atas di mobile */
            border-left: none;
            border-bottom: 1px solid #e5e7eb;
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
            height: 480px;
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
            // Auto focus ke email input
            const emailInput = document.getElementById('email');
            if (emailInput) {
                setTimeout(() => emailInput.focus(), 100);
            }

            // Form validation
            const form = document.querySelector('.login-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const email = form.querySelector('#email');
                    const password = form.querySelector('#password');
                    let isValid = true;

                    // Reset error states
                    clearErrors();

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

                    if (!isValid) {
                        e.preventDefault();
                        // Add shake animation to invalid fields
                        const errorFields = document.querySelectorAll('.form-control.error');
                        errorFields.forEach(field => {
                            field.style.animation = 'shake 0.4s ease';
                            setTimeout(() => field.style.animation = '', 400);
                        });
                    }
                });
            }

            // Email validation function
            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            // Show error message
            function showError(input, message) {
                input.classList.add('error');

                // Create or update error message
                let errorDiv = input.parentNode.querySelector('.error-message');
                if (!errorDiv) {
                    errorDiv = document.createElement('div');
                    errorDiv.className = 'error-message';
                    input.parentNode.appendChild(errorDiv);
                }

                errorDiv.textContent = message;
            }

            // Clear all errors
            function clearErrors() {
                const errors = document.querySelectorAll('.error-message');
                errors.forEach(error => error.remove());

                const inputs = document.querySelectorAll('.form-control');
                inputs.forEach(input => input.classList.remove('error'));
            }

            // Remove error on input
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    this.classList.remove('error');
                    const error = this.parentNode.querySelector('.error-message');
                    if (error) {
                        error.remove();
                    }
                });
            });
        });
    </script>
@endsection
