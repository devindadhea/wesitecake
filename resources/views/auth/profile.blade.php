@extends('layouts.app')

@section('title', 'Profil Saya - BakeryChrips')

@section('content')
<div class="pt-24 pb-12 max-w-3xl mx-auto px-4 md:px-6">
    <div class="flex items-center mb-8">
        <a href="{{ route('home') }}" class="text-[#C2185B] hover:underline mr-4">
            <i class="bi bi-arrow-left"></i> Back to Home
        </a>
        <h1 class="text-3xl font-bold text-[#C2185B]">Profil Saya</h1>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Form Ganti Email -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center gap-3 mb-4">
                <i class="bi bi-envelope text-2xl text-[#C2185B]"></i>
                <h2 class="text-xl font-bold text-[#C2185B]">Ganti Email</h2>
            </div>
            
            <form action="{{ route('profile.update-email') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email Saat Ini</label>
                    <input type="email" value="{{ auth()->user()->email }}" disabled
                           class="w-full px-3 py-2 border border-gray-200 rounded-lg bg-gray-100">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email Baru</label>
                    <input type="email" name="new_email" required placeholder="Masukkan email baru"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Email Baru</label>
                    <input type="email" name="new_email_confirmation" required placeholder="Konfirmasi email baru"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Password (Verifikasi)</label>
                    <input type="password" name="password" required placeholder="Masukkan password Anda"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
                </div>

                <button type="submit" 
                        class="w-full bg-[#C2185B] text-white py-2 rounded-full font-semibold hover:bg-[#E45C95] transition">
                    Update Email
                </button>
            </form>
        </div>

        <!-- Form Ganti Password -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center gap-3 mb-4">
                <i class="bi bi-key text-2xl text-[#C2185B]"></i>
                <h2 class="text-xl font-bold text-[#C2185B]">Ganti Password</h2>
            </div>
            
            <form action="{{ route('profile.update-password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Password Lama</label>
                    <input type="password" name="current_password" required placeholder="Masukkan password lama"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Password Baru</label>
                    <input type="password" name="new_password" required placeholder="Masukkan password baru (min 6 karakter)"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation" required placeholder="Konfirmasi password baru"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
                </div>

                <button type="submit" 
                        class="w-full bg-[#C2185B] text-white py-2 rounded-full font-semibold hover:bg-[#E45C95] transition">
                    Update Password
                </button>
            </form>
        </div>
    </div>

    <!-- Informasi Akun -->
    <div class="mt-6 bg-blue-50 rounded-lg p-4 border border-blue-200">
        <div class="flex items-center gap-2">
            <i class="bi bi-info-circle text-blue-600"></i>
            <span class="text-sm text-blue-800 font-semibold">Informasi Akun</span>
        </div>
        <div class="mt-2 text-sm text-blue-700">
            <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><strong>Role:</strong> 
                @if(auth()->user()->role == 'admin')
                    <span class="px-2 py-0.5 bg-purple-100 text-purple-800 rounded-full text-xs">Administrator</span>
                @else
                    <span class="px-2 py-0.5 bg-gray-100 text-gray-800 rounded-full text-xs">User</span>
                @endif
            </p>
            <p><strong>Terdaftar sejak:</strong> {{ auth()->user()->created_at->format('d F Y') }}</p>
        </div>
    </div>
</div>
@endsection