<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $cities = array_map('str_getcsv', file('resources/csv/cities.csv'));

        foreach($cities as $city) {
            City::create([
                'name' => $city[1],
            ]);
        }
    }
}
