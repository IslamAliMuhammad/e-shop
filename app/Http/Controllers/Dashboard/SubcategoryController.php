<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Astrotomic\Translatable\Validation\RuleFactory;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(auth()->user()->cannot('read subcategories')) {
            return abort(403);
        }

        $subcategories = Subcategory::when($request->search, function ($query) use ($request) {
            return $query->whereTranslationLike('name', '%' . $request->search . '%');
        })
            ->withTranslation()
            ->with(['category' => function ($query) {
                $query->withTranslation();
            }])
            ->latest()
            ->paginate(5);

        return view('dashboard.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        if(auth()->user()->cannot('create subcategories')) {
            return abort(403);
        }

        $categories = Category::withTranslation()->get();

        return view('dashboard.subcategories.create', compact('categories'));
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
            'category_id' => 'required|numeric|exists:categories,id'
        ]);

        $validatedData = $request->validate($rules);

        Subcategory::create($validatedData);

        session()->flash('success', __('Subcategory Successfully Created !'));
        return redirect()->route('dashboard.subcategories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        //
        if(auth()->user()->cannot('update subcategories')) {
            return abort(403);
        }
        $categories = Category::withTranslation()->get();

        return view('dashboard.subcategories.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        //
        $rules = RuleFactory::make([
            '%name%' => 'required|string|max:255',
            'category_id' => 'required|numeric|exists:categories,id'

        ]);

        $validatedData = $request->validate($rules);

        $subcategory->update($validatedData);

        session()->flash('success', __('Subcategory Successfully Updated !'));

        return redirect()->route('dashboard.subcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        //
        $subcategory->delete();

        return redirect()->route('dashboard.subcategories.index')->with('success', __('Subcategory Deleted Successfully !'));
    }
}
