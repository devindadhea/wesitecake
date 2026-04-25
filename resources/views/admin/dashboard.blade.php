@extends('layouts.app')

@section('title', 'Admin Dashboard - BakeryChrips')

@section('content')
<div class="pt-24 pb-12 max-w-7xl mx-auto px-4 md:px-6">
    <h1 class="text-3xl font-bold text-[#C2185B] mb-8">Admin Dashboard</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Products</p>
                    <p class="text-3xl font-bold text-[#C2185B]">{{ $totalProducts ?? 0 }}</p>
                </div>
                <i class="bi bi-cake2 text-4xl text-[#F8BBD9]"></i>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Categories</p>
                    <p class="text-3xl font-bold text-[#C2185B]">{{ $totalCategories ?? 0 }}</p>
                </div>
                <i class="bi bi-tags text-4xl text-[#F8BBD9]"></i>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Users</p>
                    <p class="text-3xl font-bold text-[#C2185B]">{{ $totalUsers ?? 0 }}</p>
                </div>
                <i class="bi bi-people text-4xl text-[#F8BBD9]"></i>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <a href="{{ route('admin.cms.index') }}" class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition flex items-center space-x-3">
            <i class="bi bi-gear text-2xl text-[#C2185B]"></i>
            <span>CMS Settings</span>
        </a>
        <a href="{{ route('admin.categories.index') }}" class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition flex items-center space-x-3">
            <i class="bi bi-tags text-2xl text-[#C2185B]"></i>
            <span>Categories</span>
        </a>
        <a href="{{ route('admin.products.index') }}" class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition flex items-center space-x-3">
            <i class="bi bi-cake2 text-2xl text-[#C2185B]"></i>
            <span>Products</span>
        </a>
        <a href="{{ route('admin.features.index') }}" class="bg-white rounded-lg shadow p-4 hover:shadow-lg transition flex items-center space-x-3">
            <i class="bi bi-star text-2xl text-[#C2185B]"></i>
            <span>Features</span>
        </a>
    </div>

    <!-- Recent Products -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold text-[#C2185B] mb-4">Recent Products</h2>
        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-2">Name</th>
                    <th class="text-left">Category</th>
                    <th class="text-left">Price</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentProducts ?? [] as $product)
                <tr class="border-b">
                    <td class="py-2">{{ $product->name }}</td>
                    <td>{{ $product->category }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-gray-500">No products found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection