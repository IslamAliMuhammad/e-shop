<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(Auth::check()){
            $validated = $request->validate([
                'product_id' => 'required|numeric|exists:products,id',
                'body' => 'required|string|max:4096',
                'rating' => 'required|numeric|max:5',
            ]);

            auth()->user()->reviews()->create($validated);

        }else{
            $validated = $request->validate([
                'product_id' => 'required|numeric|exists:products,id',
                'reviewer_name' => 'required|string|max:255',
                'reviewer_email' => 'required|string|max:255',
                'body' => 'required|string|max:4096',
                'rating' => 'required|numeric|max:5',
            ]);

            Review::create($validated);
        }

       return redirect()->route('products.show', $request->product_id)->with('success', 'Review Successfully Created !');
    }


}
