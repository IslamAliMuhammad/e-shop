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
<<<<<<< HEAD
            'product_id' => rand(1, 6),
=======
            'product_id' => rand(1, 60),
>>>>>>> dev
            'rating' => rand(1, 5),
            'body' => $this->faker->sentence(),
            'reviewer_name' => $this->faker->name(),
            'reviewer_email' => $this->faker->email()
        ];
    }
}
