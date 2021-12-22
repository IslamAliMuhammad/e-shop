<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Product $product)
    {
        //
        if(auth()->user()->cannot('read products')) {
            return abort(403);
        }

        $variations = $product->variations()->when($request->search, function ($query) use ($request) {
            return $query->where('sku', 'LIKE', '%' . $request->search . '%');
        })
        ->with(['color', 'size'])
        ->latest()
        ->paginate(2);

        return view('dashboard.products.variations.index', compact('product', 'variations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        //
        if(auth()->user()->cannot('create products')) {
            return abort(403);
        }

        $colors = Color::all();
        $sizes = Size::all();

        return view('dashboard.products.variations.create', compact('product', 'sizes', 'colors'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        //
        $validated = Validator::make($request->except('_token'), [
            '*.size_id' => 'required|numeric|max:255|exists:sizes,id',
            '*.color_id' => 'required|numeric|max:255|exists:colors,id',
            '*.sku' => 'required|string|max:255|unique:variations,sku',
            '*.stock' => 'required|numeric'
        ])->validate();

        $product->variations()->createMany($validated);

        return redirect()->route('dashboard.products.variations.index', [$product->id])->with('success', __('Product Variation Successfully Created !'));
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
    public function edit(Product $product, Variation $variation)
    {
        //
        if(auth()->user()->cannot('update products')) {
            return abort(403);
        }

        $colors = Color::all();
        $sizes = Size::all();

        return view('dashboard.products.variations.edit', compact('product', 'sizes', 'colors', 'variation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, Variation $variation)
    {
        //

        $validated = $request->validate([
            'size_id' => 'required|numeric|max:255|exists:sizes,id',
            'color_id' => 'required|numeric|max:255|exists:colors,id',
            'sku' => ['required', 'string', 'max:255', Rule::unique('variations', 'sku')->ignore($variation->id, 'id')],
            'stock' => 'required|numeric'
        ]);

        $variation->update($validated);

        return redirect()->route('dashboard.products.variations.index', [$product->id])->with('success', __('Product Variation Successfully Updated !'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($productId, Variation $variation)
    {
        //
        $variation->delete();

        return redirect()->route('dashboard.products.variations.index', [$productId])->with('success', __('Product Variation Successfully Deleted !'));
    }
}
