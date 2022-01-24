<?php

namespace App\Http\Livewire;

use App\Traits\ShoppingSessionTrait;
use Livewire\Component;

class WhishlistIcon extends Component
{
    use ShoppingSessionTrait;

    public $wishlistsItemsCoun;

    protected $listeners = ['newAddedToWishlist' => 'updateCounter'];

    public function updateCounter() {
        $shoppingSession = $this->getShoppingSession();

        $this->wishlistsItemsCoun = $shoppingSession->wishlists()->count();
    }

    public function mount() {
        $this->updateCounter();
    }

    public function render()
    {
        return view('livewire.whishlist-icon');
    }
}
