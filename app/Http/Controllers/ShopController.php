<?php

//app/Http/Controllers/ShopController.php 

namespace App\Http\Controllers;

use App\Models\shop;
use Illuminate\Http\Request;
use App\Models\User;



class ShopController extends Controller
{
    public function index()
    {
        return redirect(route('admin.dashboard'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.shop.create',compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
            'owner' => 'required|exists:users,id',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        Shop::create($data);
        
        return redirect()->route('admin.shop')->with('success', 'Shop created successfully.');
    }

    public function edit($id)
    {
        $shop = Shop::findOrFail($id);
        $users = User::all();
        return view('admin.shop.update', compact('shop','users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean',
            'owner' => 'required|exists:users,id',
        ]);

        $shop = Shop::findOrFail($id);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        

        $shop->update($data);

        return redirect()->route('admin.shop')->with('success', 'Shop updated successfully.');
    }

    public function delete($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Shop deleted successfully.');
    }
}