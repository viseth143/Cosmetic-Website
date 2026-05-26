@extends('layouts.app')
@section('content')
<section class="min-h-screen flex items-center justify-center bg-pink-100 py-20">
    <div class="bg-white shadow-2xl rounded-3xl p-10 w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-pink-500 mb-3">Create an account</h1>
            <p class="text-gray-600">Welcome to Magic Shop</p>
        </div>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label class="block mb-2 font-semibold">Username</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter your username"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400">
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label class="block mb-2 font-semibold">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400">
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label class="block mb-2 font-semibold">Password</label>
                <input type="password" name="password" placeholder="Enter your password"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400">
                @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label class="block mb-2 font-semibold">Address</label>
                <input type="text" name="address" value="{{ old('address') }}" placeholder="Enter your address"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400">
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-semibold">Phone Number</label>
                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Enter your phone number"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400">
                @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit"
                class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-xl text-lg font-semibold">
                Register
            </button>
        </form>

        <p class="text-center text-gray-600 mt-6">
            Have an account already?
            <a href="{{ route('login') }}" class="text-pink-500 font-semibold hover:underline">Login</a>
        </p>
    </div>
</section>
@endsection