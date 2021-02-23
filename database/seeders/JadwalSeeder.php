<?php
namespace Database\Seeders;

use App\Jadwal;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(Jadwal::class, 15)->create();
    }
}
