<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $Categories = Category::all();
        return view('admin.category.home', compact('Categories'));
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
            'status' => 'required',
        ]);
        
        $data = Category::create($validation);
        if ($data) {
            session()->flash('success', 'Category Add Successfully');
            return redirect(route('admin.category'));
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
            return redirect(route('admin.category'));
        } else {
            session()->flash('error', 'Product Not Delete successfully');
            return redirect(route('admin.category'));
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
            return redirect(route('admin.category'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('admin.category.update'));
        }
    }
}
