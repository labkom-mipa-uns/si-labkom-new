<?php
namespace Database\Seeders;


use App\Alat;
use Illuminate\Database\Seeder;

class AlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(Alat::class, 15)->create();
    }
}
