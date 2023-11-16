<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('categories.view');

        $categories = Category::paginate(6) ;
        
        return view('dashboard.categories.index',compact('categories')) ;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('categories.create');

        return view('dashboard.categories.create') ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->all()) ;

        return redirect()->route('dashboard.categories.index')->with('success','Category Created Successfully') ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show',compact('category')) ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        Gate::authorize('categories.update');

        return view('dashboard.categories.edit',compact('category')) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all()) ;

        return redirect()->route('dashboard.categories.index')->with('success','Category Updated Successfully') ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Gate::authorize('categories.delete');
        $category->delete() ;
        return redirect()->route('dashboard.categories.index')->with('success','Category Deleted Successfully') ;

    }
}
