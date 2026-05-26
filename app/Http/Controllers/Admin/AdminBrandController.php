<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class AdminBrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands', compact('brands'));
    }

    public function create()
    {
        return view('admin.add-brand');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_name'  => 'required|string|max:250',
            'description' => 'nullable|string|max:250',
        ]);

        Brand::create([
            'brand_name'  => $request->brand_name,
            'description' => $request->description,
            'is_active'   => true,
        ]);

        return redirect()->route('admin.brands')->with('success', '✅ Brand added successfully!');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.edit-brand', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'brand_name'  => 'required|string|max:250',
            'description' => 'nullable|string|max:250',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->update([
            'brand_name'  => $request->brand_name,
            'description' => $request->description,
            'is_active'   => $request->has('is_active'),
        ]);

        return redirect()->route('admin.brands')->with('success', '✅ Brand updated successfully!');
    }

    public function destroy($id)
    {
        Brand::findOrFail($id)->delete();
        return redirect()->route('admin.brands')->with('success', '🗑️ Brand deleted.');
    }
}