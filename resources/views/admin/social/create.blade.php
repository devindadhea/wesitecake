@extends('layouts.app')

@section('title', 'Add Social Media - BakeryChrips')

@section('content')
<div class="pt-24 pb-12 max-w-3xl mx-auto px-4 md:px-6">
    <div class="flex items-center mb-8">
        <a href="{{ route('admin.social.index') }}" class="text-[#C2185B] hover:underline mr-4">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <h1 class="text-3xl font-bold text-[#C2185B]">Add Social Media</h1>
    </div>

    <form action="{{ route('admin.social.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Platform</label>
            <input type="text" name="platform" required placeholder="Instagram, Facebook, etc"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Icon (Bootstrap Icon class)</label>
            <input type="text" name="icon" required placeholder="bi-instagram, bi-facebook, etc"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">URL</label>
            <input type="url" name="url" required placeholder="https://instagram.com/bakerychrips"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Order</label>
            <input type="number" name="order" value="0" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
        </div>

        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" checked class="rounded text-[#C2185B]">
                <span class="ml-2 text-gray-700">Active</span>
            </label>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-[#C2185B] text-white rounded-full hover:bg-[#F8BBD9] transition">
                Create Social Media
            </button>
        </div>
    </form>
</div>
@endsection