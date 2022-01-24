<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
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
            'user_id' => User::factory(),
            'address_line1' => $this->faker->address(),
            'area_id' => rand(1, 10),
            'postal_code' => rand(1000, 5000),
            'mobile_number' => $this->faker->phoneNumber(),
        ];
    }
}
