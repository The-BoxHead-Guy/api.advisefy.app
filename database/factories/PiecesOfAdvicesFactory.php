<?php

namespace Database\Factories;

use App\Models\PiecesOfAdvices;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Import Str for unique text

class PiecesOfAdvicesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PiecesOfAdvices::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author' => fake()->name(), // Generates a random name for the author
            'text' => fake()->unique()->sentence(rand(5, 15), true), // Generates a unique sentence as advice text
        ];
    }
}
