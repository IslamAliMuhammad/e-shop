<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $categories = ['Men', 'Women', 'Kids', 'Accessories', 'Cosmetic'];
        $categoriesAr = ['رجال', 'نساء', 'اطفال', 'اكسسوارات', 'مستحضرات تجميل'];

        foreach ($categories as $index => $category) {
            Category::create([
                'en' => [
                    'name' => $category
                ],
                'ar' => [
                    'name' => $categoriesAr[$index]
                ]
            ]);
        }
    }
}
