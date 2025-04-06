<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Shirts', 'Trousers', 'T-Shirts', 'Jackets', 'Shorts', 'Men\'s Shoes', 'Accessories']),
            'description' => fake()->optional()->sentence(10), // Random sentence in English
            'image' => fake()->optional()->imageUrl(640, 480, 'fashion'), // Fake image URL
            'is_active' => fake()->boolean(90), // 90% chance of being true
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
