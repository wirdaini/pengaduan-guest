<!-- resources/views/layouts/guest/app.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'Lapor Desa')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @include('layouts.guest.css')

    <!-- CSS khusus untuk profile pages -->
    @if(request()->is('profile*'))
    <style>
        .profile-layout {
            padding: 40px 0;
        }

        .profile-sidebar {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }

        .profile-content {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #4361ee;
            margin-bottom: 15px;
        }

        .profile-nav {
            margin-top: 25px;
        }

        .profile-nav ul {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
        }

        .profile-nav li {
            margin-bottom: 8px;
        }

        .profile-nav a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #495057;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .profile-nav a:hover,
        .profile-nav a.active {
            background-color: #eef2ff;
            color: #4361ee;
            font-weight: 500;
        }

        .profile-nav i {
            margin-right: 12px;
            font-size: 1.1rem;
        }

        /* Status badges */
        .badge-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .badge-menunggu { background-color: #fff3cd; color: #856404; }
        .badge-diproses { background-color: #cce5ff; color: #004085; }
        .badge-selesai { background-color: #d4edda; color: #155724; }
        .badge-ditolak { background-color: #f8d7da; color: #721c24; }

        /* Responsive */
        @media (max-width: 992px) {
            .profile-sidebar {
                margin-bottom: 20px;
            }
        }
    </style>
    @endif

    @yield('styles')
</head>

<body class="index-page">
    @include('layouts.guest.header')

    <!-- ========== KONDISI: HALAMAN PROFILE ========== -->
    @if(request()->is('profile*'))
        <!-- Page Title untuk Profile -->
        <div class="page-title">
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ route('profile.index') }}">My Profile</a></li>
                        <li class="current">@yield('page-title', 'Dashboard')</li>
                    </ol>
                </div>
            </nav>
        </div>

        <!-- Layout dengan Sidebar -->
        <div class="profile-layout">
            <div class="container">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-lg-3">
                        @include('layouts.guest.sidebar')
                    </div>

                    <!-- Content Area -->
                    <div class="col-lg-9">
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- ========== KONDISI: HALAMAN NON-PROFILE ========== -->
        <!-- Tanpa Sidebar, langsung content -->
        @yield('content')
    @endif

    @include('layouts.guest.footer')

    @include('layouts.guest.js')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <div class="floating-whatsapp">
        <a href="https://wa.me/6281374040787?text=Halo,%20saya%20membutuhkan%20informasi%20tentang%20layanan%20pengaduan%20desa%20Bina%20Desa"
            target="_blank" class="whatsapp-btn">
            <i class="whatsapp-icon"></i>
            <span class="whatsapp-tooltip">Chat via WhatsApp</span>
        </a>
    </div>

    @yield('scripts')
</body>
</html>
