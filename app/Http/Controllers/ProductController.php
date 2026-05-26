<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::with([
            'images',
            'options.values',
            'brand',
            'category'
        ])->findOrFail($id);

        $related = Product::with('images')
            ->where('category_id', $product->category_id)
            ->where('product_id', '!=', $id)
            ->take(3)
            ->get();

        return view('products-detail', compact('product', 'related'));
    }
}