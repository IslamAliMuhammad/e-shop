<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $brands = [
            'Nike', 'Louis Vuitton', 'Hermes', 'Gucci', 'Zalando',
            'Adidas', 'Tiffany & Co.', 'Zara', 'H&M', 'Cartier',
            'Lululemon', 'Moncler', 'Chanel', 'Rolex', 'Patek Philippe',
            'Prada', 'Uniqlo', 'Chow Tai Fook', 'Swarovski', 'Burberry'
        ];


        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand
            ]);
        }

    }
}
