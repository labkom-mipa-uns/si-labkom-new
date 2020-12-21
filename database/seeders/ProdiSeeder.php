<?php
namespace Database\Seeders;

use App\Prodi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(Prodi::class, 15)->create();
    }
}
