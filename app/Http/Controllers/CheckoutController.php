<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use App\Models\Session;
use Illuminate\Http\Request;
use App\Traits\CartItemTrait;
use App\Models\ShoppingSession;
use App\Traits\ShoppingSessionTrait;

class CheckoutController extends Controller
{

    use CartItemTrait, ShoppingSessionTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $shoppingSession = $this->getShoppingSession();

        $cartItems = $shoppingSession->cartItems()->with(['variation.product.translations', 'variation.product'])->get();

        $subtotal = $this->subtotal($cartItems);

        $total = $shoppingSession->total;


        $address = null;

        if(auth()->user()->address){
            $address = auth()->user()->address;

        }

        return view('client.checkout', compact('cartItems', 'subtotal', 'total', 'address'));

    }


}
