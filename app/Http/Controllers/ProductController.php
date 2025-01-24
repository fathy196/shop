<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $products = Product::latest()->get();
        return view('products',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories=Category::all();

        return view('dashboard.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        //
        // dd($request->file('image'));
        
        $imageName=time().'.'.$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path('storage/products'), $imageName);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'is_active' => $request->is_active,
            'image' => $imageName,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd($product->all());
        $product = Product::with('category')->findOrFail($id);
        $relatedProducts = $product->relatedProducts();

        return view('singleproduct',compact('product', 'relatedProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function search(Request $request)
{
    // Get the search query from the request
    $query = $request->input('query');

    // Perform the search
    $products = Product::where('name', 'like', "%$query%")
                        ->orWhere('description', 'like', "%$query%")
                        ->paginate(10); // Adjust pagination as needed

    // Return the search results view
    return view('productsSearch', compact('products', 'query'));
}
}
