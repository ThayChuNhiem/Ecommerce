<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;


class CategoryController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $shops = Shop::all();
        return view('admin.dashboard', compact('products', 'categories', 'shops'));
    }


    public function create()
    {
        return view('admin.category.create');
    }


    public function save(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validation['image'] = $imagePath; // Lưu đường dẫn của file vào mảng $validation
        }
        
        $data = Category::create($validation);
        if ($data) {
            session()->flash('success', 'Category Add Successfully');
            return redirect(route('admin.dashboard'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('admin.category.create'));
        }
    }

    public function edit($id)
    {
        $categories = Category::findOrFail($id);
        return view('admin.category.update', compact('categories'));
    }

    public function delete($id)
    {
        $categories = Category::findOrFail($id)->delete();
        if ($categories) {
            session()->flash('success', 'Product Deleted Successfully');
            return redirect(route('admin.dashboard'));
        } else {
            session()->flash('error', 'Product Not Delete successfully');
            return redirect(route('admin.dashboard'));
        }
    }
 
    public function update(Request $request, $id)
    {
        $categories = Category::findOrFail($id);
        $name = $request->name;
        $description = $request->description;
        $status = $request->status;
 
        $categories->name = $name;
        $categories->description = $description;
        $categories->status = $status;
        $data = $categories->save();
        if ($data) {
            session()->flash('success', 'Product Update Successfully');
            return redirect(route('admin.dashboard'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('admin.category.update'));
        }
    }
}
