@extends('layouts.app')

@section('title', 'Edit Hero Section - BakeryChrips')

@section('content')
<div class="pt-24 pb-12 max-w-3xl mx-auto px-4 md:px-6">
    <div class="flex items-center mb-8">
        <a href="{{ route('admin.cms.index') }}" class="text-[#C2185B] hover:underline mr-4">
            <i class="bi bi-arrow-left"></i> Back to CMS
        </a>
        <h1 class="text-3xl font-bold text-[#C2185B]">Edit Hero Section</h1>
    </div>

    <form action="{{ route('admin.cms.hero.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Title</label>
            <input type="text" name="title" value="{{ $hero->title ?? 'Toko Roti Terbaik' }}" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Subtitle</label>
            <input type="text" name="subtitle" value="{{ $hero->subtitle ?? 'Segar & Lezat' }}" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea name="description" rows="3" required 
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">{{ $hero->description ?? 'Nikmati berbagai macam roti dan kue segar buatan tangan. Pesan online dengan mudah dan cepat.' }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Button Text</label>
            <input type="text" name="button_text" value="{{ $hero->button_text ?? 'Lihat Produk' }}" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Button Link</label>
            <input type="text" name="button_link" value="{{ $hero->button_link ?? '#terlaris' }}" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Cake Image</label>
            @if($hero && $hero->cake_image)
            <div class="mb-2">
                <img src="{{ $hero->cake_image_url }}" class="h-20 w-20 object-cover rounded border">
                <p class="text-xs text-gray-500">Current: {{ $hero->cake_image }}</p>
            </div>
            @endif
            <input type="file" name="cake_image" accept="image/*"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Max: 2MB</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Strawberry Left</label>
            @if($hero && $hero->strawberry_left)
            <div class="mb-2">
                <img src="{{ $hero->strawberry_left_url }}" class="h-20 w-20 object-cover rounded border">
                <p class="text-xs text-gray-500">Current: {{ $hero->strawberry_left }}</p>
            </div>
            @endif
            <input type="file" name="strawberry_left" accept="image/*"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Strawberry Right</label>
            @if($hero && $hero->strawberry_right)
            <div class="mb-2">
                <img src="{{ $hero->strawberry_right_url }}" class="h-20 w-20 object-cover rounded border">
                <p class="text-xs text-gray-500">Current: {{ $hero->strawberry_right }}</p>
            </div>
            @endif
            <input type="file" name="strawberry_right" accept="image/*"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-[#C2185B] text-white rounded-full hover:bg-[#F8BBD9] transition">
                Update Hero Section
            </button>
        </div>
    </form>
</div>
@endsection