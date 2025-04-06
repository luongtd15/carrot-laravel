<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->randomElement([
            'White Men\'s Shirt',
            'Office Trousers',
            'Basic Men\'s T-Shirt',
            'Bomber Jacket',
            'Khaki Shorts',
            'Leather Dress Shoes',
            'Men\'s Belt'
        ]);

        $price = fake()->randomFloat(2, 10, 200); // Price from $10 to $200
        $salePrice = fake()->optional(0.3)->randomFloat(2, 5, $price - 1);

        return [
            'name' => $name,
            'slug' => Str::slug($name . '-' . fake()->unique()->numberBetween(1, 1000)), // Unique slug
            'description' => fake()->paragraph(), // Random paragraph in English
            'short_description' => fake()->sentence(5), // Short sentence in English
            'category_id' => Category::inRandomOrder()->first()->id,
            'price' => $price, // Price from $10 to $200
            'sale_price' => $salePrice, // 30% chance of sale price
            'quantity' => fake()->numberBetween(0, 100), // Stock quantity
            'sold_count' => fake()->numberBetween(0, 50), // Sold quantity
            'is_active' => fake()->boolean(95), // 95% chance of being active
            'is_featured' => fake()->boolean(50), // 20% chance of being featured
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
