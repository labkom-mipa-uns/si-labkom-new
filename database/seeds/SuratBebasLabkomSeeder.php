<?php

use App\SuratBebasLabkom;
use Illuminate\Database\Seeder;

class SuratBebasLabkomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SuratBebasLabkom::class, 15)->create();
    }
}
