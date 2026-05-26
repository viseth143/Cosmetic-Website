@extends('layouts.app')

@section('content')

<style>
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type=number] {
    -moz-appearance: textfield;
}
</style>

<!-- PRODUCT DETAIL -->
<section class="bg-pink-50 py-16 min-h-screen">
    <div class="container mx-auto px-6">
        {{-- Success / Error Messages --}}
        @if(session('success'))
        <div
            class="bg-green-100 text-green-700 border border-green-300 px-5 py-3 rounded-xl mb-6 flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
        @endif

        {{-- MAIN PRODUCT CARD --}}
        <div class="grid md:grid-cols-2 gap-12 bg-white rounded-3xl shadow-lg p-10">

            {{-- LEFT: Image Gallery --}}
            <div>
                {{-- Main Image --}}
                <div class="rounded-3xl overflow-hidden shadow-md bg-gray-100 flex items-center justify-center"
                    style="width: 450px; height: 550px;">
                    <img id="mainImage"
                        src="{{ $product->images->first() ? asset($product->images->first()->image_url) : 'https://placehold.co/600x600?text=No+Image' }}"
                        alt="{{ $product->name }}" class="w-full h-full object-cover">
                </div>

                {{-- Thumbnails --}}
                @if($product->images->count() > 1)
                <div class="flex gap-3 mt-4 flex-wrap">
                    @foreach($product->images as $img)
                    <img src="{{ asset($img->image_url) }}" alt="thumbnail"
                        onclick="document.getElementById('mainImage').src = this.src; document.querySelectorAll('.thumb').forEach(t => t.classList.remove('border-pink-500')); this.classList.add('border-pink-500');"
                        class="thumb w-20 h-20 object-cover rounded-2xl cursor-pointer border-2 border-gray-200 hover:border-pink-400 transition">
                    @endforeach
                </div>
                @endif
            </div>

            {{-- RIGHT: Product Info --}}
            <div>
                {{-- Brand --}}
                @if($product->brand)
                <p class="text-pink-500 font-semibold text-base mb-1">
                    {{ $product->brand->brand_name }}
                </p>
                @endif

                {{-- Name --}}
                <h1 class="text-4xl font-bold text-gray-800 mb-4">
                    {{ $product->name }}
                </h1>

                {{-- Stars --}}
                <div class="text-yellow-400 text-sm mb-4">★★★★★</div>

                {{-- Price --}}
                <div class="flex items-center gap-4 mb-6">
                    <span class="text-4xl font-bold text-pink-500">
                        ${{ number_format($product->price, 2) }}
                    </span>
                </div>

                {{-- Description --}}
                <p class="text-gray-600 leading-8 mb-6">
                    {{ $product->description ?? 'No description available.' }}
                </p>

                {{-- Details --}}
                <div class="space-y-3 mb-6">
                    @if($product->category)
                    <div class="flex gap-3">
                        <span class="font-bold text-gray-700">Category:</span>
                        <span class="text-gray-600">{{ $product->category->category_name }}</span>
                    </div>
                    @endif
                    <div class="flex gap-3">
                        <span class="font-bold text-gray-700">Stock:</span>
                        @if($product->stock > 0)
                        <span class="text-green-500 font-semibold">In Stock ({{ $product->stock }} left)</span>
                        @else
                        <span class="text-red-500 font-semibold">Out of Stock</span>
                        @endif
                    </div>
                </div>

                {{-- Product Options --}}
                @foreach($product->options as $option)
                <div class="mb-5">
                    <p class="font-bold text-gray-700 mb-2">{{ $option->option_name }}:</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($option->values->where('is_active', true) as $val)
                        <label class="cursor-pointer">
                            <input type="radio" name="option_{{ $option->product_option_id }}"
                                value="{{ $val->product_option_value_id }}" class="hidden peer">
                            <span
                                class="px-4 py-2 rounded-full border-2 border-gray-200 text-sm font-medium peer-checked:border-pink-500 peer-checked:text-pink-500 hover:border-pink-300 transition">
                                {{ $val->option_value }}
                                @if($val->price_modifier > 0)
                                <span class="text-xs text-gray-400">(+${{ $val->price_modifier }})</span>
                                @endif
                            </span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach

                {{-- ADD TO CART FORM --}}
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">

                    {{-- Quantity --}}
                    <div class="flex items-center gap-4 mb-6">
                        <span class="font-bold text-gray-700 text-base">Quantity:</span>
                        <div class="flex items-center border-2 border-gray-200 rounded-xl overflow-hidden">
                            <button type="button"
                                onclick="const q=document.getElementById('qty'); q.value=Math.max(1,parseInt(q.value)-1)"
                                class="px-4 py-2 bg-gray-100 hover:bg-pink-100 text-lg font-bold transition">
                                −
                            </button>
                            <input type="number" id="qty" name="quantity" value="1" min="1"
                                class="w-14 text-center border-none outline-none text-lg font-semibold py-2">
                            <button type="button"
                                onclick="const q=document.getElementById('qty'); q.value=parseInt(q.value)+1"
                                class="px-4 py-2 bg-gray-100 hover:bg-pink-100 text-lg font-bold transition">
                                +
                            </button>
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex flex-wrap gap-4">
                        @if($product->stock > 0)
                        <button type="submit"
                            class="bg-pink-500 hover:bg-pink-600 text-white px-8 py-4 rounded-2xl text-base font-semibold transition flex items-center gap-2">
                            <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                        </button>
                        @else
                        <button type="button" disabled
                            class="bg-gray-300 text-gray-500 px-8 py-4 rounded-2xl text-base font-semibold cursor-not-allowed">
                            Out of Stock
                        </button>
                        @endif
                        <a href="{{ route('cart') }}"
                            class="border-2 border-pink-500 text-pink-500 hover:bg-pink-500 hover:text-white px-8 py-4 rounded-2xl text-base font-semibold transition">
                            View Cart
                        </a>
                    </div>
                </form>

            </div>
        </div>

        {{-- RELATED PRODUCTS --}}
        @if($related->count())
        <div class="mt-20">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">
                You May Also Like
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach($related as $r)
                <a href="{{ route('product.show', $r->product_id) }}"
                    class="bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <img src="{{ $r->images->first() ? asset($r->images->first()->image_url) : 'https://placehold.co/400x300?text=No+Image' }}"
                        alt="{{ $r->name }}" class="w-full h-52 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $r->name }}</h3>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $r->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-pink-500 text-xl font-bold">${{ number_format($r->price, 2) }}</span>
                            <span
                                class="bg-pink-500 hover:bg-pink-600 text-white px-5 py-2 rounded-xl text-sm font-semibold">
                                View
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>

@endsection