@extends('layouts.app')

@section('title', 'CMS Settings - BakeryChrips')

@section('content')
<div class="pt-24 pb-12 max-w-7xl mx-auto px-4 md:px-6">
    <div class="flex items-center mb-8">
        <a href="{{ route('admin.dashboard') }}" class="text-[#C2185B] hover:underline mr-4">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
        <h1 class="text-3xl font-bold text-[#C2185B]">Content Management System</h1>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Hero Section Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-[#C2185B]">Hero Section</h2>
                <i class="bi bi-house-heart text-2xl text-[#C2185B]"></i>
            </div>
            <p class="text-gray-600 mb-4">Kelola konten hero section (judul, subtitle, gambar, dll)</p>
            <div class="text-sm text-gray-500 mb-4">
                <div>Title: {{ $hero->title ?? 'Not set' }}</div>
                <div>Subtitle: {{ $hero->subtitle ?? 'Not set' }}</div>
            </div>
            <a href="{{ route('admin.cms.hero') }}" class="inline-block px-4 py-2 bg-[#C2185B] text-white rounded-full hover:bg-[#F8BBD9] transition">
                Edit Hero
            </a>
        </div>

        <!-- About Section Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-[#C2185B]">About Section</h2>
                <i class="bi bi-info-circle text-2xl text-[#C2185B]"></i>
            </div>
            <p class="text-gray-600 mb-4">Kelola konten about section (tentang toko, fitur, dll)</p>
            <div class="text-sm text-gray-500 mb-4">
                <div>Title: {{ $about->title ?? 'Not set' }}</div>
            </div>
            <a href="{{ route('admin.cms.about') }}" class="inline-block px-4 py-2 bg-[#C2185B] text-white rounded-full hover:bg-[#F8BBD9] transition">
                Edit About
            </a>
        </div>

        <!-- Contact Section Card -->
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-[#C2185B]">Contact & Location</h2>
        <i class="bi bi-telephone text-2xl text-[#C2185B]"></i>
    </div>
    <p class="text-gray-600 mb-4">Kelola kontak, WhatsApp, jam operasi, dan lokasi toko</p>
    <a href="{{ route('admin.contact.index') }}" class="inline-block px-4 py-2 bg-[#C2185B] text-white rounded-full hover:bg-[#F8BBD9] transition">
        Manage Contact
    </a>
</div>

        <!-- Footer Section Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-[#C2185B]">Footer Section</h2>
                <i class="bi bi-layout-text-window text-2xl text-[#C2185B]"></i>
            </div>
            <p class="text-gray-600 mb-4">Kelola konten footer (alamat, kontak, sosial media)</p>
            <div class="text-sm text-gray-500 mb-4">
                <div>Email: {{ $footer->email ?? 'Not set' }}</div>
            </div>
            <a href="{{ route('admin.cms.footer') }}" class="inline-block px-4 py-2 bg-[#C2185B] text-white rounded-full hover:bg-[#F8BBD9] transition">
                Edit Footer
            </a>
        </div>
    </div>
</div>
@endsection