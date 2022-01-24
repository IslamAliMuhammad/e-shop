<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
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
            'address_id' => rand(1, 6),
            'user_id' => rand(1, 30),
            'total' => rand(100, 10000),
            'created_at' => $this->faker->dateTimeThisYear('+12 months'),
        ];
    }
}
