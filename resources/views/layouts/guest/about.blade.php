@extends('layouts.app')

@section('title', 'Tentang Sistem Pengaduan')

@section('content')
<div class="min-h-screen bg-white py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">TENTANG SISTEM PENGADUAN</h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto mb-6"></div>
            <p class="text-lg text-gray-600">Platform Digital untuk Pelayanan Publik yang Lebih Baik</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 items-center mb-12">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Apa Itu Sistem Pengaduan?</h2>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Sistem Pengaduan Masyarakat adalah platform inovatif yang dirancang untuk
                    memfasilitasi komunikasi antara warga dan pemerintah secara efektif dan transparan.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    Dengan sistem ini, masyarakat dapat dengan mudah melaporkan berbagai masalah
                    seperti infrastruktur publik, pelayanan masyarakat, dan masalah lingkungan
                    dengan proses yang cepat dan terpantau.
                </p>
            </div>
            <div class="flex justify-center">
                <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.1&auto=format&fit=crop&w=500&q=80"
                     alt="Sistem Pengaduan" class="rounded-lg shadow-md">
            </div>
        </div>

        <!-- Modul Sistem -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Modul Sistem</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Modul Autentikasi</h3>
                    <p class="text-gray-600 text-sm">Sistem keamanan untuk mengelola akses pengguna</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Modul Pengaduan</h3>
                    <p class="text-gray-600 text-sm">Pembuatan dan pengelolaan laporan pengaduan</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Modul Dashboard</h3>
                    <p class="text-gray-600 text-sm">Monitoring dan analisis data pengaduan</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
