<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Enum;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

          //
          if(auth()->user()->cannot('read coupons')) {
            return abort(403);
        }

        $coupons = Coupon::when($request->search, function ($query) use ($request) {
            return $query->where('code', 'LIKE', '%' . $request->search . '%');
        })
<<<<<<< HEAD
            ->latest()
            ->paginate(2);
=======
            ->orderBy('id', 'desc')
            ->paginate(5);
>>>>>>> dev

        return view('dashboard.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(auth()->user()->cannot('create coupons')) {
            return abort(403);
        }

        return view('dashboard.coupons.create');
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
        if(auth()->user()->cannot('create coupons')) {
            return abort(403);
        }

        $validated = $request->validate([
            'code' => 'required|string|max:255|unique:coupons,code',
            'type' => ['required', Rule::in(['percent', 'fixed'])],
            'discount_amount' => 'required|numeric',
            'min_amount' => 'required|numeric'
        ]);

        Coupon::create($validated);

        return redirect()->route('dashboard.coupons.index')->with('success', 'Coupon Successfully Created !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
        if(auth()->user()->cannot('update coupons')) {
            return abort(403);
        }

        return view('dashboard.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
        if(auth()->user()->cannot('update coupons')) {
            return abort(403);
        }

        $validated = $request->validate([
            'code' => ['required', 'string', 'max:255', Rule::unique('coupons', 'code')->ignore($coupon->id)],
            'type' => ['required', Rule::in(['percent', 'fixed'])],
            'discount_amount' => 'required|numeric',
            'min_amount' => 'required|numeric'
        ]);

        $coupon->update($validated);

        return redirect()->route('dashboard.coupons.index')->with('success', 'Coupon Successfully Updated !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        //
        if(auth()->user()->cannot('delete coupons')) {
            return abort(403);
        }

        $coupon->delete();

        return redirect()->route('dashboard.coupons.index')->with('success', __('Coupon Deleted Successfully !'));
    }
}
