<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\GenderSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Database\Seeders\SizeAndColorSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            GenderSeeder::class,
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            SizeAndColorSeeder::class,
        ]);
    }
}
