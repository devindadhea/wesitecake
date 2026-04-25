@extends('layouts.app')
@if($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('error'))
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
        {{ session('error') }}
    </div>
@endif
@section('title', 'Add Category - BakeryChrips')

@section('content')
<div class="pt-24 pb-12 max-w-3xl mx-auto px-4 md:px-6">
    <div class="flex items-center mb-8">
        <a href="{{ route('admin.categories.index') }}" class="text-[#C2185B] hover:underline mr-4">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <h1 class="text-3xl font-bold text-[#C2185B]">Add New Category</h1>
    </div>

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
            <input type="text" name="name" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Image</label>
            <input type="file" name="image" accept="image/*" required
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Max: 2MB</p>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea name="description" rows="3" 
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]"></textarea>
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
                Create Category
            </button>
        </div>
    </form>
</div>
@endsection