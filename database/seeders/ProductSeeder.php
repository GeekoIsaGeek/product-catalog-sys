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
        if (Product::count() > 0) {
            return; 
        }

        $categoryIds = Category::pluck('id')->toArray();

        $batchSize = 500;
        $total = 60000;

        for($i= 0; $i < $total; $i+= $batchSize) { 
            $products = Product::factory()->setCategoryIds($categoryIds)->count($batchSize)->make()->toArray();
            Product::insert($products);
        }
    }
}
