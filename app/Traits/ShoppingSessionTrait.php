<?php

namespace App\Traits;

use App\Models\ShoppingSession;


trait ShoppingSessionTrait {

    public function getShoppingSession(): ShoppingSession
    {
        $shoppingSession = null;

        if(is_null(request()->cookie('shopping_session'))) {
            $shoppingSession = ShoppingSession::create([
                'id' => uniqid(),
                'user_id' => auth()->id(),
            ]);

        }else {
            $shoppingSession = ShoppingSession::find(request()->cookie('shopping_session'));

            if(is_null($shoppingSession)){
                $shoppingSession = ShoppingSession::create([
                    'id' => uniqid(),
                    'user_id' => auth()->id(),
                ]);
            }
        }

        return $shoppingSession;
    }


}
