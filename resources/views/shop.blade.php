@extends('layouts.app')

@section('content')

<!-- PAGE TITLE -->
<section class="bg-pink-100 py-16">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-5xl font-bold text-pink-600 mb-4">
            Shop All Products
        </h1>
        <p class="text-gray-700 text-lg">
            Discover our cosmetics collection
        </p>
    </div>
</section>

<!-- PRODUCTS -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        @if($products->isEmpty())
        <div class="text-center py-20">
            <p class="text-gray-500 text-xl">No products found.</p>
        </div>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-8">

            @foreach($products as $product)
            <a href="{{ route('product.show', $product->product_id) }}"
                class="block relative w-[250px] h-[350px] rounded-[20px] overflow-hidden shadow-lg group hover:shadow-2xl transition duration-300">

                {{-- Product Image --}}
                @if($product->images->first())
                <img src="{{ asset($product->images->first()->image_url) }}" alt="{{ $product->name }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                @else
                <img src="https://placehold.co/400x340?text=No+Image" alt="{{ $product->name }}"
                    class="w-full h-full object-cover">
                @endif

                {{-- Dark Gradient Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                {{-- Content --}}
                <div class="absolute bottom-0 left-0 w-full p-4 text-white">
                    <div class="mt-10">
                        {{-- Product Name --}}
                        <h2 class="text-md font-bold leading-none">
                            {{ $product->name }}
                        </h2>
                        {{-- Description --}}
                        <p class="text-sm text-white/80 mt-1 line-clamp-1">
                            {{ $product->description }}
                        </p>
                        {{-- Bottom Row --}}
                        <div class="flex items-center justify-between mt-4">
                            {{-- Price --}}
                            <span class="text-lg font-bold text-pink-300">
                                ${{ number_format($product->price, 2) }}
                            </span>
                            {{-- Button --}}
                            <span class="bg-pink-500 hover:bg-pink-600 text-sm text-white px-5 py-2 rounded-full">
                                View
                            </span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection