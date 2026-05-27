@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-pink-50">
    <main class="flex-1 p-8">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-4xl font-bold text-gray-800">Dashboard</h2>
                <p class="text-gray-500">Welcome back, {{ Session::get('admin_name', 'Admin') }} 👋</p>
            </div>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="bg-red-100 hover:bg-red-200 text-red-600 px-5 py-2 rounded-xl font-semibold transition">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
        </div>

        <!-- STATISTICS -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-3xl shadow-lg hover:shadow-xl transition">
                <div class="text-3xl mb-3">📦</div>
                <h3 class="text-gray-500 mb-1">Total Products</h3>
                <h2 class="text-4xl font-bold text-pink-500">{{ $totalProducts }}</h2>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow-lg hover:shadow-xl transition">
                <div class="text-3xl mb-3">🏷️</div>
                <h3 class="text-gray-500 mb-1">Brands</h3>
                <h2 class="text-4xl font-bold text-pink-500">{{ $totalBrands }}</h2>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow-lg hover:shadow-xl transition">
                <div class="text-3xl mb-3">🛒</div>
                <h3 class="text-gray-500 mb-1">Orders</h3>
                <h2 class="text-4xl font-bold text-pink-500">{{ $totalOrders }}</h2>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow-lg hover:shadow-xl transition">
                <div class="text-3xl mb-3">👥</div>
                <h3 class="text-gray-500 mb-1">Customers</h3>
                <h2 class="text-4xl font-bold text-pink-500">{{ $totalCustomers }}</h2>
            </div>
        </div>

        <!-- RECENT PRODUCTS -->
        <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
            <div class="p-6 border-b flex justify-between items-center">
                <h3 class="text-2xl font-bold">Recent Products</h3>
                <a href="{{ route('admin.products') }}" class="text-pink-500 hover:underline text-sm font-semibold">
                    View All →
                </a>
            </div>
            <table class="w-full">
                <thead class="bg-pink-50">
                    <tr>
                        <th class="text-left p-4">Image</th>
                        <th class="text-left p-4">Product</th>
                        <th class="text-left p-4">Brand</th>
                        <th class="text-left p-4">Price</th>
                        <th class="text-left p-4">Stock</th>
                        <th class="text-left p-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentProducts as $product)
                    <tr class="border-b hover:bg-pink-50 transition">
                        <td class="p-4">
                            <img src="{{ $product->images->first() ? asset($product->images->first()->image_url) : 'https://placehold.co/60x60?text=?' }}"
                                class="w-14 h-14 rounded-xl object-cover">
                        </td>
                        <td class="p-4 font-semibold">{{ $product->name }}</td>
                        <td class="p-4 text-gray-600">{{ $product->brand->brand_name ?? '-' }}</td>
                        <td class="p-4 text-pink-500 font-bold">${{ number_format($product->price, 2) }}</td>
                        <td class="p-4">
                            <span class="{{ $product->stock > 0 ? 'text-green-600' : 'text-red-500' }} font-semibold">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td class="p-4 space-x-2">
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
                        <td colspan="6" class="text-center py-10 text-gray-400">No products yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>
</div>
@endsection