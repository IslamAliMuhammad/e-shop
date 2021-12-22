<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $products = [
            [ 'en' => [
                'name' => 'Pullover High Quality Cotton',
                'description' => 'High Cool Men Cotton Lycra Premium Material Pullover'
            ],
            'ar' => [
                'name' => 'كنزة صوفية قطن عالي الجودة',
                'description' => 'عالية الجودة الرجال القطن ليكرا قسط المواد السترة'
            ],
             'price' => rand(100, 1000), 'subcategory_id' => rand(1, 15), 'brand_id' => rand(1, 20), 'discount_id' => rand(1, 5)],
            [ 'en' => [
                'name' => 'Cotton High Neck Sweatshirt',
                'description' => 'Highcool Cotton'
            ],
            'ar' => [
                'name' => 'سويت شيرت قطن بياقة عالية',
                'description' => 'قطن هاي كول'
            ],
             'price' => rand(100, 1000), 'subcategory_id' => rand(1, 15), 'brand_id' => rand(1, 20), 'discount_id' => rand(1, 5)],
            [ 'en' => [
                'name' => 'Full Sleeves Highcool For Men',
                'description' => 'Material Composition: 60% Naylon 40% Viscose'
            ],
            'ar' => [
                'name' => 'هاى كول بأكمام طويلة للرجال',
                'description' => 'عالية الجودة الرجال القطن ليكرا قسط المواد السترة'
            ],
             'price' => rand(100, 1000), 'subcategory_id' => rand(1, 15), 'brand_id' => rand(1, 20), 'discount_id' => rand(1, 5)],
            [ 'en' => [
                'name' => 'Round Sweatshirt with Long sleeves',
                'description' => 'Full Buttons Down Black Cardigan'
            ],
            'ar' => [
                'name' => 'سويت شيرت دائري بأكمام طويلة',
                'description' => 'أزرار كاملة أسفل كارديجان أسود'
            ],
             'price' => rand(100, 1000), 'subcategory_id' => rand(1, 15), 'brand_id' => rand(1, 20), 'discount_id' => rand(1, 5)],
            [ 'en' => [
                'name' => 'Zip Up Hoodie',
                'description' => 'Sweatshirt Round neck with long sleeves'
            ],
            'ar' => [
                'name' => 'هودي بسحاب',
                'description' => 'سويت شيرت برقبة دائرية واكمام طويلة'
            ],
             'price' => rand(100, 1000), 'subcategory_id' => rand(1, 15), 'brand_id' => rand(1, 20), 'discount_id' => rand(1, 5)],
             [ 'en' => [
                'name' => 'Zip Up Hoodie Long sleeves',
                'description' => 'Sweatshirt Round neck with long sleeves'
            ],
            'ar' => [
                'name' => 'اكمام طويلة هودي بسحاب',
                'description' => 'سويت شيرت برقبة دائرية واكمام طويلة'
            ],
             'price' => rand(100, 1000), 'subcategory_id' => rand(1, 15), 'brand_id' => rand(1, 20), 'discount_id' => rand(1, 5)],
        ];

        foreach ($products as $product) {
           Product::create($product);
        }
    }
}
