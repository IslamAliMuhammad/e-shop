<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Astrotomic\Translatable\Validation\RuleFactory;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(auth()->user()->cannot('read discounts')) {
            return abort(403);
        }

        $discounts = Discount::when($request->search, function ($query) use ($request) {
            return $query->whereTranslationLike('name', '%' . $request->search . '%', app()->getLocale());
        })
            ->latest()
            ->paginate(2);

        return view('dashboard.discounts.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(auth()->user()->cannot('read discounts')) {
            return abort(403);
        }

        return view('dashboard.discounts.create');
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
            '%description%' => 'required|string|max:4096',
            'discount_percent' => 'required|numeric',
            'is_active' => 'required|boolean'
        ]);


        $validatedData = $request->validate($rules);

        Discount::create($validatedData);

        return redirect()->route('dashboard.discounts.index')->with('success', __('Discount Successfully Created !'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        //
        if(auth()->user()->cannot('read discounts')) {
            return abort(403);
        }
        return view('dashboard.discounts.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        //

        $rules = RuleFactory::make([
            '%name%' => 'required|string|max:255',
            '%description%' => 'required|string|max:4096',
            'discount_percent' => 'required|numeric',
            'is_active' => 'required|boolean'
        ]);


        $validatedData = $request->validate($rules);

        $discount->update($validatedData);

        return redirect()->route('dashboard.discounts.index')->with('success', __('Discount Updated Successfully !'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        //

        $discount->delete();

        return redirect()->route('dashboard.discounts.index')->with('success', __('Discount Deleted Successfully !'));
    }
}
