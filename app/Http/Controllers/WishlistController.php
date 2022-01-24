<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use App\Models\Variation;
use Illuminate\Http\Request;
use App\Traits\CartItemTrait;
use App\Models\ShoppingSession;
use App\Models\Wishlist;

class WishlistController extends Controller
{

    use CartItemTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


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

        $wishlists = $shoppingSession->wishlists()->with(['product' => function ($query) {
            return $query->withTranslation();
        }, 'product.media'])->get();

        return response(view('client.wishlist', compact('wishlists')))->cookie('shopping_session', $shoppingSession->id);
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

    public function deleteAll()
    {
        //

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

        $wishlists = $shoppingSession->wishlists;

        Wishlist::destroy($wishlists);

        return redirect()->route('products.index')->with('success', 'Whishlists Successfully Deleted !');
    }
}
