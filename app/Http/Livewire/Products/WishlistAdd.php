<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Models\Wishlist;
use App\Models\ShoppingSession;
use App\Traits\ShoppingSessionTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WishlistAdd extends Component
{
    use ShoppingSessionTrait;
    public $productId;

    public $wishlists;

    public $isWishlist = false;

    public function addToWishlist() {

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

        $shoppingSession->wishlists()->create([
            'product_id' => $this->productId,
        ]);

        $this->emit('newAddedToWishlist');

    }

    public function mount() {
        if($this->wishlists->isNotEmpty()){
            $wishlist = $this->wishlists->where('product_id', $this->productId)->first();
            if(is_null($wishlist)) {
                $this->isWishlist = false;
            }else{
                $this->isWishlist = true;

            }
        }
    }

    public function render()
    {
        return view('livewire.products.wishlist-add');
    }
}
