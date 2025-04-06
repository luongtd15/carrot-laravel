<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;

class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first() ?? User::factory()->create(); // Lấy một người dùng ngẫu nhiên hoặc tạo mới nếu không có
        $product = Product::inRandomOrder()->first() ;
        $quantity = fake()->numberBetween(1, 10);

        return [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $product->price,
            'total_price' => $quantity * $product->price, // Tính total_price từ quantity * price
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
