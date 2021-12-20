<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\SuperAdminSeeder;
use Database\Seeders\GenderSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use App\Models\Color;
use App\Models\Size;
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
            SuperAdminSeeder::class,
            Color::class,
            Size::class,
        ]);
    }
}
