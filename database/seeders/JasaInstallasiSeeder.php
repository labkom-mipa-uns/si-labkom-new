<?php
namespace Database\Seeders;

use App\JasaInstallasi;
use Illuminate\Database\Seeder;

class JasaInstallasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(JasaInstallasi::class, 15)->create();
    }
}
