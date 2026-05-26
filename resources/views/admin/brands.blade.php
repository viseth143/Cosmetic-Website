@extends('layouts.admin')

@section('content')
<section class="p-10 bg-pink-50 min-h-screen">
    <div class="bg-white rounded-3xl shadow-lg p-8">

        @if(session('success'))
        <div class="bg-green-100 text-green-700 border border-green-300 px-5 py-3 rounded-xl mb-6">
            {{ session('success') }}
        </div>
        @endif

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-pink-500">Brands</h1>
            <a href="{{ route('admin.add-brand') }}"
                class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-xl font-semibold transition">
                + Add Brand
            </a>
        </div>

        <table class="w-full text-left">
            <thead>
                <tr class="border-b bg-pink-50">
                    <th class="py-4 px-3">#</th>
                    <th class="px-3">Brand Name</th>
                    <th class="px-3">Description</th>
                    <th class="px-3">Status</th>
                    <th class="px-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($brands as $brand)
                <tr class="border-b hover:bg-pink-50 transition">
                    <td class="py-4 px-3 text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-3 font-semibold">{{ $brand->brand_name }}</td>
                    <td class="px-3 text-gray-600">{{ $brand->description ?? '-' }}</td>
                    <td class="px-3">
                        <span
                            class="px-3 py-1 rounded-full text-xs font-semibold {{ $brand->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $brand->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-3 space-x-2">
                        <a href="{{ route('admin.edit-brand', $brand->brand_id) }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition">
                            Edit
                        </a>
                        <form action="{{ route('admin.delete-brand', $brand->brand_id) }}" method="POST" class="inline"
                            onsubmit="return confirm('Delete this brand?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-10 text-gray-400">No brands found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection