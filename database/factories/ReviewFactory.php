<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
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
            'product_id' => rand(1, 60),
            'rating' => rand(1, 5),
            'body' => $this->faker->sentence(),
            'reviewer_name' => $this->faker->name(),
            'reviewer_email' => $this->faker->email()
        ];
    }
}
