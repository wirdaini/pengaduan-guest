<?php
namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\PenilaianLayanan;
use App\Models\Warga;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Total pengaduan selesai
        $totalSelesai = Pengaduan::where('status', 'selesai')->count();

        // 2. Rating kepuasan
        $ratings = PenilaianLayanan::all();
        if ($ratings->count() > 0) {
            $avgRating = $ratings->avg('rating');
            $kepuasan  = round(($avgRating / 5) * 100);
        } else {
            $kepuasan = 95;
        }

        // 3. Desa terlayani - PAKAI 'pengaduan' (SINGULAR)
        $desaTerlayani = Warga::has('pengaduan')->count();

        // 4. Data untuk floating cards
        $pengaduanTerbaru = Pengaduan::with('warga')
            ->where('status', '!=', 'ditolak')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $avgRatingDisplay = $ratings->count() > 0
            ? round($ratings->avg('rating'), 1)
            : 4.9;
        $totalReviews = $ratings->count();

        // 5. Hero images
        $heroImages = [
            'desa/home1.jpg',
            'desa/home2.jpg',
            'desa/home3.jpg',
            'desa/home4.jpg',
        ];
        $currentHeroImage = $heroImages[array_rand($heroImages)];

        // 6. About section data
        $aboutData = [
            'wargaTerdaftar'  => Warga::count(),
            'totalPengaduan'  => Pengaduan::count(),
            'tahunBeroperasi' => now()->year - 2023,
            'timTerlatih'     => 8,
        ];

        $testimonials = PenilaianLayanan::with(['pengaduan.warga'])
            ->whereNotNull('komentar')    // hanya yang ada komentar
            ->where('komentar', '!=', '') // komentar tidak kosong
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // 7. Return semua data
        return view('pages.home.landing', array_merge(
            [
                'totalSelesai'     => $totalSelesai,
                'kepuasan'         => $kepuasan,
                'desaTerlayani'    => $desaTerlayani,
                'pengaduanTerbaru' => $pengaduanTerbaru,
                'avgRating'        => $avgRatingDisplay,
                'totalReviews'     => $totalReviews,
                'heroImage'        => $currentHeroImage,
                'heroImages'       => $heroImages,
                'testimonials'     => $testimonials,

            ],
            $aboutData
        ));
    }
}
