<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Category;
use App\Models\Discount;
use App\Models\User;

class HomeController extends Controller
{
    //
    public function index(){
        $products = Product::all();
        $categories = Category::all();
        $shops = Shop::all();
        $discounts = Discount::all();
        $users = User::all();
        return view('admin.dashboard',['products' => $products, 'categories' => $categories,'shops' => $shops,'discounts' => $discounts, 'users'=>$users]);
    }
}
