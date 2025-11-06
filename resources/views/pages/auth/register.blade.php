<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Register</h1>
                            <p class="mb-0">Create your account</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="current">Register</li>
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
                                <h2>Create Your Account</h2>
                                <p>Join our medical platform to access healthcare services</p>
                            </div>

                            <!-- Tampilkan error messages -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="register-form">
                                <form method="POST" action="{{ route('register.post') }}" id="registerForm">
                                    @csrf
                                    <div class="row gy-4">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input type="text" name="name" class="form-control"
                                                   placeholder="Enter your full name" value="{{ old('name') }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email address</label>
                                            <input type="email" name="email" class="form-control"
                                                   placeholder="Enter your email address" value="{{ old('email') }}" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                   placeholder="Enter your password" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="password_confirmation" class="form-label">Confirm password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                   placeholder="Confirm your password" required>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                                                <label class="form-check-label" for="terms">
                                                    I agree to the Terms of Service and Privacy Policy
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn-register w-100" id="submitBtn">
                                                Create Account
                                            </button>
                                        </div>
                                        <div class="col-12 text-center">
                                            <p class="mt-3 mb-0">Already have an account?
                                                <a href="{{ route('login') }}" class="login-link">Login here</a>
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
    /* Your existing CSS styles here */
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

    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('registerForm');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', function(e) {
            // Hapus event listener JavaScript yang mungkin mem-block
            console.log('Form submitted');
            // Biarkan form submit normal
        });

        // Prevent default behavior yang mungkin di-block oleh framework
        submitBtn.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });
    </script>
@endsection
