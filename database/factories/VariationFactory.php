<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class VariationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'product_id' => $this->faker->numberBetween(1, 6),
            'size_id' => $this->faker->numberBetween(1, 25),
            'color_id' => $this->faker->numberBetween(1, 16),
            'sku' => $this->faker->word(),
            'stock' => $this->faker->numberBetween(10, 50)
        ];
    }
}
