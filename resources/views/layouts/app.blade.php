<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'BakeryChrips – Toko Roti Modern')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @stack('styles')
    <style>
        @keyframes float3d {
            0%   { transform: translate3d(0px, 0px, 0px) rotateX(0deg) rotateY(0deg); }
            25%  { transform: translate3d(8px, -12px, 18px) rotateX(6deg) rotateY(-6deg); }
            50%  { transform: translate3d(-10px, 4px, -12px) rotateX(-4deg) rotateY(6deg); }
            75%  { transform: translate3d(6px, -10px, 10px) rotateX(4deg) rotateY(-4deg); }
            100% { transform: translate3d(0px, 0px, 0px) rotateX(0deg) rotateY(0deg); }
        }
        .animate-3dfloat {
            animation: float3d 10s cubic-bezier(0.25, 0.1, 0.25, 1) infinite;
        }
        .animate-3dfloat2 {
            animation: float3d 12s cubic-bezier(0.25, 0.1, 0.25, 1) infinite;
        }
        @keyframes half-rotate-3d {
            0%   { transform: rotateY(-12deg) translateY(0px); }
            50%  { transform: rotateY(12deg) translateY(-4px); }
            100% { transform: rotateY(-12deg) translateY(0px); }
        }
        .animate-half-rotate-3d {
            animation: half-rotate-3d 5s ease-in-out infinite;
            transform-style: preserve-3d;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-white to-[#FCE4EC] text-gray-800">
    <!-- NAVBAR -->
    <nav class="fixed top-0 w-full z-50 bg-white/60 backdrop-blur-xl shadow-sm border-b border-pink-200/20">
        <div class="max-w-7xl mx-auto px-4 md:px-6 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('home') }}">
                <h1 class="text-2xl md:text-3xl font-extrabold text-[#C2185B] tracking-tight">Herlina<span class="text-[#F8BBD9]"> Cookies & Cakes</span></h1>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-10 text-[15px] font-medium">
                <a href="{{ route('home') }}#beranda" class="relative group">
                    <span class="group-hover:text-[#C2185B] transition">Beranda</span>
                    <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-[#C2185B] transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ route('home') }}#kategori" class="relative group">
                    <span class="group-hover:text-[#C2185B] transition">Kategori</span>
                    <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-[#C2185B] transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ route('home') }}#terlaris" class="relative group">
                    <span class="group-hover:text-[#C2185B] transition">Produk </span>
                    <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-[#C2185B] transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ route('home') }}#tentang" class="relative group">
                    <span class="group-hover:text-[#C2185B] transition">Tentang Toko</span>
                    <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-[#C2185B] transition-all duration-300 group-hover:w-full"></span>
                </a>

                <!-- Di bagian desktop menu, tambahkan setelah Tentang Toko -->
<a href="{{ route('home') }}#kontak" class="relative group">
    <span class="group-hover:text-[#C2185B] transition">Kontak</span>
    <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-[#C2185B] transition-all duration-300 group-hover:w-full"></span>
</a>
            </div>


        <!-- Mobile Dropdown Menu -->
        <div id="mobileMenu" class="hidden md:hidden flex-col bg-white shadow-lg border-t border-gray-200">
            <a href="{{ route('home') }}#beranda" onclick="toggleMenu()" class="py-3 px-6 border-b hover:bg-[#FCE4EC] hover:text-[#C2185B] transition">Beranda</a>
            <a href="{{ route('home') }}#kategori" onclick="toggleMenu()" class="py-3 px-6 border-b hover:bg-[#FCE4EC] hover:text-[#C2185B] transition">Kategori</a>
            <a href="{{ route('home') }}#terlaris" onclick="toggleMenu()" class="py-3 px-6 border-b hover:bg-[#FCE4EC] hover:text-[#C2185B] transition">Produk Terlaris</a>
            <a href="{{ route('home') }}#tentang" onclick="toggleMenu()" class="py-3 px-6 border-b hover:bg-[#FCE4EC] hover:text-[#C2185B] transition">Tentang Toko</a>
            <a href="{{ route('home') }}#kontak" onclick="toggleMenu()" class="py-3 px-6 border-b hover:bg-[#FCE4EC] hover:text-[#C2185B] transition">Kontak</a>
    <div class="p-4 flex flex-col space-y-2">
    @auth
        @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}" class="block text-center px-4 py-2 bg-[#C2185B] text-white rounded-full">Admin Panel</a>
            <a href="{{ route('admin.profile') }}" class="block text-center px-4 py-2 border border-[#C2185B] text-[#C2185B] rounded-full">Profil Saya</a>
        @endif
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full px-4 py-2 border border-[#C2185B] text-[#C2185B] rounded-full">Logout</button>
        </form>
    @else
        <a href="{{ route('login') }}" class="block text-center px-4 py-2 bg-[#C2185B] text-white rounded-full">Login</a>
    @endauth
</div>
    </nav>

    <script>
        function toggleMenu() {
            const menu = document.getElementById("mobileMenu");
            menu.classList.toggle("hidden");
        }
         document.addEventListener('DOMContentLoaded', function() {
        const profileBtn = document.getElementById('profileBtn');
        const profileDropdown = document.getElementById('profileDropdown');
        const chevronIcon = document.getElementById('chevronIcon');
        
        if (profileBtn && profileDropdown) {
            let timeoutId;
            
            function showDropdown() {
                clearTimeout(timeoutId);
                profileDropdown.classList.remove('opacity-0', 'invisible');
                profileDropdown.classList.add('opacity-100', 'visible');
                if (chevronIcon) chevronIcon.style.transform = 'rotate(180deg)';
            }
            
            function hideDropdown() {
                timeoutId = setTimeout(() => {
                    profileDropdown.classList.remove('opacity-100', 'visible');
                    profileDropdown.classList.add('opacity-0', 'invisible');
                    if (chevronIcon) chevronIcon.style.transform = 'rotate(0deg)';
                }, 100);
            }
            
            profileBtn.addEventListener('mouseenter', showDropdown);
            profileBtn.addEventListener('mouseleave', hideDropdown);
            profileDropdown.addEventListener('mouseenter', showDropdown);
            profileDropdown.addEventListener('mouseleave', hideDropdown);
        }
    });
    </script>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

  <!-- FOOTER -->
@php
    $footer = \App\Models\FooterSection::first();
    $socials = \App\Models\SocialMedia::where('is_active', true)->orderBy('order')->get();
@endphp
<footer class="bg-[#2B2D42] text-gray-300 pt-16 pb-8 mt-20">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-10">
        <!-- Brand -->
        <div>
            <h3 class="text-2xl font-extrabold text-white">Herlina <span class="text-[#F48FB1]"> Cookies & Cakes</span></h3>
            <p class="mt-4 text-gray-400">
                {{ $footer->description ?? 'Roti fresh setiap hari, dibuat dari bahan berkualitas dan rasa terbaik untuk keluarga.' }}
            </p>
        </div>

        <!-- Menu Navigasi + Login Admin -->
        <div>
            <h4 class="text-lg font-semibold text-white mb-4">Navigasi</h4>
            <ul class="space-y-3">
                <li><a href="{{ route('home') }}#beranda" class="hover:text-[#F48FB1]">Beranda</a></li>
                <li><a href="{{ route('home') }}#kategori" class="hover:text-[#F48FB1]">Kategori</a></li>
                <li><a href="{{ route('home') }}#terlaris" class="hover:text-[#F48FB1]">Produk</a></li>
                <li><a href="{{ route('home') }}#tentang" class="hover:text-[#F48FB1]">Tentang Toko</a></li>
                <li><a href="{{ route('home') }}#kontak" class="hover:text-[#F48FB1]">Kontak</a></li>
                
                <!-- Separator -->
                <li><hr class="border-gray-600 my-2"></li>
                
                <!-- Login / Admin Panel di Footer -->
                @auth
                    @if(auth()->user()->isAdmin())
                        <li><a href="{{ route('admin.dashboard') }}" class="text-[#F48FB1] hover:text-white transition font-semibold">Admin Panel</a></li>
                        <li><a href="{{ route('admin.profile') }}" class="hover:text-[#F48FB1]">Profil Saya</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="hover:text-[#F48FB1] transition">Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('profile') }}" class="hover:text-[#F48FB1]">Profil Saya</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="hover:text-[#F48FB1] transition">Logout</button>
                            </form>
                        </li>
                    @endif
                @else
                    <li><a href="{{ route('login') }}" class="text-[#F48FB1] hover:text-white transition font-semibold">Login Admin</a></li>
                @endauth
            </ul>
        </div>

        <!-- Kontak -->
        <div>
            <h4 class="text-lg font-semibold text-white mb-4">Kontak</h4>
            <ul class="space-y-3">
                <li class="flex items-center gap-3">
                    <i class="bi bi-geo-alt-fill text-[#F48FB1]"></i> 
                    {{ $footer->address ?? 'Bandung' }}
                </li>
                <li class="flex items-center gap-3">
                    <i class="bi bi-telephone-fill text-[#F48FB1]"></i> 
                    {{ $footer->phone ?? '+62 812 3456 7890' }}
                </li>
                <li class="flex items-center gap-3">
                    <i class="bi bi-envelope-fill text-[#F48FB1]"></i> 
                    {{ $footer->email ?? 'bakerychrips@gmail.com' }}
                </li>
            </ul>
        </div>

        <!-- Sosial Media -->
        <div>
            <h4 class="text-lg font-semibold text-white mb-4">Ikuti Kami</h4>
            <div class="flex items-center gap-4 text-2xl">
                @forelse($socials as $social)
                    <a href="{{ $social->url }}" target="_blank" class="hover:text-[#F48FB1]"><i class="bi {{ $social->icon }}"></i></a>
                @empty
                    <a href="#" class="hover:text-[#F48FB1]"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="hover:text-[#F48FB1]"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="hover:text-[#F48FB1]"><i class="bi bi-tiktok"></i></a>
                @endforelse
            </div>
        </div>
    </div>

    <p class="text-center text-gray-400 mt-12 border-t border-gray-700 pt-6 text-sm">
        {{ $footer->copyright ?? '© 2026 Herlina Cookies & Cake. All Rights Reserved.' }}
    </p>
</footer>
</body>
</html>