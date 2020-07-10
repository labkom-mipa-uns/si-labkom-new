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
        $this->call(LabSeeder::class);
        $this->call(MataKuliahSeeder::class);
        $this->call(ProdiSeeder::class);
        $this->call(MahasiswaSeeder::class);
        $this->call(PeminjamanLabSeeder::class);
    }
}
