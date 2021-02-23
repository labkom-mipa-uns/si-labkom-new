<?php
namespace Database\Seeders;

use App\SuratBebasLabkom;
use Illuminate\Database\Seeder;

class SuratBebasLabkomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(SuratBebasLabkom::class, 15)->create();
    }
}
