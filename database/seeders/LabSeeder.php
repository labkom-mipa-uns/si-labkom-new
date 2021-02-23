<?php
namespace Database\Seeders;

use App\Lab;
use Illuminate\Database\Seeder;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(Lab::class, 15)->create();
    }
}
