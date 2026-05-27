<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts  = Product::count();
        $totalBrands    = Brand::count();
        $totalOrders    = DB::table('orders')->count();
        $totalCustomers = Customer::count();
        $recentProducts = Product::with(['brand', 'images'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalBrands',
            'totalOrders',
            'totalCustomers',
            'recentProducts'
        ));
    }
}