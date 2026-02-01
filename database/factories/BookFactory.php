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
        $stock = rand(5, 15);
        return [
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
            'title' => fake()->sentence(3),
            'author' => fake()->name(),
            'isbn' => fake()->isbn13(),
            'description' => fake()->paragraph(),
            'cover_image' => 'https://picsum.photos/seed/' . rand(1, 1000) . '/400/600',
            'total_stock' => $stock,
            'available_stock' => $stock,
        ];
    }
}
