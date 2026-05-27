@extends('layouts.app')

@section('content')

<section class="bg-pink-50 min-h-screen flex items-center justify-center py-20">
    <div class="bg-white rounded-3xl shadow-lg p-14 text-center max-w-lg w-full mx-6">

        {{-- Success Icon --}}
        <div class="text-8xl mb-6">🎉</div>

        <h1 class="text-4xl font-bold text-pink-500 mb-4">Order Confirmed!</h1>
        <p class="text-gray-600 text-lg mb-2">Thank you for shopping at <span class="font-bold text-pink-500">Magic
                Shop</span>!</p>
        <p class="text-gray-500 mb-8">Your order has been placed successfully. We'll contact you soon.</p>

        <div class="bg-pink-50 rounded-2xl p-5 mb-8 text-left space-y-2">
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Status</span>
                <span class="text-green-500 font-bold">✅ Payment Received</span>
            </div>
            <div class="flex justify-between text-sm">
                <span class="text-gray-500">Delivery</span>
                <span class="font-semibold text-gray-700">3-5 Business Days</span>
            </div>
        </div>

        <div class="flex flex-col gap-3">
            <a href="{{ route('shop') }}"
                class="block bg-pink-500 hover:bg-pink-600 text-white py-4 rounded-2xl text-base font-semibold transition">
                Continue Shopping 🛍️
            </a>
            <a href="{{ route('home') }}"
                class="block border-2 border-pink-500 text-pink-500 hover:bg-pink-50 py-3 rounded-2xl text-sm font-semibold transition">
                Back to Home
            </a>
        </div>
    </div>
</section>

@endsection