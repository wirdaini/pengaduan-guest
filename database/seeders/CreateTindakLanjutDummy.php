<?php
namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateTindakLanjutDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        // PASTIKAN ambil pengaduan_id yang sudah ada
        $pengaduanIds = DB::table('pengaduan')->pluck('pengaduan_id')->toArray();

        // DEBUG: Cek data yang diambil
        $this->command->info('Pengaduan IDs: ' . implode(', ', array_slice($pengaduanIds, 0, 10)) . '...');
        $this->command->info('Total Pengaduan: ' . count($pengaduanIds));

        if (empty($pengaduanIds)) {
            $this->command->error('DATA PENGADUAN KOSONG! Jalankan CreatePengaduanDummy dulu.');
            return;
        }

        // Data dummy petugas
        $petugasList = [
            'Budi Santoso', 'Siti Rahayu', 'Agus Wijaya', 'Rina Permata',
            'Joko Prasetyo', 'Dewi Lestari', 'Ahmad Fauzi', 'Maya Indah',
            'Hendra Gunawan', 'Linda Sari', 'Rudi Hartono', 'Sari Dewi',
        ];

        // Aksi yang umum dilakukan
        $aksiList = [
            'Melakukan survey lokasi pengaduan',
            'Koordinasi dengan pihak terkait untuk penanganan',
            'Pembersihan area yang dilaporkan',
            'Perbaikan infrastruktur yang rusak',
            'Pemberian sosialisasi kepada warga',
            'Pengambilan sampel untuk investigasi',
            'Pemasangan pemberitahuan di lokasi',
            'Evaluasi kondisi berdasarkan laporan',
            'Konsultasi dengan warga sekitar',
            'Penyusunan laporan hasil pengecekan',
            'Penanganan langsung di lapangan',
            'Pemantauan perkembangan kondisi',
            'Perbaikan sementara sebagai solusi darurat',
            'Koordinasi dengan RT/RW setempat',
        ];

        // Catatan tambahan
        $catatanList = [
            'Kondisi memerlukan penanganan segera',
            'Telah dikoordinasikan dengan RT setempat',
            'Memerlukan anggaran tambahan untuk penanganan',
            'Sudah sesuai dengan prosedur standar',
            'Menunggu persetujuan dari atasan',
            'Akan dilanjutkan penanganannya minggu depan',
            'Memerlukan alat khusus yang sedang dipersiapkan',
            'Cuaca menghambat proses penanganan',
            'Respon warga sangat positif terhadap penanganan',
            'Perlu monitoring lanjutan untuk evaluasi',
            'Sudah dilakukan koordinasi dengan dinas terkait',
            'Penanganan tahap pertama sudah selesai',
            'Memerlukan waktu lebih lama dari perkiraan',
            'Tidak ada kendala dalam proses penanganan',
        ];

        foreach ($pengaduanIds as $pengaduanId) {
            // Random: 30% pengaduan punya tindak lanjut
            if ($faker->boolean(30)) {
                // Random: 1-3 tindak lanjut per pengaduan
                $jumlahTindak = $faker->numberBetween(1, 3);

                for ($i = 1; $i <= $jumlahTindak; $i++) {
                    $createdAt = now()->subDays($faker->numberBetween(0, 30));

                    DB::table('tindak_lanjut')->insert([
                        'pengaduan_id' => $pengaduanId,
                        'petugas'      => $faker->randomElement($petugasList),
                        'aksi'         => $faker->randomElement($aksiList),
                        'catatan'      => $faker->optional(0.7)->randomElement($catatanList),
                        'created_at'   => $createdAt,
                        'updated_at'   => $createdAt->addHours($faker->numberBetween(1, 24)),
                    ]);
                }

                // Update status pengaduan jika ada tindak lanjut
                $status = $faker->randomElement(['diproses', 'selesai']);
                DB::table('pengaduan')
                    ->where('pengaduan_id', $pengaduanId)
                    ->update(['status' => $status]);
            }
        }

        $totalTindakLanjut = DB::table('tindak_lanjut')->count();
        $this->command->info('Seeder tindak lanjut berhasil! Total: ' . $totalTindakLanjut . ' data');
    }
}
