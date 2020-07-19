<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(DosenSeeder::class);
        $this->call(MataKuliahSeeder::class);
        $this->call(ProdiSeeder::class);
        $this->call(JadwalSeeder::class);
        $this->call(MahasiswaSeeder::class);
        $this->call(LabSeeder::class);
        $this->call(PeminjamanLabSeeder::class);
        $this->call(AlatSeeder::class);
        $this->call(PeminjamanAlatSeeder::class);
        $this->call(SuratBebasLabkomSeeder::class);
        $this->call(JasaInstallasiSeeder::class);
        $this->call(JasaPrintSeeder::class);
    }
}
