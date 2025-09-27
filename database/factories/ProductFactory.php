<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {

              $name = $this->faker->words(5,true);
        return [
            'name'=> $name,
            'slug'=>Str::slug($name),
            'description'=> $this->faker->sentence(15),
            'image'=>$this->faker->imageUrl(600,600),
            'price'=>$this->faker->randomFloat(1,1,999),
            'compare_price'=>$this->faker->randomFloat(1,1000,2000),
            'category_id'=>Category::inRandomOrder()->first()->id,
            'store_id'=>Store::inRandomOrder()->first()->id,
            'featured'=>rand(0,1)
        ];
    }
}
