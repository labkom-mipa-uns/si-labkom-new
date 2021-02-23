<?php
namespace Database\Seeders;

use App\PeminjamanAlat;
use Illuminate\Database\Seeder;

class PeminjamanAlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(PeminjamanAlat::class, 15)->create();
    }
}
