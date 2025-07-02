<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
         $categoryId = $request->query('category');

    $productsQuery = Product::query();

    if ($categoryId) {
        $productsQuery->where('category_id', $categoryId);
    }

    $products = $productsQuery->latest()->paginate(10);
    $categories = Category::all();

    return view('admin.products.index', compact('products', 'categories', 'categoryId'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('admin.products.create', compact('categories'));

    }

    public function store(Request $request)
    {
         $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'is_available' => 'required|boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
    }

    \App\Models\Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'category_id' => $request->category_id,
        'is_available' => $request->is_available,
        'image' => $imagePath,
    ]);

    return redirect()->route('products.index')->with('success', 'Product created!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
    $categories = Category::all();

    return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'is_available' => $request->has('is_available'),
        ]);

        return redirect()->route('products.index')->with('success', 'The product has been modified successfully.');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('products.index')->with('success', 'The product has been removed.');
    }
}
