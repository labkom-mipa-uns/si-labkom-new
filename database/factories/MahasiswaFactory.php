<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mahasiswa;
use App\Prodi;
use Faker\Generator as Faker;

$factory->define(Mahasiswa::class, function (Faker $faker) {
    return [
        'nim' => $faker->randomDigit,
        'nama_mahasiswa' => $faker->name,
        'jenis_kelamin' => 'L',
        'kelas' => $faker->randomDigit,
        'id_prodi' => factory(Prodi::class),
        'angkatan' => '2019',
        'no_hp' => $faker->randomDigit,
        'created_at' => now()
    ];
});
