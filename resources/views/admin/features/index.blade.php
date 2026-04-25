@extends('layouts.app')

@section('title', 'Features - BakeryChrips')

@section('content')
<div class="pt-24 pb-12 max-w-7xl mx-auto px-4 md:px-6">
    <div class="flex justify-between items-center mb-8">
        <div class="flex items-center">
            <a href="{{ route('admin.cms.about') }}" class="text-[#C2185B] hover:underline mr-4">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h1 class="text-3xl font-bold text-[#C2185B]">Features</h1>
        </div>
        <a href="{{ route('admin.features.create') }}" class="px-6 py-2 bg-[#C2185B] text-white rounded-full hover:bg-[#F8BBD9] transition">
            + Add Feature
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Icon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($features as $feature)
                <tr>
                    <td class="px-6 py-4">{{ $feature->title }}</td>
                    <td class="px-6 py-4"><i class="bi {{ $feature->icon }}"></i> {{ $feature->icon }}</td>
                    <td class="px-6 py-4">{{ $feature->order }}</td>
                    <td class="px-6 py-4">
                        @if($feature->is_active)
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Active</span>
                        @else
                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Inactive</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.features.edit', $feature) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                        <form action="{{ route('admin.features.destroy', $feature) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No features found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection