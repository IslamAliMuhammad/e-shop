<?php

namespace App\Http\Livewire\CartItems;

use App\Models\Coupon;
use Livewire\Component;
use App\Models\ShoppingSession;

class CouponInput extends Component
{
    public $couponCode;

    protected $rules = [
        'couponCode' => 'required|exists:coupons,code',
    ];

    protected $messages = [
        'couponCode.exists' => 'The entered coupon code is invalid.',
    ];

    public function deleteAll() {
        $shoppingSession = ShoppingSession::find(request()->cookie('shopping_session'));

        if($shoppingSession) {
            $shoppingSession->delete();
        }

        return redirect()->route('cart_items.index');
    }

    public function couponEntered() {

        $this->validate();
        $coupon = Coupon::where('code', $this->couponCode)->first();
        $this->emit('applyDiscount', $coupon);
    }

    public function render()
    {
        return view('livewire.cart-items.coupon-input');
    }
}
