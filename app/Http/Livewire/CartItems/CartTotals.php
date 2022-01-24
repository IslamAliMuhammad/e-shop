<?php

namespace App\Http\Livewire\CartItems;

use Livewire\Component;
use App\Traits\CartItemTrait;
use App\Models\ShoppingSession;

class CartTotals extends Component
{

    use CartItemTrait;

    public $cartItems;
    public $subtotal;
    public $total;

    protected $listeners =  ['applyDiscount' => 'applyDiscount', 'subtractSubtotal' => 'subtractSubtotal', 'addSubtotal' => 'addSubtotal'];

    public function subtractSubtotal($price) {
        $newSubtotal = $this->subtotal - $price;
        if($newSubtotal >= 0) {
            $this->subtotal = $newSubtotal;
            $this->updateTotal();
        }

    }

    public function addSubtotal($price) {
        $newSubtotal = $this->subtotal + $price;

        $this->subtotal = $newSubtotal;

        $this->updateTotal();

    }

    public function applyDiscount($coupon) {
        if($this->total >= $coupon['min_amount']){
            switch ($coupon['type']) {
                case "fixed":
                    $this->total = $this->total - $coupon['discount_amount'];
                    break;

                case "percent":
                    $this->total = ($this->total * $coupon['discount_amount']) / 100;
                    break;
            }

            $shoppingSession = ShoppingSession::findOrFail(request()->cookie('shopping_session'));
            $shoppingSession->update([
                'total' => $this->total,
            ]);
        }
    }

    private function updateTotal() {
        if($this->cartItems->isNotEmpty()) {
            $this->total = $this->total($this->subtotal, config('cart-items.shipping_fees', 50));

        }else{
            $this->total = config('cart-items.shipping_fees', 50);
        }
    }

    public function mount() {
        $this->subtotal = $this->subtotal($this->cartItems);

        $this->updateTotal();
    }

    public function render()
    {
        return view('livewire.cart-items.cart-totals');
    }
}
