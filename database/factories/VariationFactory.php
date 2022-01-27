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
<<<<<<< HEAD
            'product_id' => $this->faker->numberBetween(1, 6),
=======
            'product_id' => $this->faker->numberBetween(1, 60),
>>>>>>> dev
            'size_id' => $this->faker->numberBetween(1, 25),
            'color_id' => $this->faker->numberBetween(1, 15),
            'sku' => $this->faker->word(),
            'stock' => $this->faker->numberBetween(10, 50)
        ];
    }
}
