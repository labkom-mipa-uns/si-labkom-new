<?php

use App\PeminjamanAlat;
use Illuminate\Database\Seeder;

class PeminjamanAlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PeminjamanAlat::class, 15)->create();
    }
}
