@extends('layouts.admin')

@section('content')
<section class="bg-pink-50 min-h-screen py-10">
    <div class="container mx-auto px-6">

        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-4xl font-bold text-pink-500 mb-2">Edit Product</h1>
                <p class="text-gray-600">Update product details</p>
            </div>
            <a href="{{ route('admin.products') }}"
                class="bg-gray-200 hover:bg-gray-300 px-6 py-3 rounded-xl font-semibold transition">
                ← Back
            </a>
        </div>

        @if($errors->any())
        <div class="bg-red-100 text-red-700 border border-red-300 px-5 py-3 rounded-xl mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white rounded-3xl shadow-lg p-10">
            <form action="{{ route('admin.update-product', $product->product_id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- PRODUCT NAME --}}
                <div class="mb-6">
                    <label class="block mb-2 font-semibold text-lg">Product Name</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-pink-400">
                </div>

                {{-- BRAND & CATEGORY --}}
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block mb-2 font-semibold text-lg">Brand</label>
                        <select name="brand_id"
                            class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-pink-400">
                            <option value="">Select Brand</option>
                            @foreach($brands as $brand)
                            <option value="{{ $brand->brand_id }}"
                                {{ $product->brand_id == $brand->brand_id ? 'selected' : '' }}>
                                {{ $brand->brand_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold text-lg">Category</label>
                        <select name="category_id"
                            class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-pink-400">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->category_id }}"
                                {{ $product->category_id == $category->category_id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- PRICE & STOCK --}}
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block mb-2 font-semibold text-lg">Price ($)</label>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01"
                            min="0"
                            class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-pink-400">
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold text-lg">Stock Quantity</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0"
                            class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-pink-400">
                    </div>
                </div>

                {{-- CURRENT IMAGE --}}
                <div class="mb-6">
                    <label class="block mb-2 font-semibold text-lg">Current Image</label>
                    @if($product->images->first())
                    <img src="{{ asset($product->images->first()->image_url) }}"
                        class="w-32 h-32 object-cover rounded-2xl mb-3">
                    @else
                    <p class="text-gray-400 text-sm mb-3">No image uploaded</p>
                    @endif
                    <label class="block mb-2 font-semibold text-base text-gray-600">Upload New Image (optional)</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 bg-white">
                </div>

                {{-- DESCRIPTION --}}
                <div class="mb-8">
                    <label class="block mb-2 font-semibold text-lg">Description</label>
                    <textarea name="description" rows="5"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-pink-400">{{ old('description', $product->description) }}</textarea>
                </div>

                {{-- BUTTONS --}}
                <div class="flex gap-4">
                    <button type="submit"
                        class="bg-pink-500 hover:bg-pink-600 text-white px-8 py-4 rounded-2xl text-lg font-semibold transition">
                        Update Product
                    </button>
                    <a href="{{ route('admin.products') }}"
                        class="bg-gray-200 hover:bg-gray-300 px-8 py-4 rounded-2xl text-lg font-semibold transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection