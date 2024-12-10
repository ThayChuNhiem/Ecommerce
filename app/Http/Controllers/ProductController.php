<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Category;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('admin.product.home', compact('products', 'categories'));
    }


    public function create()
    {
        $shops = Shop::all();
        $categories = Category::all();
        return view('admin.product.create', compact('shops', 'categories'));
    }


    public function save(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
            'shop' => 'required',
            'category_id' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validation['image'] = $imagePath; // Lưu đường dẫn của file vào mảng $validation
        }
        
        $data = Product::create($validation);
        if ($data) {
            session()->flash('success', 'Product Add Successfully');
            return redirect(route('admin.product'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('admin.product.create'));
        }
    }

    public function edit($id)
    {
        $products = Product::findOrFail($id);
        return view('admin.product.update', compact('products'));
    }
    
    public function delete($id)
    {
        $products = Product::findOrFail($id)->delete();
        if ($products) {
            session()->flash('success', 'Product Deleted Successfully');
            return redirect(route('admin.product'));
        } else {
            session()->flash('error', 'Product Not Delete successfully');
            return redirect(route('admin.product'));
        }
    }
 
    public function update(Request $request, $id)
    {
        $products = Product::findOrFail($id);
        $name = $request->name;
        $description = $request->description;
        $price = $request->price;
        $image = $request->image;
        $status = $request->status;
        $shop = $request->shop;
        $category_id = $request->category_id;
 
        $products->name = $name;
        $products->description = $description;
        $products->price = $price;
        $products->image = $image;
        $products->status = $status;
        $products->shop = $shop;
        $products->category_id = $category_id;
        $data = $products->save();
        if ($data) {
            session()->flash('success', 'Product Update Successfully');
            return redirect(route('admin.product'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('admin.product.update'));
        }
    }

}
