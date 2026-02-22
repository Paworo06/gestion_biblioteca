<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => fake()->sentence(3),
            'autor' => fake()->name(),
            'isbn' => fake()->unique()->isbn13(),
            'descripcion' => fake()->paragraph(),
            'stock' => fake()->numberBetween(1,5),
        ];
    }
}
