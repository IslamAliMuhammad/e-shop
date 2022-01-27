<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ShoppingSession;
use Illuminate\Support\Facades\DB;
use App\Traits\ShoppingSessionTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    use ShoppingSessionTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $products = [];
        $colors = Color::all();
        $categories = Category::withTranslation()->get();


        $shoppingSession = $this->getShoppingSession();

        $wishlists = $shoppingSession->wishlists;


        if(isset($request->search)){
            $products = Product::search($request->search)->paginate(12);

            return view('client.products', compact('products', 'colors', 'categories', 'wishlists'));

        }

        if(isset($request->colorId)) {
            $products = Product::query()
                ->join('variations', 'products.id', '=','variations.product_id')
                ->where('color_id', $request->colorId)
                ->select('products.id', 'products.price')
                ->with('media')
                ->withTranslation()
                ->groupBy('product_id')
                ->paginate(12);

            return view('client.products', compact('products', 'colors', 'categories', 'wishlists'));
        }

        if(isset($request->min)){
            $products = Product::withTranslation()->with(['media'])->price($request->min, $request->max)->paginate(12);
            return view('client.products', compact('products', 'colors', 'categories', 'wishlists'));
        }

        if($sortBy = $request->sortBy){
            $products = Product::withTranslation()->with(['media'])->$sortBy()->paginate(12);
            return view('client.products', compact('products', 'colors', 'categories', 'wishlists'));
        }

        if($categoryId = $request->categoryId){
            $products = Product::query()
                ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
                ->where('category_id', '=', $categoryId)
                ->select('products.id', 'products.price')
                ->with('media')
                ->withTranslation()
                ->paginate(12);

            return view('client.products', compact('products', 'colors', 'categories', 'wishlists'));
        }

<<<<<<< HEAD
        $products = Product::withTranslation()->with(['media'])->latest()->paginate(12);
=======
        $products = Product::withTranslation()->with(['media'])->orderBy('id', 'desc')->paginate(12);
>>>>>>> dev

        return view('client.products', compact('products', 'colors', 'categories', 'wishlists'));
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //

        $product->load(['media', 'subcategory.category'])->get();

        $relatedProducts = Product::where('subcategory_id', $product->subcategory_id)->withTranslation()->with(['media'])->take(8)->get();


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

<<<<<<< HEAD
        $reviews = $product->reviews()->with(['user.media'])->latest()->get();
=======
        $reviews = $product->reviews()->with(['user.media'])->orderBy('id', 'desc')->get();
>>>>>>> dev

        return response(view('client.product-details', compact('product', 'relatedProducts', 'reviews')))->cookie('shopping_session', $shoppingSession->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }


}
