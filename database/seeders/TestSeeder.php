<?php

namespace Database\Seeders;

use App\Models\Discount;
use App\Models\User;
use App\Models\Variation;
use Illuminate\Database\Seeder;
use Database\Seeders\SubcategorySeeder;
use Database\Seeders\ProductSeeder;
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
        User::factory()->count(30)->create();

        $this->call([
            BrandSeeder::class,
            CategorySeeder::class,
            SubcategorySeeder::class,
            DiscountSeeder::class,
            ProductSeeder::class,
            VariationSeeder::class,
        ]);

    }
}
