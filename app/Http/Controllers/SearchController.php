<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Traits\ShoppingSessionTrait;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    use ShoppingSessionTrait;

    public function getSearch(Request $request) {
        $products = [];
        $colors = Color::all();
        $categories = Category::withTranslation()->get();

        $shoppingSession = $this->getShoppingSession();

        $wishlists = $shoppingSession->wishlists;

        if(isset($request->search)){
            $products = Product::search($request->search)->paginate(12);

            return view('client.products', compact('products', 'colors', 'categories', 'wishlists'));

        }
    }
}
