<?php

use App\JasaPrint;
use Illuminate\Database\Seeder;

class JasaPrintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(JasaPrint::class, 15)->create();
    }
}
