@extends('layouts.admin')

@section('content')
<section class="bg-pink-50 min-h-screen py-10">
    <div class="container mx-auto px-6">

        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-4xl font-bold text-pink-500 mb-2">Edit Brand</h1>
                <p class="text-gray-600">Update brand details</p>
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
            <form action="{{ route('admin.update-brand', $brand->brand_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block mb-2 font-semibold text-lg">Brand Name</label>
                    <input type="text" name="brand_name" value="{{ old('brand_name', $brand->brand_name) }}"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-pink-400">
                </div>

                <div class="mb-6">
                    <label class="block mb-2 font-semibold text-lg">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full border border-gray-300 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-pink-400">{{ old('description', $brand->description) }}</textarea>
                </div>

                <div class="mb-8">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ $brand->is_active ? 'checked' : '' }}
                            class="w-5 h-5 accent-pink-500">
                        <span class="font-semibold">Active</span>
                    </label>
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                        class="bg-pink-500 hover:bg-pink-600 text-white px-8 py-4 rounded-2xl text-lg font-semibold transition">
                        Update Brand
                    </button>
                    <a href="{{ route('admin.brands') }}"
                        class="bg-gray-200 hover:bg-gray-300 px-8 py-4 rounded-2xl text-lg font-semibold transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection