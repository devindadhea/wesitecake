@extends('layouts.app')

@section('title', 'Edit About Section - BakeryChrips')

@section('content')
<div class="pt-24 pb-12 max-w-3xl mx-auto px-4 md:px-6">
    <div class="flex items-center mb-8">
        <a href="{{ route('admin.cms.index') }}" class="text-[#C2185B] hover:underline mr-4">
            <i class="bi bi-arrow-left"></i> Back to CMS
        </a>
        <h1 class="text-3xl font-bold text-[#C2185B]">Edit About Section</h1>
    </div>

    <form action="{{ route('admin.cms.about.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 mb-6">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Title</label>
            <input type="text" name="title" value="{{ $about->title ?? 'Tentang Bakery Chrips' }}" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea name="description" rows="4" required 
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">{{ $about->description ?? 'BakeryChrips adalah toko roti modern yang menyediakan produk segar buatan tangan. Kami fokus pada kualitas bahan dan rasa yang autentik.' }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Image</label>
            @if($about && $about->image)
            <div class="mb-2">
                <img src="{{ $about->image_url }}" class="h-20 w-20 object-cover rounded border">
                <p class="text-xs text-gray-500">Current: {{ $about->image }}</p>
            </div>
            @endif
            <input type="file" name="image" accept="image/*"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Max: 2MB</p>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-[#C2185B] text-white rounded-full hover:bg-[#F8BBD9] transition">
                Update About Section
            </button>
        </div>
    </form>

    <!-- Features List (sama seperti sebelumnya) -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-[#C2185B]">Features</h2>
            <a href="{{ route('admin.features.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition text-sm">
                + Add Feature
            </a>
        </div>

        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-2">Title</th>
                    <th class="text-left">Order</th>
                    <th class="text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($features as $feature)
                <tr class="border-b">
                    <td class="py-2">{{ $feature->title }}</td>
                    <td>{{ $feature->order }}</td>
                    <td>
                        <a href="{{ route('admin.features.edit', $feature) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('admin.features.destroy', $feature) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-gray-500">No features found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection