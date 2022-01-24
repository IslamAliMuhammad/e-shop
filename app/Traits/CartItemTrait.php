<?php

namespace App\Traits;

trait CartItemTrait {

    public function subtotal($cartItems) {
        $subtotal = 0;

        $cartItems->each(function ($cartItem) use (&$subtotal){

            $subtotal += $cartItem->variation->product->getTotalPrice($cartItem->qty);
        });

        return $subtotal;
    }

    public function total($subtotal, $addition) {
        return ($subtotal + $addition);
    }

}
