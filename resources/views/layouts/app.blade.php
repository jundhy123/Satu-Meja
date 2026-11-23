<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Satu Meja')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen flex flex-col">
    <header class="bg-emerald-900 text-white shadow">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="/" class="text-xl font-bold min-h-[44px] inline-flex items-center">Satu Meja</a>
            <div class="flex items-center gap-3">
                <a href="{{ route('donations.index') }}" class="min-h-[44px] px-3 inline-flex items-center hover:underline">Cari Donasi</a>
                @auth
                    <span class="text-sm text-emerald-100">Halo, {{ auth()->user()->name }}</span>
                @else
                    <a href="{{ route('login') }}" class="min-h-[44px] px-4 inline-flex items-center bg-white text-emerald-900 font-semibold rounded-lg">Masuk</a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="flex-1">
        @yield('content')
    </main>
</body>
</html>