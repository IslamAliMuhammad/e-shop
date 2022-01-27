<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(auth()->user()->cannot('read brands')) {
            return abort(403);
        }

        $brands = Brand::when($request->search, function ($query) use ($request) {
            return $query->where('name', 'LIKE', '%' . $request->search . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('dashboard.brands.index', compact('brands'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        if(auth()->user()->cannot('create brands')) {
            return abort(403);
        }

        return view('dashboard.brands.create');
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
            'name' => 'required|string|max:255',
        ]);

        Brand::create($validated);

        return redirect()->route('dashboard.brands.index')->with('success', 'Brand Created Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //

        if(auth()->user()->cannot('update brands')) {
            return abort(403);
        }

        return view('dashboard.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $brand->update($validated);

        return redirect()->route('dashboard.brands.index')->with('success', 'Brand Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //

        $brand->delete();

        return redirect()->route('dashboard.brands.index')->with('success', 'Brand Deleted Successfully !');
    }
}
