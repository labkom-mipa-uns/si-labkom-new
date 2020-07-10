<?php

use App\PeminjamanLab;
use Illuminate\Database\Seeder;

class PeminjamanLabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PeminjamanLab::class, 15)->create();
    }
}
