<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Astrotomic\Translatable\Validation\RuleFactory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        if(auth()->user()->cannot('read categories')) {
            return abort(403);
        }

        $categories = Category::when($request->search, function ($query) use ($request) {
            return $query->whereTranslationLike('name', '%' . $request->search . '%');
        })
            ->withTranslation()
<<<<<<< HEAD
            ->latest()
            ->paginate(2);
=======
            ->orderBy('id', 'desc')
            ->paginate(5);
>>>>>>> dev

        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(auth()->user()->cannot('create categories')) {
            return abort(403);
        }

        return view('dashboard.categories.create');

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
        ]);

        $validatedData = $request->validate($rules);

        Category::create($validatedData);

        return redirect()->route('dashboard.categories.index')->with('success', __('Category Successfully Created !'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //

        if(auth()->user()->cannot('update categories')) {
            return abort(403);
        }

        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $rules = RuleFactory::make([
            '%name%' => 'required|string|max:255',
        ]);

        $validatedData = $request->validate($rules);

        $category->update($validatedData);

        session()->flash('success', __('Category Successfully Updated !'));

        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //

        $category->delete();

        return redirect()->route('dashboard.categories.index')->with('success', __('Category Deleted Successfully !'));
    }
}
