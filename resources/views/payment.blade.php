@extends('layouts.app')

@section('content')

<!-- HEADER -->
<section class="bg-pink-100 py-16">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-5xl font-bold text-pink-600 mb-4">Payment</h1>
        <p class="text-lg text-gray-700">Complete your payment via ABA Pay</p>
    </div>
</section>

<!-- PAYMENT CONTENT -->
<section class="bg-pink-50 py-16 min-h-screen">
    <div class="container mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-10 max-w-5xl mx-auto">

            <!-- QR CODE -->
            <div class="bg-white rounded-3xl shadow-lg p-10 text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Scan to Pay</h2>
                <p class="text-gray-500 mb-6">Open your ABA app and scan the QR code below</p>

                <div class="flex justify-center mb-6">
                    <img src="{{ asset('Images/Qr_Payment.jpg') }}" alt="ABA Pay QR Code"
                        class="w-64 h-64 object-contain rounded-2xl shadow-md border-4 border-pink-100">
                </div>

                <div class="bg-pink-50 rounded-2xl p-4 mb-6">
                    <p class="text-gray-600 text-sm mb-1">Account Name</p>
                    <p class="font-bold text-gray-800 text-lg">Magic Shop</p>
                </div>

                <div class="flex items-center justify-center gap-2 text-pink-500 text-sm font-semibold">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>Secure Payment via ABA Pay</span>
                </div>
            </div>

            <!-- ORDER CONFIRMATION -->
            <div class="bg-white rounded-3xl shadow-lg p-10">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Order Summary</h2>

                @if(isset($cartItems) && !$cartItems->isEmpty())
                @foreach($cartItems as $item)
                <div class="flex justify-between items-center mb-4 pb-4 border-b">
                    <div class="flex items-center gap-3">
                        <img src="{{ $item->product->images->first() ? asset($item->product->images->first()->image_url) : 'https://placehold.co/60x60?text=?' }}"
                            class="w-14 h-14 rounded-xl object-cover">
                        <div>
                            <p class="font-bold text-sm">{{ $item->product->name }}</p>
                            <p class="text-gray-500 text-xs">Qty: {{ $item->quantity }}</p>
                        </div>
                    </div>
                    <span class="font-bold text-sm">${{ number_format($item->price * $item->quantity, 2) }}</span>
                </div>
                @endforeach

                <div class="space-y-3 mt-4">
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
                @else
                <p class="text-gray-400 text-center py-4">No items found.</p>
                @endif

                <!-- STEPS -->
                <div class="mt-8 bg-pink-50 rounded-2xl p-5">
                    <p class="font-bold text-gray-700 mb-3">How to pay:</p>
                    <ol class="space-y-2 text-sm text-gray-600 list-decimal list-inside">
                        <li>Open your <span class="font-semibold text-pink-500">ABA Mobile</span> app</li>
                        <li>Tap <span class="font-semibold">Pay</span> → <span class="font-semibold">Scan QR</span></li>
                        <li>Scan the QR code on the left</li>
                        <li>Enter the amount and confirm</li>
                        <li>Click <span class="font-semibold text-pink-500">I've Paid</span> below</li>
                    </ol>
                </div>

                <!-- CONFIRM BUTTON -->
                <a href="{{ route('order.success') }}"
                    class="block text-center w-full mt-6 bg-pink-500 hover:bg-pink-600 text-white py-4 rounded-2xl text-lg font-semibold transition">
                    ✅ I've Paid — Confirm Order
                </a>

                <a href="{{ route('cart') }}"
                    class="block text-center w-full mt-3 border-2 border-gray-200 hover:bg-gray-50 text-gray-500 py-3 rounded-2xl text-sm font-semibold transition">
                    ← Back to Cart
                </a>
            </div>

        </div>
    </div>
</section>

@endsection