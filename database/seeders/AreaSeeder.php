<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $areas = array_map('str_getcsv', file('resources/csv/areas.csv'));
        foreach($areas as $area) {
            Area::create([
                'city_id' => $area[1],
                'name' => $area[2],
            ]);
        }
    }
}
