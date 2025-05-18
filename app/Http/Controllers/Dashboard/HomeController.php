<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $products = Product::get();
        $orders = Order::get();
        $users = User::where('is_admin', false)->get();

//  dd($categories);
        return view('dashboard.index',compact('categories','products','users','orders'));
    }
    
    public function showUsers()
    {
        $users = User::where('is_admin', false)->paginate(15);
        return view('dashboard.users.index',compact('users'));
    }
    public function showAdmins()
{
    $admins = User::where('is_admin', true)->paginate(15);
    return view('dashboard.admins.index', compact('admins'));
}
}
