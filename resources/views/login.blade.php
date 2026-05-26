@extends('layouts.app')
@section('content')
<section class="min-h-screen flex items-center justify-center bg-pink-100 py-20">
    <div class="bg-white shadow-2xl rounded-3xl p-10 w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-pink-500 mb-3">Welcome Back</h1>
            <p class="text-gray-600">Login to your account</p>
        </div>

        {{-- Show errors --}}
        @if(session('error'))
        <div class="bg-red-100 text-red-600 px-4 py-3 rounded-xl mb-5">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label class="block mb-2 font-semibold">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400">
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-semibold">Password</label>
                <input type="password" name="password" placeholder="Enter your password"
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-400">
                @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit"
                class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-xl text-lg font-semibold">
                Login
            </button>
        </form>

        <p class="text-center text-gray-600 mt-6">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-pink-500 font-semibold hover:underline">Register</a>
        </p>
    </div>
</section>
@endsection