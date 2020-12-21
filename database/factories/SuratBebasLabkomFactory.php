<?php
namespace Database\Factories;

use App\Mahasiswa;
use App\SuratBebasLabkom;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuratBebasLabkomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SuratBebasLabkom::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'id_mahasiswa' => factory(Mahasiswa::class),
            'tanggal' => $this->faker->date(),
            'keperluan' => $this->faker->paragraph(5)
        ];
    }
}

