<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->inRandomOrder()->get();
        return view('home', compact('products'));
    }
    public function aboutus()
    {
        return view('aboutus');
    }

}
