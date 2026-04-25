<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - BakeryChrips</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-white to-[#FCE4EC] min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-pink-200/40">
            <div class="text-center mb-8">
                <a href="{{ route('home') }}">
                    <h1 class="text-3xl font-extrabold text-[#C2185B]">Bakery<span class="text-[#F8BBD9]">Chrips</span></h1>
                </a>
                <p class="text-gray-600 mt-2">Reset Password</p>
            </div>

            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" value="{{ $email ?? old('email') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Password Baru</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-[#C2185B]">
                </div>

                <button type="submit" 
                        class="w-full bg-[#C2185B] text-white py-3 rounded-lg font-semibold hover:bg-[#F8BBD9] transition mb-4">
                    Reset Password
                </button>

                <p class="text-center text-sm text-gray-600">
                    <a href="{{ route('login') }}" class="text-[#C2185B] hover:underline">← Kembali ke Login</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>