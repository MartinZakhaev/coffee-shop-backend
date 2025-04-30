<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coffeeCategory = Category::where('name', 'Coffee')->first();
        $teaCategory = Category::where('name', 'Tea')->first();
        $pastryCategory = Category::where('name', 'Pastry')->first();
        $sandwichCategory = Category::where('name', 'Sandwich')->first();
        $dessertCategory = Category::where('name', 'Dessert')->first();

        // Coffee products
        $coffeeProducts = [
            [
                'name' => 'Espresso',
                'description' => 'Strong black coffee made by forcing steam through ground coffee beans',
                'price_regular' => 35000, // IDR values
                'price_member' => 30000,  // IDR values
                'stock' => 100,
            ],
            [
                'name' => 'Cappuccino',
                'description' => 'Coffee with steamed milk foam',
                'price_regular' => 45000, // IDR values
                'price_member' => 40000,  // IDR values
                'stock' => 100,
            ],
            [
                'name' => 'Latte',
                'description' => 'Coffee with steamed milk',
                'price_regular' => 40000, // IDR values
                'price_member' => 35000,  // IDR values
                'stock' => 100,
            ],
        ];

        foreach ($coffeeProducts as $product) {
            Product::create(array_merge($product, ['category_id' => $coffeeCategory->id]));
        }

        // Tea products
        $teaProducts = [
            [
                'name' => 'Green Tea',
                'description' => 'Traditional green tea',
                'price_regular' => 30000, // IDR values
                'price_member' => 25000,  // IDR values
                'stock' => 100,
            ],
            [
                'name' => 'Earl Grey',
                'description' => 'Black tea with bergamot oil',
                'price_regular' => 30000, // IDR values
                'price_member' => 25000,  // IDR values
                'stock' => 100,
            ],
        ];

        foreach ($teaProducts as $product) {
            Product::create(array_merge($product, ['category_id' => $teaCategory->id]));
        }

        // Pastry products
        $pastryProducts = [
            [
                'name' => 'Croissant',
                'description' => 'Buttery, flaky pastry',
                'price_regular' => 30000, // IDR values
                'price_member' => 25000,  // IDR values
                'stock' => 50,
            ],
            [
                'name' => 'Cinnamon Roll',
                'description' => 'Sweet roll with cinnamon and frosting',
                'price_regular' => 35000, // IDR values
                'price_member' => 30000,  // IDR values
                'stock' => 50,
            ],
        ];

        foreach ($pastryProducts as $product) {
            Product::create(array_merge($product, ['category_id' => $pastryCategory->id]));
        }

        // Add more products for other categories as needed
    }
}
