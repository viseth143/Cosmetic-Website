@extends('layouts.admin')

@section('content')
<section class="bg-pink-50 min-h-screen py-10">
    <div class="container mx-auto px-6">

        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-4xl font-bold text-pink-500 mb-2">Add Brand</h1>
                <p class="text-gray-600">Add a new brand to your store</p>
            </div>
            <a href="{{ route('admin.brands') }}"
                class="bg-gray-200 hover:bg-gray-300 px-6 py-3 rounded-xl font-semibold transition">
                ← Back
            </a>
        </div>

        @if($errors->any())
        <div class="bg-red-100 text-red-700 border border-red-300 px-5 py-3 rounded-xl mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white rounded-3xl shadow-lg p-10">
            <form action="{{ route('admin.store-brand') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label class="block mb-2 font-semibold text-lg">Brand Name</label>
                    <input type="text" name="brand_name" value="{{ old('brand_name') }}" placeholder="Enter brand name"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-pink-400">
                </div>

                <div class="mb-8">
                    <label class="block mb-2 font-semibold text-lg">Description</label>
                    <textarea name="description" rows="4" placeholder="Enter brand description"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-pink-400">{{ old('description') }}</textarea>
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                        class="bg-pink-500 hover:bg-pink-600 text-white px-8 py-4 rounded-2xl text-lg font-semibold transition">
                        Save Brand
                    </button>
                    <button type="reset"
                        class="bg-gray-200 hover:bg-gray-300 px-8 py-4 rounded-2xl text-lg font-semibold transition">
                        Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection