<?php

namespace Database\Factories;

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
    public function definition()
    {
        $name = $this->faker->sentence(7);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraphs(5, true),
            'cost_price' => $cp = random_int(100, 10000),
            'price' => 1.2 * $cp,
            'featured' => $this->faker->boolean(),
            'show_on_slider' => $this->faker->boolean(),
            'active' => $this->faker->boolean(70),
            'creator_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
