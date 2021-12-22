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
        $subcategoriesAr = ['معاطف', 'جواكت', 'فساتين', 'قمصان', 'تيشرتات', 'جينز'];

        foreach ($subcategories as $index => $subcategory) {
            Subcategory::create([
                'category_id' => 1,
                'en' => [
                    'name' => $subcategory
                ],
                'ar' => [
                    'name' => $subcategoriesAr[$index]
                ]
            ]);
        }

        foreach ($subcategories as $subcategory) {
            Subcategory::create([
                'category_id' => 2,
                'en' => [
                    'name' => $subcategory
                ],
                'ar' => [
                    'name' => $subcategoriesAr[$index]
                ]
            ]);
        }

        foreach ($subcategories as $subcategory) {
            Subcategory::create([
                'category_id' => 3,
                'en' => [
                    'name' => $subcategory
                ],
                'ar' => [
                    'name' => $subcategoriesAr[$index]
                ]
            ]);
        }
    }
}
