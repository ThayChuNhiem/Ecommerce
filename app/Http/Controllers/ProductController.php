<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $shops = Shop::all();
        return view('admin.product.home', compact('products', 'categories', 'shops'));
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
            'shop_id' => 'required',
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
        $categories = Category::all();
        $shops = Shop::all();
        return view('admin.product.update', compact('products', 'categories', 'shops'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
            'shop_id' => 'required|integer',
            'category_id' => 'required|integer',
        ]);

        $products = Product::findOrFail($id);
        $name = $request->name;
        $description = $request->description;
        $price = $request->price;
        $status = $request->status;
        $shop_id = $request->shop_id;
        $category_id = $request->category_id;
        if ($request->hasFile('image')) {
            // Xóa file cũ nếu có
            if ($products->image) {
                Storage::disk('public')->delete($products->image);
            }
            // Lưu file mới
            $imagePath = $request->file('image')->store('products', 'public');
            $products->image = $imagePath;
        }


        $products->name = $name;
        $products->description = $description;
        $products->price = $price;
        $products->status = $status;
        $products->shop_id = $shop_id;
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
