<?php
namespace Database\Factories;

use App\Dosen;
use Illuminate\Database\Eloquent\Factories\Factory;

class DosenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dosen::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'nidn' => $this->faker->randomNumber(8),
            'nama_dosen' => $this->faker->name,
            'created_at' => now()
        ];
    }
}
