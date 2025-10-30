<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriPengaduan;

class KategoriPengaduanSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            ['nama' => 'Infrastruktur Jalan', 'sla_hari' => 7, 'prioritas' => 'Tinggi'],
            ['nama' => 'Kebersihan Lingkungan', 'sla_hari' => 3, 'prioritas' => 'Sedang'],
            ['nama' => 'Penerangan Jalan', 'sla_hari' => 5, 'prioritas' => 'Sedang'],
            ['nama' => 'Saluran Air', 'sla_hari' => 5, 'prioritas' => 'Tinggi'],
            ['nama' => 'Keamanan Lingkungan', 'sla_hari' => 1, 'prioritas' => 'Kritis'],
            ['nama' => 'Layanan Kesehatan', 'sla_hari' => 2, 'prioritas' => 'Tinggi'],
            ['nama' => 'Aspirasi Pembangunan', 'sla_hari' => 14, 'prioritas' => 'Rendah'],
        ];

        foreach ($kategori as $data) {
            KategoriPengaduan::create($data);
        }
    }
}
