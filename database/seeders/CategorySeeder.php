<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            ['name' => 'Shirts', 'description' => 'Men\'s shirts for all occasions', 'image' => null, 'is_active' => true],
            ['name' => 'Trousers', 'description' => 'Stylish trousers for men', 'image' => null, 'is_active' => true],
            ['name' => 'T-Shirts', 'description' => 'Casual T-shirts for daily wear', 'image' => null, 'is_active' => true],
            ['name' => 'Jackets', 'description' => 'Warm and fashionable jackets', 'image' => null, 'is_active' => true],
            ['name' => 'Shorts', 'description' => 'Comfortable shorts for men', 'image' => null, 'is_active' => true],
            ['name' => 'Men\'s Shoes', 'description' => 'Elegant and durable shoes', 'image' => null, 'is_active' => true],
            ['name' => 'Accessories', 'description' => 'Belts, ties, and more', 'image' => null, 'is_active' => true],
        ];

        // Thêm 7 danh mục vào database
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
