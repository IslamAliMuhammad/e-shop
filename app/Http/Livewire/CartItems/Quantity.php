<?php

namespace App\Http\Livewire\CartItems;

use Livewire\Component;
use App\Models\CartItem;
use App\Traits\ShoppingSessionTrait;

class Quantity extends Component
{

    use ShoppingSessionTrait;

    public $qty;
    public $price;
    public $stock;
    public $cartItemId;

    public function subtractQty() {
        if($this->qty > 0 ){
            $this->qty--;
            $this->emit('subtractSubtotal', $this->price);

            $cartItem = CartItem::find($this->cartItemId);

            $cartItem->update([
                'qty' => $this->qty,
            ]);

            $shoppingSession = $this->getShoppingSession();

            $newShoppingSessionTotal = $shoppingSession->total - $this->price;

            $shoppingSession->update([
                'total' => $newShoppingSessionTotal,
            ]);
        }
    }

    public function addQty() {
        if($this->qty < $this->stock) {
            $this->qty++;
            $this->emit('addSubtotal', $this->price);

            $cartItem = CartItem::find($this->cartItemId);

            $cartItem->update([
                'qty' => $this->qty,
            ]);

            $shoppingSession = $this->getShoppingSession();

            $newShoppingSessionTotal = $shoppingSession->total + $this->price;

            $shoppingSession->update([
                'total' => $newShoppingSessionTotal,
            ]);
        }
    }


    public function render()
    {
        return view('livewire.cart-items.quantity');
    }
}
