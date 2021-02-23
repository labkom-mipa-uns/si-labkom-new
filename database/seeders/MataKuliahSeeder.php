<?php
namespace Database\Seeders;

use App\MataKuliah;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(MataKuliah::class, 15)->create();
    }
}
