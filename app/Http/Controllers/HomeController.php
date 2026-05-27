<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('images')->latest()->take(8)->get();

        $categories = Category::withCount('products')->get();
        $categoryCounts = $categories->pluck('products_count', 'category_name')->toArray();

        return view('home', compact('featuredProducts', 'categoryCounts'));
    }
}