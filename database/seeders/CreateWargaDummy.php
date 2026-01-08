<?php
namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;

class CreateWargaDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker         = Factory::create('id_ID');
        $agamaList     = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        $pekerjaanList = [
            'Wiraswasta', 'PNS', 'Guru', 'Dosen', 'Dokter', 'Perawat',
            'Karyawan Swasta', 'Petani', 'Nelayan', 'Pedagang', 'Sopir',
            'Buruh', 'Ibu Rumah Tangga', 'Pelajar/Mahasiswa', 'Pensiunan',
        ];

        // ✅ AMBIL SEMUA USER YANG SUDAH DIBUAT
        $users = \App\Models\User::all();

        foreach ($users as $index => $user) {
            // ✅ HANYA BUAT WARGA UNTUK USER DENGAN ROLE 'warga'
            if ($user->role === 'warga') {
                $jenisKelamin = $faker->randomElement(['L', 'P']);
                $firstName    = $jenisKelamin === 'L' ? $faker->firstNameMale : $faker->firstNameFemale;

                \App\Models\Warga::create([
                    'user_id'       => $user->id, // ✅ LINK DENGAN USER
                    'no_ktp'        => $faker->unique()->numerify('32##############'),
                    'nama'          => $user->name, // ✅ PAKAI NAMA SAMA DENGAN USER
                    'jenis_kelamin' => $jenisKelamin,
                    'agama'         => $faker->randomElement($agamaList),
                    'pekerjaan'     => $faker->randomElement($pekerjaanList),
                    'telp'          => '+62' . $faker->numerify('8##########'),
                    'email'         => $user->email, // ✅ PAKAI EMAIL SAMA DENGAN USER
                ]);
            }
        }
    }
}

