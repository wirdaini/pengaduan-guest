<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Panggil seeder lain
        $this->call([
            CreateFirstUser::class,
            CreateUserDummy::class,
            CreateWargaDummy::class,
            CreateKategoriPengaduanDummy::class,
            CreatePengaduanDummy::class,
            CreateTindakLanjutDummy::class,
            CreatePenilaianLayananDummy::class,
        ]);
    }
}
