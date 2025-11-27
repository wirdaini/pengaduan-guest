<?php
namespace Database\Seeders;

use App\Models\KategoriPengaduan;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CreateKategoriPengaduanDummy extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create('id_ID'); // Faker Bahasa Indonesia

        // Data kategori pengaduan yang umum
        $kategoriList = [
            'Infrastruktur Jalan', 'Kebersihan Lingkungan',
            'Saluran Air', 'Keamanan Lingkungan', 'Layanan Kesehatan',
            'Aspirasi Pembangunan', 'Pengaduan Sosial', 'Fasilitas Umum',
            'Lingkungan Hidup', 'Transportasi', 'Pendidikan', 'Kesehatan Masyarakat',
            'Bencana Alam', 'Pelayanan Publik', 'Administrasi Kependudukan',
        ];

        // Prioritas dan SLA mapping
        $prioritasSla = [
            'Rendah' => ['min' => 10, 'max' => 30],
            'Sedang' => ['min' => 5, 'max' => 14],
            'Tinggi' => ['min' => 2, 'max' => 7],
            'Kritis' => ['min' => 1, 'max' => 3],
        ];

        foreach (range(1, 15) as $index) {
            $prioritas = $faker->randomElement(['Rendah', 'Sedang', 'Tinggi', 'Kritis']);
            $slaRange  = $prioritasSla[$prioritas];

            KategoriPengaduan::create([
                'nama'       => $faker->unique()->randomElement($kategoriList),
                'sla_hari'   => $faker->numberBetween($slaRange['min'], $slaRange['max']),
                'prioritas'  => $prioritas,
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'updated_at' => now(),
            ]);
        }
    }
}
