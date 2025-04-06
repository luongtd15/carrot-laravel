<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $user = User::inRandomOrder()->first(); // Lấy một người dùng ngẫu nhiên
        $address = Address::inRandomOrder()->first(); // Lấy một người dùng ngẫu nhiên
        return [
            //
            'user_id' => $user->id, // Tạo một người dùng mới
            'status' => fake()->randomElement(['pending', 'confirmed', 'delivering', 'completed', 'cancelled']),
            'total_amount' => $this->faker->numberBetween(100000, 1000000), // Tổng tiền ngẫu nhiên
            'created_at' => now(),
            'updated_at' => now(),
            'address_id' => $address
        ];
    }
}
