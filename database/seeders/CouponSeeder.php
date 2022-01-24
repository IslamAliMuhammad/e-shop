<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $coupons = [
            ['code' => 'abc123', 'type' => 'fixed', 'discount_amount' => 25, 'min_amount' => 100],
            ['code' => 'efg456', 'type' => 'percent', 'discount_amount' => 50, 'min_amount' => 200],
        ];

        foreach($coupons as $coupon) {
            Coupon::create($coupon);
        }
    }
}
