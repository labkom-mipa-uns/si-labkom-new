<?php
namespace Database\Factories;

use App\Prodi;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prodi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'nama_prodi' => $this->faker->jobTitle,
            'created_at' => now(),
        ];
    }
}
