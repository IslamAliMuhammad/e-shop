<?php

namespace App\Traits;

use App\Models\Variation;

trait OrderTrait {

    public function decreaseVariationStock(Variation $variation, $qty) {
        $newStock = $variation->stock - $qty;

        $variation->update([
            'stock' => $newStock,
        ]);
    }
}
