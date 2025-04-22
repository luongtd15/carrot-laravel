<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(4)->create([
            'password' => 'luong9011',
            'role' => 'user'
        ]);

        User::factory(1)->create([
            'email' => 'admin@gmail.com',
            'password' => 'luong9011',
            'role' => 'admin'
        ]);

        $categories = [
            ['name' => 'Shirts', 'description' => 'Men\'s shirts for all occasions', 'image' => null, 'is_active' => true],
            ['name' => 'Trousers', 'description' => 'Stylish trousers for men', 'image' => null, 'is_active' => true],
            ['name' => 'T-Shirts', 'description' => 'Casual T-shirts for daily wear', 'image' => null, 'is_active' => true],
            ['name' => 'Shorts', 'description' => 'Comfortable shorts for men', 'image' => null, 'is_active' => true],
            ['name' => 'Men\'s Shoes', 'description' => 'Elegant and durable shoes', 'image' => null, 'is_active' => true],
            ['name' => 'Accessories', 'description' => 'Belts, ties, and more', 'image' => null, 'is_active' => true],
        ];

        // Thêm 7 danh mục vào database
        foreach ($categories as $category) {
            Category::create($category);
        }

        Product::factory('50')->create();

        Cart::factory(20)->create();

        \App\Models\Address::factory(10)->create();

        \App\Models\Comment::factory(100)->create();
    }
}
