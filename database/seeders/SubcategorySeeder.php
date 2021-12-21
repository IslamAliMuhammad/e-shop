<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subcategory;
class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $subcategories = ['Coats', 'Jackets', 'Dresses', 'Shirts', 'T-shirts', 'Jeans'];

        foreach ($subcategories as $subcategory) {
            Subcategory::create([
                'category_id' => 1,
                'name' => $subcategory
            ]);
        }

        foreach ($subcategories as $subcategory) {
            Subcategory::create([
                'category_id' => 2,
                'name' => $subcategory
            ]);
        }

        foreach ($subcategories as $subcategory) {
            Subcategory::create([
                'category_id' => 3,
                'name' => $subcategory
            ]);
        }
    }
}
