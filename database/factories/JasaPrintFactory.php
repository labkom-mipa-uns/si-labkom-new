<?php
namespace Database\Factories;

use App\Models\JasaPrint;
use Illuminate\Database\Eloquent\Factories\Factory;

class JasaPrintFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JasaPrint::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'jenis_print' => $this->faker->randomElement(['Hitam Putih', 'Warna', 'Warna-full']),
            'harga_print' => $this->faker->randomNumber(8),
            'jumlah_print' => $this->faker->randomNumber(2),
            'tanggal_print' => $this->faker->date()
        ];
    }
}
