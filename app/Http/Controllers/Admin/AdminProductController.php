<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['images', 'category', 'brand'])->get();
        return view('admin.products', compact('products'));
    }

    public function create()
    {
        $brands     = Brand::where('is_active', true)->get();
        $categories = Category::where('is_active', true)->get();
        return view('admin.add-product', compact('brands', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:250',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'brand_id'    => 'nullable',
            'category_id' => 'nullable',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product = Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'brand_id'    => $request->brand_id,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $newName  = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('Images'), $newName);

            ProductImage::create([
                'product_id' => $product->product_id,
                'image_url'  => 'Images/' . $newName,
            ]);
        }

        return redirect()->route('admin.products')->with('success', '✅ Product added successfully!');
    }

    public function edit($id)
    {
        $product    = Product::with('images')->findOrFail($id);
        $brands     = Brand::where('is_active', true)->get();
        $categories = Category::where('is_active', true)->get();
        return view('admin.edit-product', compact('product', 'brands', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:250',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'brand_id'    => $request->brand_id,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('image')) {
            $file    = $request->file('image');
            $newName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('Images'), $newName);

            ProductImage::where('product_id', $id)->delete();
            ProductImage::create([
                'product_id' => $product->product_id,
                'image_url'  => 'Images/' . $newName,
            ]);
        }

        return redirect()->route('admin.products')->with('success', '✅ Product updated successfully!');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('admin.products')->with('success', '🗑️ Product deleted.');
    }
}