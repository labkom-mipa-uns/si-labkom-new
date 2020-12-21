<?php
namespace Database\Seeders;

use DosenSeeder;
use Illuminate\Database\Seeder;
use JadwalSeeder;
use JasaInstallasiSeeder;
use JasaPrintSeeder;
use MataKuliahSeeder;
use PeminjamanAlatSeeder;
use PeminjamanLabSeeder;
use ProdiSeeder;
use SuratBebasLabkomSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
//         $this->call(UserSeeder::class);
//        $this->call(DosenSeeder::class);
//        $this->call(MataKuliahSeeder::class);
//        $this->call(ProdiSeeder::class);
//        $this->call(JadwalSeeder::class);
//        $this->call(MahasiswaSeeder::class);
//        $this->call(LabSeeder::class);
        $this->call(PeminjamanLabSeeder::class);
//        $this->call(AlatSeeder::class);
        $this->call(PeminjamanAlatSeeder::class);
        $this->call(SuratBebasLabkomSeeder::class);
        $this->call(JasaInstallasiSeeder::class);
        $this->call(JasaPrintSeeder::class);
    }
}
