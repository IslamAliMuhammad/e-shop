<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
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
