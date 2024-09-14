<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Ensure there are categories before creating products
         if (Category::count() == 0) {
            $this->call(CategorySeeder::class); // Ensure categories exist
        }

        // Create products, each with a random category
        Product::factory(50)->create();
    }
}