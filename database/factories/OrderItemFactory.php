<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Variation;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
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
            'order_id' => Order::factory(),
            'variation_id' => Variation::factory(),
            'qty' => rand(10, 500),
        ];
    }
}
