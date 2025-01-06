<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomepageController extends Controller
{
    //

    public function index(){
        $categories = Category::all();
        $products = Product::all();
        return view('frontend.index', compact('categories','products'));
    }

    public function shop(){
        $categories = Category::all();
        $products = Product::all();
        return view('frontend.shop', compact('categories','products'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")->get();
        $categories = Category::all();
        return view('frontend.search', compact('products', 'query', 'categories'));
    }

    public function showCart()
    {
        return view('frontend.cart');
    }
}
