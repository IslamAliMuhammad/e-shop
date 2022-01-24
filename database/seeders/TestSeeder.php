<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\CouponSeeder;
use Database\Seeders\ReviewSeeder;
use Database\Seeders\AddressSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\SubcategorySeeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // create users

        $this->call([
            AddressSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            SubcategorySeeder::class,
            DiscountSeeder::class,
            ProductSeeder::class,
            VariationSeeder::class,
            ReviewSeeder::class,
            CouponSeeder::class,
            OrderSeeder::class,
        ]);

    }
}
