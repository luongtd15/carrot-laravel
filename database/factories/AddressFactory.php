<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first() ?? User::factory()->create();
        return [
            'user_id' => $user->id,
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'district' => fake()->city(),
            'commune' => fake()->city(),
            'is_default' => fake()->boolean(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
