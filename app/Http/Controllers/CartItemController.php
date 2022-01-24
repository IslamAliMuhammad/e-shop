<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Session;
use App\Models\CartItem;
use App\Models\Variation;
use Illuminate\Http\Request;
use App\Traits\CartItemTrait;
use App\Traits\VariationTrait;
use App\Models\ShoppingSession;
use App\Traits\ShoppingSessionTrait;

class CartItemController extends Controller
{

    use CartItemTrait, ShoppingSessionTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $shoppingSession = $this->getShoppingSession();

        $cartItems = $shoppingSession->cartItems()->with(['variation.product.translations', 'variation.product.media'])->get();

        return response(view('client.cart-items', compact('cartItems')))->cookie('shopping_session', $shoppingSession->id);;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'product_id' => 'required|numeric|exists:products,id',
            'size_id' => 'required|numeric|exists:sizes,id',
            'color_id' => 'required|numeric|exists:colors,id',
            'qty' => 'required|numeric|min:1'
        ]);

        $product = Product::find($request->product_id);

        $variation = $product->getVariation($request->color_id, $request->size_id);

        $shoppingSession = $this->getShoppingSession();

        $cartItems = $shoppingSession->cartItems;

        $cartItem = CartItem::create([
            'shopping_session_id' => $shoppingSession->id,
            'variation_id' => $variation->id,
            'qty' => $request->qty
        ]);

        // update shoppingsession total
        $cartItemtotalPrice = $product->getTotalPrice($cartItem->qty);

        $subtotal = $shoppingSession->total + $cartItemtotalPrice;

        if($cartItems->isNotEmpty()){

            $shoppingSession->update([
                'total' => $subtotal,
            ]);
        }else{
            $shoppingSession->update([
                'total' => $this->total($subtotal, config('cart-items.shipping_fees', 50)),
            ]);
        }

        return redirect()->route('cart_items.index')->with('success', 'Successfully Added To Yout Cart Items');

    }

    /**
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function show(CartItem $cartItem)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function edit(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CartItem $cartItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(CartItem $cartItem)
    {
        //

    }

}
