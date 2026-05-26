@extends('layouts.admin')

@section('content')
<section class="p-10 bg-pink-50 min-h-screen">
    <div class="bg-white rounded-3xl shadow-lg p-8">

        {{-- Messages --}}
        @if(session('success'))
        <div class="bg-green-100 text-green-700 border border-green-300 px-5 py-3 rounded-xl mb-6">
            {{ session('success') }}
        </div>
        @endif

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-pink-500">Products</h1>
            <a href="{{ route('admin.add-product') }}"
                class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-xl font-semibold transition">
                + Add Product
            </a>
        </div>

        <table class="w-full text-left">
            <thead>
                <tr class="border-b bg-pink-50">
                    <th class="py-4 px-3">Image</th>
                    <th class="px-3">Name</th>
                    <th class="px-3">Category</th>
                    <th class="px-3">Brand</th>
                    <th class="px-3">Price</th>
                    <th class="px-3">Stock</th>
                    <th class="px-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="border-b hover:bg-pink-50 transition">
                    <td class="py-4 px-3">
                        <img src="{{ $product->images->first() ? asset($product->images->first()->image_url) : 'https://placehold.co/60x60?text=?' }}"
                            class="w-14 h-14 rounded-xl object-cover">
                    </td>
                    <td class="px-3 font-semibold">{{ $product->name }}</td>
                    <td class="px-3 text-gray-600">{{ $product->category->category_name ?? '-' }}</td>
                    <td class="px-3 text-gray-600">{{ $product->brand->brand_name ?? '-' }}</td>
                    <td class="px-3 text-pink-500 font-bold">${{ number_format($product->price, 2) }}</td>
                    <td class="px-3">
                        <span class="{{ $product->stock > 0 ? 'text-green-600' : 'text-red-500' }} font-semibold">
                            {{ $product->stock }}
                        </span>
                    </td>
                    <td class="px-3 space-x-2">
                        <a href="{{ route('admin.edit-product', $product->product_id) }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition">
                            Edit
                        </a>
                        <form action="{{ route('admin.delete-product', $product->product_id) }}" method="POST"
                            class="inline" onsubmit="return confirm('Delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-10 text-gray-400">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection