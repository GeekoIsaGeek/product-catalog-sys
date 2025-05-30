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
        if(Category::count() > 0) {
            return; 
        }

        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics'],
            ['name' => 'Books', 'slug' => 'books'],
            ['name' => 'Home & Kitchen', 'slug' => 'home-kitchen'],
            ['name' => 'Fashion', 'slug' => 'fashion'],
            ['name' => 'Toys & Games', 'slug' => 'toys-games'],
            ['name' => 'Sports & Outdoors', 'slug' => 'sports-outdoors'],
            ['name' => 'Health & Beauty', 'slug' => 'health-beauty'],
            ['name' => 'Automotive', 'slug' => 'automotive'],
            ['name' => 'Music', 'slug' => 'music'],
            ['name' => 'Movies & TV', 'slug' => 'movies-tv'],
            ['name' => 'Grocery', 'slug' => 'grocery'],
            ['name' => 'Pet Supplies', 'slug' => 'pet-supplies'],
            ['name' => 'Office Products', 'slug' => 'office-products'],
            ['name' => 'Garden & Outdoor', 'slug' => 'garden-outdoor'],
            ['name' => 'Tools & Hardware', 'slug' => 'tools-hardware'],
            ['name' => 'Baby Products', 'slug' => 'baby-products'],
            ['name' => 'Video Games', 'slug' => 'video-games'],
            ['name' => 'Jewelry', 'slug' => 'jewelry'],
            ['name' => 'Watches', 'slug' => 'watches'],
            ['name' => 'Industrial & Scientific', 'slug' => 'industrial-scientific'],
        ];

        foreach ($categories as $category){
            Category::create([
                'name' => $category['name'],
                'slug' => $category['slug'],
            ]);
        }
    }
}
