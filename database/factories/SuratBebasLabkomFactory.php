<?php
namespace Database\Factories;

use App\Models\Mahasiswa;
use App\Models\SuratBebasLabkom;
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
            'id_mahasiswa' => Mahasiswa::factory()->count(1)->create(),
            'tanggal' => $this->faker->date(),
            'keperluan' => $this->faker->paragraph(5)
        ];
    }
}

