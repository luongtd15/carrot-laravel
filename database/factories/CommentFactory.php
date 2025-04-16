<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $product = Product::inRandomOrder()->first();
        return [
            //
            'user_id' => $user->id,
            'product_id' => $product->id,
            'rating' => fake()->numberBetween(1, 5),
            'content' => fake()->text(200),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
