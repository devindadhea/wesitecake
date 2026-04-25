@extends('layouts.app')

@section('title', 'Edit Footer Section - BakeryChrips')

@section('content')
<div class="pt-24 pb-12 max-w-3xl mx-auto px-4 md:px-6">
    <div class="flex items-center mb-8">
        <a href="{{ route('admin.cms.index') }}" class="text-[#C2185B] hover:underline mr-4">
            <i class="bi bi-arrow-left"></i> Back to CMS
        </a>
        <h1 class="text-3xl font-bold text-[#C2185B]">Edit Footer Section</h1>
    </div>

    <form action="{{ route('admin.cms.footer.update') }}" method="POST" class="bg-white rounded-lg shadow p-6 mb-6">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea name="description" rows="2" required 
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">{{ $footer->description ?? 'Roti fresh setiap hari, dibuat dari bahan berkualitas dan rasa terbaik untuk keluarga.' }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Address</label>
            <input type="text" name="address" value="{{ $footer->address ?? 'Bandung' }}" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
            <input type="text" name="phone" value="{{ $footer->phone ?? '+62 812 3456 7890' }}" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" value="{{ $footer->email ?? 'bakerychrips@gmail.com' }}" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Copyright</label>
            <input type="text" name="copyright" value="{{ $footer->copyright ?? '© 2025 BakeryChrips. All Rights Reserved.' }}" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-[#C2185B] text-white rounded-full hover:bg-[#F8BBD9] transition">
                Update Footer Section
            </button>
        </div>
    </form>

    <!-- Social Media List -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-[#C2185B]">Social Media</h2>
            <a href="{{ route('admin.social.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 transition text-sm">
                + Add Social Media
            </a>
        </div>

        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-2">Platform</th>
                    <th class="text-left">Icon</th>
                    <th class="text-left">URL</th>
                    <th class="text-left">Order</th>
                    <th class="text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($socials as $social)
                <tr class="border-b">
                    <td class="py-2">{{ $social->platform }}</td>
                    <td><i class="bi {{ $social->icon }}"></i> {{ $social->icon }}</td>
                    <td class="truncate max-w-xs">{{ $social->url }}</td>
                    <td>{{ $social->order }}</td>
                    <td>
                        <a href="{{ route('admin.social.edit', $social) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                        <form action="{{ route('admin.social.destroy', $social) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">No social media found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection