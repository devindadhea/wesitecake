@extends('layouts.app')

@section('title', 'Social Media - BakeryChrips')

@section('content')
<div class="pt-24 pb-12 max-w-7xl mx-auto px-4 md:px-6">
    <div class="flex justify-between items-center mb-8">
        <div class="flex items-center">
            <a href="{{ route('admin.cms.footer') }}" class="text-[#C2185B] hover:underline mr-4">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h1 class="text-3xl font-bold text-[#C2185B]">Social Media</h1>
        </div>
        <a href="{{ route('admin.social.create') }}" class="px-6 py-2 bg-[#C2185B] text-white rounded-full hover:bg-[#F8BBD9] transition">
            + Add Social Media
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Platform</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Icon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">URL</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($socials as $social)
                <tr>
                    <td class="px-6 py-4">{{ $social->platform }}</td>
                    <td class="px-6 py-4"><i class="bi {{ $social->icon }}"></i> {{ $social->icon }}</td>
                    <td class="px-6 py-4">{{ $social->url }}</td>
                    <td class="px-6 py-4">{{ $social->order }}</td>
                    <td class="px-6 py-4">
                        @if($social->is_active)
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Active</span>
                        @else
                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Inactive</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.social.edit', $social) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                        <form action="{{ route('admin.social.destroy', $social) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No social media found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection