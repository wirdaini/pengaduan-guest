<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Pengaduan')</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-gray-50">
    <!-- Navigation (optional) -->
    <nav class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-blue-500 rounded-lg"></div>
                    <span class="text-xl font-bold text-gray-800">SistemPengaduan</span>
                </div>
                <div class="flex space-x-6">
                    <a href="{{ url('/') }}" class="text-gray-600 hover:text-blue-500">Beranda</a>
                    <a href="{{ url('/about') }}" class="text-gray-600 hover:text-blue-500">Tentang</a>
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-500">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer (optional) -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2024 Sistem Pengaduan Masyarakat. All rights reserved.</p>
        </div>
    </footer>

    <!-- Include WhatsApp Float -->
    @include('layouts.whatsapp')

    @stack('scripts')
</body>
</html>
