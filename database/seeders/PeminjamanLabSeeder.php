<?php
namespace Database\Seeders;

use App\PeminjamanLab;
use Illuminate\Database\Seeder;

class PeminjamanLabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(PeminjamanLab::class, 15)->create();
    }
}
