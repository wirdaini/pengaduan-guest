<?php
namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreatePenilaianLayananDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        // Ambil pengaduan dengan status 'selesai' dan belum ada penilaian
        $pengaduanSelesai = DB::table('pengaduan')
            ->where('status', 'selesai')
            ->whereNotIn('pengaduan_id', function ($query) {
                $query->select('pengaduan_id')->from('penilaian_layanan');
            })
            ->pluck('pengaduan_id')
            ->toArray();

        // DEBUG: Cek data yang diambil
        $this->command->info('Pengaduan Selesai (belum dinilai): ' . count($pengaduanSelesai) . ' data');

        if (empty($pengaduanSelesai)) {
            $this->command->warn('Tidak ada pengaduan selesai yang belum dinilai. Ubah beberapa pengaduan jadi "selesai" dulu.');

            // Coba ubah random 20 pengaduan jadi selesai
            $randomPengaduan = DB::table('pengaduan')
                ->inRandomOrder()
                ->limit(20)
                ->pluck('pengaduan_id')
                ->toArray();

            DB::table('pengaduan')
                ->whereIn('pengaduan_id', $randomPengaduan)
                ->update(['status' => 'selesai']);

            $pengaduanSelesai = $randomPengaduan;
            $this->command->info('Mengubah ' . count($randomPengaduan) . ' pengaduan menjadi "selesai"');
        }

        // Komentar dalam bahasa Indonesia
        $komentarList = [
            // Rating 5 (Sangat Puas)
            'Pelayanan sangat memuaskan, petugas sangat responsif dan cepat tanggap. Terima kasih banyak!',
            'Sangat puas dengan penanganannya, masalah selesai tepat waktu dan hasilnya maksimal.',
            'Petugas sangat profesional dan ramah, proses dari awal sampai akhir berjalan lancar.',
            'Pelayanan luar biasa! Semua staff kooperatif dan solutif.',
            'Respon cepat dan penanganan tepat sasaran. Sangat direkomendasikan!',

            // Rating 4 (Puas)
            'Pelayanan cukup baik, petugas datang tepat waktu dan menangani dengan baik.',
            'Cukup puas dengan hasilnya, meskipun ada sedikit keterlambatan dalam proses.',
            'Penanganan sesuai ekspektasi, komunikasi dengan petugas berjalan lancar.',
            'Masalah terselesaikan dengan baik, terima kasih atas bantuannya.',
            'Pelayanan standar yang baik, tidak ada kendala berarti.',

            // Rating 3 (Cukup Puas)
            'Penanganan cukup baik namun agak lambat responsnya.',
            'Cukup membantu, tetapi ada beberapa hal yang masih perlu diperbaiki.',
            'Secara umum oke, tapi prosedurnya agak berbelit-belit.',
            'Hasilnya sesuai, hanya saja waktu penanganan lebih lama dari yang dijanjikan.',
            'Lumayan, petugasnya ramah tapi kurang komunikatif.',

            // Rating 2 (Tidak Puas)
            'Kurang puas dengan respon waktu, harus menunggu terlalu lama.',
            'Penanganan kurang maksimal, masalah belum sepenuhnya terselesaikan.',
            'Komunikasi dengan petugas kurang baik, informasi tidak jelas.',
            'Proses berbelit-belit, seharusnya bisa lebih sederhana.',
            'Harap perbaiki sistem responsnya, terlalu lambat merespon pengaduan.',

            // Rating 1 (Sangat Tidak Puas)
            'Sangat kecewa, pengaduan tidak ditangani dengan serius.',
            'Tidak ada tindak lanjut sama sekali setelah pengaduan diajukan.',
            'Pelayanan sangat buruk, petugas tidak profesional.',
            'Pengaduan diabaikan, tidak ada feedback sama sekali.',
            'Worst experience, tidak akan mengajukan pengaduan lagi.',
        ];

        $jumlahDinilai = 0;

        foreach ($pengaduanSelesai as $pengaduanId) {
            // Random: 80% pengaduan selesai dapat penilaian (lebih realistis)
            if ($faker->boolean(80)) {
                // Rating distribusi: lebih banyak rating tinggi (simulasi nyata)
                $ratingDistribusi = [
                    5 => 40, // 40% rating 5
                    4 => 30, // 30% rating 4
                    3 => 15, // 15% rating 3
                    2 => 10, // 10% rating 2
                    1 => 5,  // 5% rating 1
                ];

                $rating = $this->getWeightedRandom($ratingDistribusi);

                // Pilih komentar berdasarkan rating
                $komentarByRating = array_filter($komentarList, function ($k) use ($rating) {
                    // Ambil komentar untuk rating tertentu (logika sederhana)
                    $words = ['Sangat puas', 'luar biasa', 'sangat memuaskan'];
                    if ($rating >= 4) {
                        return strpos($k, 'Sangat puas') !== false ||
                        strpos($k, 'sangat memuaskan') !== false ||
                        strpos($k, 'luar biasa') !== false;
                    } elseif ($rating == 3) {
                        return strpos($k, 'Cukup') !== false ||
                        strpos($k, 'Lumayan') !== false;
                    } else {
                        return strpos($k, 'Kurang') !== false ||
                        strpos($k, 'kecewa') !== false ||
                        strpos($k, 'buruk') !== false;
                    }
                });

                // Jika tidak ada komentar spesifik, ambil random
                if (empty($komentarByRating)) {
                    $komentarByRating = $komentarList;
                }

                $komentar = $faker->optional(0.9)->randomElement($komentarByRating);

                // Ambil tanggal pengaduan untuk menentukan tanggal penilaian
                $pengaduanData = DB::table('pengaduan')
                    ->where('pengaduan_id', $pengaduanId)
                    ->first(['created_at', 'updated_at']);

                $createdAt = $faker->dateTimeBetween(
                    $pengaduanData->updated_at ?? $pengaduanData->created_at,
                    '+7 days'
                );

                DB::table('penilaian_layanan')->insert([
                    'pengaduan_id' => $pengaduanId,
                    'rating'       => $rating,
                    'komentar'     => $komentar,
                    'created_at'   => $createdAt,
                    'updated_at'   => $createdAt,
                ]);

                $jumlahDinilai++;
            }
        }

        $totalPenilaian = DB::table('penilaian_layanan')->count();
        $this->command->info('Seeder penilaian layanan berhasil!');
        $this->command->info('Total penilaian baru: ' . $jumlahDinilai);
        $this->command->info('Total penilaian di database: ' . $totalPenilaian);

        // Tampilkan statistik rating
        $stats = DB::table('penilaian_layanan')
            ->select('rating', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('rating')
            ->orderBy('rating', 'desc')
            ->get();

        $this->command->info("\nStatistik Rating:");
        foreach ($stats as $stat) {
            $bintang = str_repeat('⭐', $stat->rating) . str_repeat('☆', 5 - $stat->rating);
            $this->command->info("  {$bintang} ({$stat->rating}): {$stat->jumlah} penilaian");
        }
    }

    /**
     * Helper function untuk weighted random
     */
    private function getWeightedRandom($weights)
    {
        $total   = array_sum($weights);
        $rand    = mt_rand(1, $total);
        $current = 0;

        foreach ($weights as $key => $weight) {
            $current += $weight;
            if ($rand <= $current) {
                return $key;
            }
        }

        return 5; // Default rating 5
    }
}
