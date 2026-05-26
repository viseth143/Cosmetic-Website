@extends('layouts.app')

@section('content')

<!-- PAGE HEADER -->
<section class="bg-pink-100 py-16">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-5xl font-bold text-pink-600 mb-4">Shopping Cart</h1>
        <p class="text-lg text-gray-700">Review your selected products</p>
    </div>
</section>

<!-- CART SECTION -->
<section class="py-16 bg-pink-50 min-h-screen">
    <div class="container mx-auto px-6">

        @if(session('success'))
        <div
            class="bg-green-100 text-green-700 border border-green-300 px-5 py-3 rounded-xl mb-6 flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
        </div>
        @endif

        @if($cartItems->isEmpty())
        <div class="text-center py-24">
            <div class="text-8xl mb-6">🛒</div>
            <h2 class="text-3xl font-bold text-gray-700 mb-3">Your cart is empty</h2>
            <p class="text-gray-500 mb-8">Looks like you haven't added anything yet.</p>
            <a href="{{ route('shop') }}"
                class="bg-pink-500 hover:bg-pink-600 text-white px-10 py-4 rounded-full text-base font-semibold transition">
                Start Shopping
            </a>
        </div>

        @else
        <div class="grid lg:grid-cols-3 gap-10">

            <!-- CART ITEMS -->
            <div class="lg:col-span-2 bg-white rounded-3xl shadow-lg p-8">
                <h2 class="text-2xl font-bold mb-8 text-gray-800">
                    Cart Items <span class="text-pink-500 text-lg">({{ $cartItems->count() }})</span>
                </h2>

                @foreach($cartItems as $item)
                <div class="flex flex-col md:flex-row items-center justify-between border-b pb-6 mb-6 gap-4">

                    <div class="flex items-center gap-5 flex-1">
                        <img src="{{ $item->product->images->first() ? asset($item->product->images->first()->image_url) : 'https://placehold.co/100x100?text=?' }}"
                            alt="{{ $item->product->name }}" class="w-24 h-24 rounded-2xl object-cover shadow-sm">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $item->product->name }}</h3>
                            <p class="text-gray-500 text-sm mb-1">{{ Str::limit($item->product->description, 50) }}</p>
                            <span class="text-pink-500 font-bold text-base">${{ number_format($item->price, 2) }}</span>
                        </div>
                    </div>

                    <!-- Quantity Controls -->
                    <div class="flex items-center gap-3">
                        <form action="{{ route('cart.update', $item->cart_item_id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                            <button type="submit"
                                class="w-9 h-9 bg-gray-100 hover:bg-pink-100 rounded-lg text-lg font-bold transition">−</button>
                        </form>

                        <span class="text-xl font-bold text-gray-800 w-8 text-center">{{ $item->quantity }}</span>

                        <form action="{{ route('cart.update', $item->cart_item_id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                            <button type="submit"
                                class="w-9 h-9 bg-gray-100 hover:bg-pink-100 rounded-lg text-lg font-bold transition">+</button>
                        </form>
                    </div>

                    <!-- Item Total -->
                    <p class="font-bold text-gray-800 min-w-[80px] text-right">
                        ${{ number_format($item->price * $item->quantity, 2) }}
                    </p>

                    <!-- Remove -->
                    <form action="{{ route('cart.remove', $item->cart_item_id) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-red-500 transition text-lg">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>

                </div>
                @endforeach

                <a href="{{ route('shop') }}"
                    class="inline-block mt-2 bg-pink-500 hover:bg-pink-600 text-white px-8 py-3 rounded-full font-semibold transition">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Continue Shopping
                </a>
            </div>

            <!-- ORDER SUMMARY -->
            <div class="bg-white rounded-3xl shadow-lg p-8 h-fit sticky top-6">
                <h2 class="text-2xl font-bold mb-8 text-gray-800">Order Summary</h2>
                <div class="space-y-5">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span class="font-semibold text-gray-800">${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Shipping</span>
                        <span class="font-semibold text-gray-800">
                            @if($shipping == 0)
                            <span class="text-green-500">Free 🎉</span>
                            @else
                            ${{ number_format($shipping, 2) }}
                            @endif
                        </span>
                    </div>
                    @if($shipping > 0)
                    <div class="bg-pink-50 rounded-xl px-4 py-3 text-sm text-pink-600">
                        💡 Add ${{ number_format(50 - $subtotal, 2) }} more for free shipping!
                    </div>
                    @endif
                    <div class="border-t pt-5 flex justify-between text-xl font-bold">
                        <span>Total</span>
                        <span class="text-pink-500">${{ number_format($total, 2) }}</span>
                    </div>
                </div>
                <a href="{{ route('checkout') }}"
                    class="block text-center w-full mt-8 bg-pink-500 hover:bg-pink-600 text-white py-4 rounded-2xl text-base font-semibold transition">
                    Proceed to Checkout <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>

        </div>
        @endif
    </div>
</section>

@endsection