<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Lapor Desa</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @include('layouts.guest.css')
</head>

<body class="index-page">
    @include('layouts.guest.header')

      {{-- @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif --}}

    @yield('content')

    @include('layouts.guest.footer')

    @include('layouts.guest.js')

    <div class="floating-whatsapp">
        <a href="https://wa.me/6281374040787?text=Halo,%20saya%20membutuhkan%20informasi%20tentang%20layanan%20pengaduan%20desa%20Bina%20Desa"
            target="_blank" class="whatsapp-btn">
            <i class="whatsapp-icon"></i>
            <span class="whatsapp-tooltip">Chat via WhatsApp</span>
        </a>
    </div>
</body>
</html>
