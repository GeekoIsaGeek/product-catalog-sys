<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    private static array $categoryIds = [];

    public function setCategoryIds(array $categoryIds)
    {
        self::$categoryIds = $categoryIds;
        return $this;
    }

    public function definition(): array
    {   
        return [
            'name' => $name = $this->faker->words(3, asText: true),
            'slug' => Str::slug($name . '-' . Str::random(8)),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'stock' => $this->faker->numberBetween(0, 100),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'category_id' => $this->faker->randomElement(static::$categoryIds),
        ];
    }
}
