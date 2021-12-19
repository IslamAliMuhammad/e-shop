<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Size;
use App\Models\Color;

class SizeAndColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // Sizes
        $sizes = [
            "XXS", "XS", "S", "M", "L", "XL", "2XL", "3XL", "4XL", "5XL", "6XL",
            "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "46", "47", "48", "49", "50"
        ];

        foreach ($sizes as $size) {
            Size::create([
                'name' => $size,
            ]);
        }

        // Colors
        $colors = [
            "Black", "Gray", "Silver", "White", "Yellow", "Lime",
            "Aqua", "Fuchsia", "Red", "Green", "Blue", "Purple", "Maroon", "Olive", "Navy", "Teal"
        ];

        foreach ($colors as $color) {
            Color::create([
                'name' => $color,
            ]);
        }
    }
}
