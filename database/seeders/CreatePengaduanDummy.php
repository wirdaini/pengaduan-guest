<?php
namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreatePengaduanDummy extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        // PASTIKAN ambil warga_id yang benar (bukan id)
        $wargaIds    = DB::table('warga')->pluck('warga_id')->toArray();
        $kategoriIds = DB::table('kategori_pengaduan')->pluck('kategori_id')->toArray();

        // DEBUG: Cek data yang diambil
        $this->command->info('Warga IDs: ' . implode(', ', $wargaIds));
        $this->command->info('Kategori IDs: ' . implode(', ', $kategoriIds));

        if (empty($wargaIds)) {
            $this->command->error('DATA WARGA KOSONG! Jalankan WargaSeeder dulu.');
            return;
        }

        if (empty($kategoriIds)) {
            $this->command->error('DATA KATEGORI KOSONG! Jalankan CreateKategoriPengaduanDummy dulu.');
            return;
        }

        // Custom Faker dengan kata-kata Indonesia
        $kataIndo = [
            'jalan rusak', 'sampah menumpuk', 'lampu jalan mati', 'air bersih keruh',
            'listrik sering padam', 'banjir', 'trotoar rusak', 'parkir liar',
            'fasilitas umum tidak terawat', 'lingkungan kumuh', 'drainase tersumbat',
            'gangguan keamanan', 'kebisingan', 'penerangan jalan tidak memadai'
        ];

        foreach (range(1, 200) as $index) {
            $issue = $faker->randomElement($kataIndo);

            DB::table('pengaduan')->insert([
                'nomor_tiket' => 'PGD-' . now()->format('YmdHis') . '-' . $index,
                'warga_id'    => $faker->randomElement($wargaIds),
                'kategori_id' => $faker->randomElement($kategoriIds),
                'judul'       => 'Pengaduan ' . $issue . ' di ' . $faker->city,
                'deskripsi'   => 'Warga mengeluhkan ' . $issue . ' yang terjadi di ' . $faker->streetAddress . '. Kejadian ini sudah berlangsung selama ' . $faker->numberBetween(1, 7) . ' hari dan sangat mengganggu aktivitas warga sehari-hari.',
                'lokasi_text' => $faker->streetAddress,
                'rt'          => $faker->randomElement(['001', '002', '003']),
                'rw'          => $faker->randomElement(['001', '002']),
                'bukti_foto'  => null,
                'status'      => $faker->randomElement(['menunggu', 'diproses', 'selesai', 'ditolak']),
                'tanggapan'   => $faker->optional()->sentence(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        $this->command->info('Seeder pengaduan berhasil!');
    }
}
