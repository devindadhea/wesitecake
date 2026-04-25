<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Login Admin - BakeryChrips</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
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
    </style>
</head>
<body class="bg-gradient-to-br from-white to-[#FCE4EC] min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-pink-200/40">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-extrabold text-[#C2185B]">Bakery<span class="text-[#F8BBD9]">Chrips</span></h1>
                <p class="text-gray-600 mt-2">Login Admin</p>
            </div>

            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
                </div>

                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded text-[#C2185B]">
                        <span class="ml-2 text-gray-700 text-sm">Remember me</span>
                    </label>
                </div>

                <button type="submit" 
                        class="w-full bg-[#C2185B] text-white py-3 rounded-lg font-semibold hover:bg-[#F8BBD9] transition mb-4">
                    Login
                </button>

                <p class="text-center text-sm text-gray-600">
                    Demo: admin@bakerychrips.com / password
                </p>
            </form>
        </div>
    </div>
</body>
</html>