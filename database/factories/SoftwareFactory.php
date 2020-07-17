<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Software;
use Faker\Generator as Faker;

$factory->define(Software::class, function (Faker $faker) {
    return [
        'nama_software' => $faker->company,
        'harga_software' => $faker->randomNumber(8)
    ];
});
