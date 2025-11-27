<?php
namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateWargaDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        // BUAT USER DULU JIKA BELUM ADA
        if (User::count() === 0) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
            ]);
        }

        $user = User::first(); // Pakai user yang sudah ada

        // Data agama dalam Bahasa Indonesia
        $agamaList = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];

        // Data pekerjaan yang umum di Indonesia
        $pekerjaanList = [
            'Wiraswasta', 'PNS', 'Guru', 'Dosen', 'Dokter', 'Perawat',
            'Karyawan Swasta', 'Petani', 'Nelayan', 'Pedagang', 'Sopir',
            'Buruh', 'Ibu Rumah Tangga', 'Pelajar/Mahasiswa', 'Pensiunan',
        ];

        foreach (range(1, 200) as $index) {
            $jenisKelamin = $faker->randomElement(['L', 'P']);
            $firstName    = $jenisKelamin === 'L' ? $faker->firstNameMale : $faker->firstNameFemale;

            DB::table('warga')->insert([
                'user_id'       => User::inRandomOrder()->first()->id,
                'no_ktp'        => $faker->unique()->numerify('32##############'),
                'nama'          => $firstName . ' ' . $faker->lastName,
                'jenis_kelamin' => $jenisKelamin,
                'agama'         => $faker->randomElement($agamaList),
                'pekerjaan'     => $faker->randomElement($pekerjaanList),
                'telp'          => '+62' . $faker->numerify('8##########'), // +6281234567890 (15 digit)
                'email'         => $faker->unique()->safeEmail,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
