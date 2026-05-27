@extends('layouts.app')

@section('content')

<!-- HERO SECTION -->
<section class="py-24 text-center relative overflow-hidden" style="background:#1a0a0f;">
    <div class="absolute inset-0 opacity-10"
        style="background-image:radial-gradient(circle,#d4537e 1px,transparent 1px);background-size:28px 28px;"></div>
    <div class="container mx-auto px-6 relative z-10">
        <span
            class="inline-block border border-pink-500 text-pink-300 text-xs font-semibold px-4 py-2 rounded-full mb-6 tracking-widest">
            💄 New collection — Summer Glam 2026
        </span>
        <h1 class="text-5xl md:text-6xl font-bold text-white leading-tight mb-6">
            Your beauty, <span class="text-pink-400">your rules</span>
        </h1>
        <p class="text-gray-400 text-lg max-w-xl mx-auto mb-10 leading-relaxed">
            Explore premium cosmetics — lipstick, foundation, eyeshadow, and more — made to make you shine.
        </p>
        <div class="flex flex-wrap justify-center gap-4 mb-14">
            <a href="{{ route('shop') }}"
                class="bg-pink-500 hover:bg-pink-400 text-white px-8 py-3 rounded-full text-base font-semibold transition">Shop
                Now</a>
            <a href="{{ route('brand') }}"
                class="border border-pink-500 text-pink-300 hover:bg-pink-900 px-8 py-3 rounded-full text-base font-semibold transition">View
                Brands</a>
        </div>
        <div class="flex flex-wrap justify-center gap-10">
            <div>
                <p class="text-2xl font-bold text-pink-300">5,000+</p>
                <p class="text-sm text-gray-500">Happy customers</p>
            </div>
            <div>
                <p class="text-2xl font-bold text-pink-300">200+</p>
                <p class="text-sm text-gray-500">Products</p>
            </div>
            <div>
                <p class="text-2xl font-bold text-pink-300">4.9 ★</p>
                <p class="text-sm text-gray-500">Average rating</p>
            </div>
        </div>
    </div>
</section>

<!-- CATEGORIES -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Shop by Category</h2>
            <p class="text-gray-500">Everything you need for the perfect look</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
            <a href="{{ route('shop') }}"
                class="bg-white hover:bg-pink-50 border border-gray-100 hover:border-pink-400 rounded-2xl p-5 text-center transition">
                <div class="text-3xl mb-2">💄</div>
                <p class="font-semibold text-gray-700 text-sm">Lips</p>
                <p class="text-xs text-gray-400 mt-1">{{ $categoryCounts['Lips'] ?? 0 }} items</p>
            </a>
            <a href="{{ route('shop') }}"
                class="bg-white hover:bg-pink-50 border border-gray-100 hover:border-pink-400 rounded-2xl p-5 text-center transition">
                <div class="text-3xl mb-2">👁️</div>
                <p class="font-semibold text-gray-700 text-sm">Eyes</p>
                <p class="text-xs text-gray-400 mt-1">{{ $categoryCounts['Eyes'] ?? 0 }} items</p>
            </a>
            <a href="{{ route('shop') }}"
                class="bg-white hover:bg-pink-50 border border-gray-100 hover:border-pink-400 rounded-2xl p-5 text-center transition">
                <div class="text-3xl mb-2">✨</div>
                <p class="font-semibold text-gray-700 text-sm">Face</p>
                <p class="text-xs text-gray-400 mt-1">{{ $categoryCounts['Face'] ?? 0 }} items</p>
            </a>
            <a href="{{ route('shop') }}"
                class="bg-white hover:bg-pink-50 border border-gray-100 hover:border-pink-400 rounded-2xl p-5 text-center transition">
                <div class="text-3xl mb-2">🧴</div>
                <p class="font-semibold text-gray-700 text-sm">Foundation</p>
                <p class="text-xs text-gray-400 mt-1">{{ $categoryCounts['Foundation'] ?? 0 }} items</p>
            </a>
            <a href="{{ route('shop') }}"
                class="bg-white hover:bg-pink-50 border border-gray-100 hover:border-pink-400 rounded-2xl p-5 text-center transition">
                <div class="text-3xl mb-2">🖌️</div>
                <p class="font-semibold text-gray-700 text-sm">Brushes</p>
                <p class="text-xs text-gray-400 mt-1">{{ $categoryCounts['Brushes'] ?? 0 }} items</p>
            </a>
        </div>
    </div>
</section>

<!-- FEATURED PRODUCTS -->
<section class="py-16 pb-28 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Featured Products</h2>
            <p class="text-gray-500">Our most-loved makeup picks</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @forelse($featuredProducts as $product)
            <a href="{{ route('product.show', $product->product_id) }}"
                class="block relative w-full h-[340px] rounded-[20px] overflow-hidden shadow-lg group hover:shadow-2xl transition duration-300">
                @if($product->images->first())
                <img src="{{ asset($product->images->first()->image_url) }}" alt="{{ $product->name }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                @else
                <img src="https://placehold.co/400x340?text=No+Image" alt="{{ $product->name }}"
                    class="w-full h-full object-cover">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 w-full p-4 text-white">
                    <div class="mt-10">
                        <h2 class="text-md font-bold leading-none">{{ $product->name }}</h2>
                        <p class="text-sm text-white/80 mt-1 line-clamp-1">{{ $product->description }}</p>
                        <div class="flex items-center justify-between mt-4">
                            <span
                                class="text-lg font-bold text-pink-300">${{ number_format($product->price, 2) }}</span>
                            <span
                                class="bg-pink-500 hover:bg-pink-600 text-sm text-white px-5 py-2 rounded-full">View</span>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-4 text-center py-10 text-gray-400">No products yet.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- PROMO BANNER -->
<section class="py-10" style="background:#1a0a0f;">
    <div class="container mx-auto px-6 flex flex-wrap items-center justify-between gap-4">
        <div>
            <h3 class="text-2xl font-bold text-pink-200 mb-1">Free gift with orders over $60 🎁</h3>
            <p class="text-gray-400 text-sm">Use code <span class="font-bold text-pink-300">GLAM60</span> at checkout.
                Limited time only.</p>
        </div>
        <a href="{{ route('shop') }}"
            class="bg-pink-500 hover:bg-pink-400 text-white px-6 py-3 rounded-full font-semibold text-sm transition">Claim
            Now</a>
    </div>
</section>

<!-- WHY CHOOSE US -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Why Shop With Us</h2>
            <p class="text-gray-500">Beauty you can trust, every time</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <div class="bg-pink-50 rounded-2xl p-6">
                <div class="text-3xl mb-3">🐰</div>
                <h4 class="font-semibold text-gray-800 mb-1">Cruelty-Free</h4>
                <p class="text-gray-500 text-sm leading-relaxed">Ethically made and never tested on animals</p>
            </div>
            <div class="bg-pink-50 rounded-2xl p-6">
                <div class="text-3xl mb-3">🚚</div>
                <h4 class="font-semibold text-gray-800 mb-1">Free Shipping</h4>
                <p class="text-gray-500 text-sm leading-relaxed">On all orders over $50, delivered fast</p>
            </div>
            <div class="bg-pink-50 rounded-2xl p-6">
                <div class="text-3xl mb-3">🔄</div>
                <h4 class="font-semibold text-gray-800 mb-1">Easy Returns</h4>
                <p class="text-gray-500 text-sm leading-relaxed">30-day hassle-free returns, no questions asked</p>
            </div>
            <div class="bg-pink-50 rounded-2xl p-6">
                <div class="text-3xl mb-3">🎨</div>
                <h4 class="font-semibold text-gray-800 mb-1">Shade Matching</h4>
                <p class="text-gray-500 text-sm leading-relaxed">Find your perfect shade with our free matching tool</p>
            </div>
        </div>
    </div>
</section>

<!-- REVIEWS -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">What Customers Say</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div
                        class="w-10 h-10 rounded-full bg-pink-100 text-pink-700 flex items-center justify-center font-semibold text-sm">
                        SA</div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">Sophea A.</p>
                        <p class="text-gray-400 text-xs">May 2026</p>
                    </div>
                </div>
                <div class="text-yellow-400 text-xs mb-3">★★★★★</div>
                <p class="text-gray-600 text-sm leading-relaxed">The Velvet Matte Lipstick lasts all day! I wear it to
                    work and it still looks perfect by evening.</p>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div
                        class="w-10 h-10 rounded-full bg-purple-100 text-purple-700 flex items-center justify-center font-semibold text-sm">
                        KR</div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">Kiri R.</p>
                        <p class="text-gray-400 text-xs">Apr 2026</p>
                    </div>
                </div>
                <div class="text-yellow-400 text-xs mb-3">★★★★★</div>
                <p class="text-gray-600 text-sm leading-relaxed">The Smokey Eye Palette is stunning. The pigment is
                    incredible and it blends so easily!</p>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div
                        class="w-10 h-10 rounded-full bg-yellow-100 text-yellow-700 flex items-center justify-center font-semibold text-sm">
                        ML</div>
                    <div>
                        <p class="font-semibold text-gray-800 text-sm">Maly L.</p>
                        <p class="text-gray-400 text-xs">Apr 2026</p>
                    </div>
                </div>
                <div class="text-yellow-400 text-xs mb-3">★★★★★</div>
                <p class="text-gray-600 text-sm leading-relaxed">Finally found my shade in the Glow Foundation. Fast
                    delivery and beautifully packaged too!</p>
            </div>
        </div>
    </div>
</section>

<!-- NEWSLETTER -->
<section class="py-16 bg-pink-50">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-pink-900 mb-2">Join the Magic Beauty Club</h2>
        <p class="text-pink-600 mb-8">Get exclusive deals, new launches, and makeup tips delivered to your inbox.</p>
        <form class="flex flex-wrap justify-center gap-3 max-w-md mx-auto">
            @csrf
            <input type="email" placeholder="your@email.com"
                class="flex-1 min-w-0 px-5 py-3 rounded-full border border-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-400 text-sm" />
            <button type="submit"
                class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-full text-sm font-semibold transition">Subscribe</button>
        </form>
    </div>
</section>

@endsection