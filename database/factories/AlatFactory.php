<?php
namespace Database\Factories;

use App\Alat;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Alat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'nama_alat' => $this->faker->company,
            'harga_alat' => $this->faker->randomNumber(6),
            'stok_alat' => $this->faker->randomNumber(2)
        ];
    }
}
