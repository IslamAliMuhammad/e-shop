<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Astrotomic\Translatable\Validation\RuleFactory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(auth()->user()->cannot('read products')) {
            return abort(403);
        }

        $products = Product::when($request->search, function ($query) use ($request) {
            return $query->whereTranslationLike('name', '%' . $request->search . '%');
        })
            ->withTranslation()
            ->with(['subcategory' => function ($query) {
                $query->withTranslation()->with(['category' => function ($query) {
                    $query->withTranslation();
                }]);
            }, 'brand', 'discount' => function ($query) {
                $query->withTranslation();
            }])
            ->latest()
            ->paginate(10);

        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        if(auth()->user()->cannot('create products')) {
            return abort(403);
        }

        $categories = Category::withTranslation()->with(['subcategories' => function ($query) {
            $query->withTranslation();
        }])->get();

        $brands = Brand::all();

        $discounts = Discount::withTranslation()->get();

        return view('dashboard.products.create', compact('categories', 'brands', 'discounts'));
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
        $rules = RuleFactory::make([
            '%name%' => 'required|string|max:255',
            '%description%' => 'required|string|max:255',
            'price' => 'required|numeric',
            'subcategory_id' => 'required|numeric|exists:subcategories,id',
            'brand_id' => 'required|numeric|exists:brands,id',
            'discount_id' => 'nullable|numeric|exists:discounts,id'
        ]);

        $validatedData = $request->validate($rules);

        $product = Product::create($validatedData);

        if(!empty($request->files->all())) {
            $product->addMultipleMediaFromRequest(['files'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection();
            });
        }

        return redirect()->route('dashboard.products.index')->with('success', __('Product Successfully Created !'));
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
        if(auth()->user()->cannot('update products')) {
            return abort(403);
        }

        $categories = Category::withTranslation()->with(['subcategories' => function ($query) {
            $query->withTranslation();
        }])->get();

        $brands = Brand::all();

        $discounts = Discount::withTranslation()->get();

        return view('dashboard.products.edit', compact('product', 'categories', 'brands', 'discounts'));
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
        $rules = RuleFactory::make([
            '%name%' => 'required|string|max:255',
            '%description%' => 'required|string|max:255',
            'price' => 'required|numeric',
            'subcategory_id' => 'required|numeric|exists:subcategories,id',
            'brand_id' => 'required|numeric|exists:brands,id',
            'discount_id' => 'nullable|numeric|exists:discounts,id'
        ]);

        $validatedData = $request->validate($rules);

        $product->update($validatedData);

        if(!empty($request->files->all())) {
            $product->clearMediaCollection();
            $product->addMultipleMediaFromRequest(['files'])->each(function ($fileAdder) {
                $fileAdder->toMediaCollection();
            });
        }
        return redirect()->route('dashboard.products.index')->with('success', 'Product Successfully Updated !');
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
        $product->delete();

        return redirect()->route('dashboard.products.index')->with('success', 'Product Successfully Deleted !');
    }
}
