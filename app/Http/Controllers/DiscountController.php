<?php
// app/Http/Controllers/DiscountController.php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        return redirect(route('admin.dashboard'));
    }

    public function create()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('admin.discount.create', compact('categories', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'category_id' => 'nullable|exists:categories,id',
            'product_id' => 'nullable|exists:products,id',
        ]);

        Discount::create($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Discount created successfully.');
    }

    public function edit($id)
    {
        $discounts = Discount::findOrFail($id);
        $categories = Category::all();
        $products = Product::all();
        return view('admin.discount.edit', compact('discounts', 'categories', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'category_id' => 'nullable|exists:categories,id',
            'product_id' => 'nullable|exists:products,id',
        ]);

        $discount = Discount::findOrFail($id);
        $discount->update($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Discount updated successfully.');
    }

    public function delete($id)
    {
        $discount = Discount::findOrFail($id);
        $discount->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Discount deleted successfully.');
    }
}