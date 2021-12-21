<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        User::factory()->count(30)->create();

        $this->call([
            BrandSeeder::class,
            CategorySeeder::class,
            SubcategorySeeder::class,
        ]);

    }
}
