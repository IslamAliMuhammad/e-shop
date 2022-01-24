<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Session;
use App\Models\OrderItem;
use App\Models\Variation;
use App\Traits\OrderTrait;
use Illuminate\Http\Request;
use App\Models\ShoppingSession;

class OrderController extends Controller
{
    use OrderTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if(isset($request->address)){
            $validated = $request->validate([
                'address.address_line1' => 'required|string|max:255',
                'address.address_line2' => 'nullable|string|max:255',
                'address.area_id' => 'required|numeric|exists:areas,id',
                'address.postal_code' => 'required|string|max:255',
                'address.mobile_number' => 'required|string|max:11'
            ]);

            $address = auth()->user()->address()->create($validated['address']);
        }

        $shoppingSession = ShoppingSession::findOrFail($request->cookie('shopping_session'));

        $cartItems = $shoppingSession->cartItems;

        // create order
        $order = auth()->user()->orders()->create([
            'total' => $shoppingSession->total,
        ]);

        // create order_items
        foreach($cartItems as $cartItem) {
            $order->orderItems()->create([
                'variation_id' => $cartItem->variation_id,
                'qty' => $cartItem->qty,
            ]);
            $variation = $cartItem->variation;

            $this->decreaseVariationStock($variation, $cartItem->qty);
        }

        // delete user shoppingSession
        $shoppingSession->delete();

        return redirect()->route('products.index')->with('success', 'Order Successfully Placed !');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
