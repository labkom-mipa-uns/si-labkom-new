<?php
namespace Database\Seeders;

use App\Dosen;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(Dosen::class, 15)->create();
    }
}
