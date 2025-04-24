<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

//----------------------test-------------------------------
// public function sendEmail()
// {
    //     $data = [
        //         'name' => 'Fathy',
        //     ];
        
        //     Mail::to('fathyabdelkader8@gmail.com')->send(new TestMail($data));
        
        //     return 'Email sent successfully!';
        // }
        
//----------------------test-------------------------------

    public function index()
    {
        $categories = Category::withCount('products')->latest()->paginate(10);
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());
        return redirect()->route('dashboard.categories.index')->with('status', "Category Created Successfully");
    }
    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update(['name' => $request->name]);
        return redirect()->route('dashboard.categories.index')->with('status', 'Category updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('dashboard.categories.index')->with("status", "Category Deleted Successfully");
    }
}