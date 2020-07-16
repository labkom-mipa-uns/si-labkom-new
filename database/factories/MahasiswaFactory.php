<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mahasiswa;
use App\Prodi;
use Faker\Generator as Faker;

$factory->define(Mahasiswa::class, function (Faker $faker) {
    return [
        'nim' => $faker->randomNumber(8),
        'nama_mahasiswa' => $faker->name,
        'jenis_kelamin' => $faker->randomElement(['L','P']),
        'kelas' => $faker->randomElement(['TIA','TIB','TID']),
        'id_prodi' => factory(Prodi::class),
        'angkatan' => $faker->randomElement(['2016','2017','2018','2019','2020']),
        'no_hp' => $faker->phoneNumber,
        'created_at' => now()
    ];
});
