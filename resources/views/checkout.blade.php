@extends('layouts.app')

@section('content')

<!-- CHECKOUT HEADER -->
<section class="bg-pink-100 py-16">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-5xl font-bold text-pink-600 mb-4">Checkout</h1>
        <p class="text-lg text-gray-700">Complete your order</p>
    </div>
</section>

<!-- CHECKOUT CONTENT -->
<section class="bg-pink-50 py-16 min-h-screen">
    <div class="container mx-auto px-6">
        <div class="grid lg:grid-cols-3 gap-10">

            <!-- BILLING FORM -->
            <div class="lg:col-span-2 bg-white rounded-3xl shadow-lg p-10">
                <h2 class="text-3xl font-bold mb-8">Billing Details</h2>

                <form method="POST" action="#">
                    @csrf

                    <!-- NAME -->
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block mb-2 font-semibold">First Name</label>
                            <input type="text" name="first_name" placeholder="Enter first name"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400">
                        </div>
                        <div>
                            <label class="block mb-2 font-semibold">Last Name</label>
                            <input type="text" name="last_name" placeholder="Enter last name"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400">
                        </div>
                    </div>

                    <!-- EMAIL -->
                    <div class="mb-6">
                        <label class="block mb-2 font-semibold">Email Address</label>
                        <input type="email" name="email" placeholder="Enter email"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400">
                    </div>

                    <!-- PHONE -->
                    <div class="mb-6">
                        <label class="block mb-2 font-semibold">Phone Number</label>
                        <input type="text" name="phone" placeholder="Enter phone number"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400">
                    </div>

                    <!-- ADDRESS -->
                    <div class="mb-6">
                        <label class="block mb-2 font-semibold">Address</label>
                        <input type="text" name="address" placeholder="Street address"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400">
                    </div>

                    <!-- CITY & POSTAL -->
                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block mb-2 font-semibold">City</label>
                            <input type="text" name="city" placeholder="Enter city"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400">
                        </div>
                        <div>
                            <label class="block mb-2 font-semibold">Postal Code</label>
                            <input type="text" name="postal_code" placeholder="Postal code"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400">
                        </div>
                    </div>

                    <!-- PAYMENT -->
                    <div class="mb-8">
                        <label class="block mb-4 font-semibold text-xl">Payment Method</label>
                        <div class="space-y-4">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" name="payment_method" value="card" class="text-pink-500">
                                <span>Credit / Debit Card</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" name="payment_method" value="aba" checked class="text-pink-500">
                                <span>ABA Pay</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="radio" name="payment_method" value="cod" class="text-pink-500">
                                <span>Cash on Delivery</span>
                            </label>
                        </div>
                    </div>

                    <!-- PLACE ORDER -->
                    <a href="{{ route('payment') }}"
                        class="block text-center w-full bg-pink-500 hover:bg-pink-600 text-white py-4 rounded-2xl text-lg font-semibold">

                        Place Order

                    </a>
                </form>
            </div>

            <!-- ORDER SUMMARY -->
            <div class="bg-white rounded-3xl shadow-lg p-8 h-fit sticky top-6">
                <h2 class="text-2xl font-bold mb-6">Order Summary</h2>

                @if($cartItems->isEmpty())
                <p class="text-gray-500 text-center py-4">No items in cart.</p>
                @else
                @foreach($cartItems as $item)
                <div class="flex justify-between items-center mb-5 pb-4 border-b">
                    <div class="flex items-center gap-3">
                        <img src="{{ $item->product->images->first() ? asset($item->product->images->first()->image_url) : 'https://placehold.co/60x60?text=?' }}"
                            class="w-14 h-14 rounded-xl object-cover">
                        <div>
                            <h3 class="font-bold text-sm">{{ $item->product->name }}</h3>
                            <p class="text-gray-500 text-xs">Qty: {{ $item->quantity }}</p>
                        </div>
                    </div>
                    <span class="font-bold text-sm">${{ number_format($item->price * $item->quantity, 2) }}</span>
                </div>
                @endforeach

                <!-- TOTAL -->
                <div class="space-y-4 mt-4">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span class="font-bold">${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Shipping</span>
                        <span class="font-bold">
                            @if($shipping == 0)
                            <span class="text-green-500">Free 🎉</span>
                            @else
                            ${{ number_format($shipping, 2) }}
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between text-xl font-bold border-t pt-4">
                        <span>Total</span>
                        <span class="text-pink-500">${{ number_format($total, 2) }}</span>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</section>

@endsection