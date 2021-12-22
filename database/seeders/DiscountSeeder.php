<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $discounts = [
            ['en' => [
                'name' => '50% off on any item',
                'description' => '50% off on any item'
            ],
            'ar' => [
                'name' => 'خصم 50% على اى منتج',
                'description' => 'خصم 50% على اى منتج'
            ], 'discount_percent' => '50', 'is_active' => true],
            ['en' => [
                'name' => '60% off on Black  Friday',
                'description' => '60% off on Black  Friday'
            ],
            'ar' => [
                'name' => 'خصم 60% الحمعة البيضاء',
                'description' => 'خصم 60% الحمعة البيضاء'
            ], 'discount_percent' => '60', 'is_active' => true],
            ['en' => [
                'name' => '70% off on any item',
                'description' => '70% off on any item'
            ],
            'ar' => [
                'name' => 'خصم 70% على اى منتج',
                'description' => 'خصم 70% على اى منتج'
            ], 'discount_percent' => '70', 'is_active' => false],
            ['en' => [
                'name' => '80% off on any item',
                'description' => '80% off on any item'
            ],
            'ar' => [
                'name' => 'خصم 80% على اى منتج',
                'description' => 'خصم 80% على اى منتج'
            ], 'discount_percent' => '80', 'is_active' => true],
            ['en' => [
                'name' => '90% off on any item',
                'description' => '90% off on any item'
            ],
            'ar' => [
                'name' => 'خصم 90% على اى منتج',
                'description' => 'خصم 90% على اى منتج'
            ], 'discount_percent' => '90', 'is_active' => false],
            ['en' => [
                'name' => '100% off on any item',
                'description' => '100% off on any item'
            ],
            'ar' => [
                'name' => 'خصم 100% على اى منتج',
                'description' => 'خصم 100% على اى منتج'
            ], 'discount_percent' => '100', 'is_active' => true],
        ];

        foreach ($discounts as $discount) {
            Discount::create($discount);
        }
    }
}
