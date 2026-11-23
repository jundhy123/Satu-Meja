<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Satu Meja - Platform Berbagi Pangan Zero Hunger')</title>

    <!-- Google Fonts: Fraunces & Nunito Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400..800;1,9..144,400..800&family=Nunito+Sans:ital,opsz,wght@0,6..12,300..800;1,6..12,300..800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        forest: {
                            DEFAULT: '#2F4A33',
                            50: '#F3F6F4',
                            100: '#E4EBE5',
                            600: '#3D5E42',
                            700: '#2F4A33',
                            800: '#233927',
                            900: '#17271B',
                        },
                        sage: {
                            DEFAULT: '#759A6E',
                            100: '#EEF3EC',
                            200: '#D5E2D2',
                            500: '#759A6E',
                            600: '#5F8159',
                        },
                        olive: {
                            DEFAULT: '#8B9A6E',
                            100: '#F1F4EC',
                        },
                        khaki: {
                            DEFAULT: '#9A936E',
                            100: '#F4F3ED',
                        },
                        page: '#F3F5F0',
                    },
                    fontFamily: {
                        heading: ['Fraunces', 'serif'],
                        sans: ['Nunito Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Nunito Sans', sans-serif;
            background-color: #F3F5F0;
            color: #1f2937;
        }
        .font-heading {
            font-family: 'Fraunces', serif;
        }
    </style>
</head>
<body class="bg-page text-gray-900 min-h-screen flex flex-col antialiased">
    <!-- Navigation Header -->
    <header class="bg-forest text-white shadow-md sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand / Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 min-h-[44px] min-w-[44px] focus:outline-none focus:ring-2 focus:ring-sage rounded-lg px-2 py-1 transition">
                    <div class="w-10 h-10 rounded-xl bg-sage flex items-center justify-center text-forest font-bold text-xl shadow-inner">
                        <svg class="w-6 h-6 text-forest" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-heading text-2xl font-bold tracking-tight text-white leading-tight">Satu Meja</span>
                        <span class="text-[10px] uppercase tracking-widest text-sage font-semibold">Zero Hunger Platform</span>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-2">
                    <a href="{{ route('home') }}"
                       class="min-h-[44px] px-4 inline-flex items-center text-sm font-semibold text-white hover:text-sage-200 transition rounded-lg {{ request()->routeIs('home') ? 'bg-forest-800 text-white shadow-inner' : '' }}">
                        Beranda
                    </a>

                    <a href="{{ route('donations.index') }}"
                       class="min-h-[44px] px-4 inline-flex items-center text-sm font-semibold text-white hover:text-sage-200 transition rounded-lg {{ request()->routeIs('donations.*') ? 'bg-forest-800 text-white shadow-inner' : '' }}">
                        Cari Donasi
                    </a>

                    <a href="#tentang"
                       class="min-h-[44px] px-4 inline-flex items-center text-sm font-semibold text-white/80 hover:text-white transition rounded-lg">
                        Tentang Kami
                    </a>
                </div>

                <!-- Right Action / Auth Buttons -->
                <div class="hidden md:flex items-center space-x-3">
                    @auth
                        <div class="flex items-center gap-3 bg-forest-800/80 px-4 py-2 rounded-xl border border-sage/20">
                            <div class="flex flex-col text-right">
                                <span class="text-xs text-sage font-medium uppercase tracking-wider">
                                    {{ auth()->user()->role ?? 'Pengguna' }}
                                </span>
                                <span class="text-sm font-bold text-white leading-tight">
                                    {{ auth()->user()->name }}
                                </span>
                            </div>
                            <span class="w-8 h-8 rounded-full bg-sage/30 text-white flex items-center justify-center font-bold text-sm border border-sage/40">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                           class="min-h-[44px] px-5 inline-flex items-center justify-center text-sm font-bold text-forest bg-white hover:bg-sage-100 transition rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-white">
                            Masuk Portal
                        </a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" id="mobile-menu-btn"
                            class="min-h-[44px] min-w-[44px] inline-flex items-center justify-center p-2 rounded-xl text-sage hover:text-white hover:bg-forest-800 focus:outline-none focus:ring-2 focus:ring-sage"
                            aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Buka menu utama</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div class="hidden md:hidden pb-6 pt-2 border-t border-forest-800" id="mobile-menu">
                <div class="flex flex-col space-y-2">
                    <a href="{{ route('home') }}" class="min-h-[44px] px-4 py-2 rounded-lg text-base font-semibold text-white bg-forest-800">
                        Beranda
                    </a>
                    <a href="{{ route('donations.index') }}" class="min-h-[44px] px-4 py-2 rounded-lg text-base font-semibold text-white/90 hover:bg-forest-800">
                        Cari Donasi Pangan
                    </a>
                    <a href="#tentang" class="min-h-[44px] px-4 py-2 rounded-lg text-base font-semibold text-white/80 hover:bg-forest-800">
                        Tentang Satu Meja
                    </a>
                    <div class="pt-4 border-t border-forest-800 flex flex-col space-y-2">
                        @auth
                            <div class="px-4 py-2 text-white">
                                <span class="text-xs text-sage block uppercase">{{ auth()->user()->role ?? 'Pengguna' }}</span>
                                <span class="font-bold text-lg">{{ auth()->user()->name }}</span>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="min-h-[44px] w-full text-center px-4 py-3 font-bold text-forest bg-white rounded-xl">
                                Masuk Portal
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer Section -->
    <footer class="bg-forest text-white border-t border-forest-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <!-- Col 1: About -->
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-sage flex items-center justify-center text-forest font-bold text-xl">
                            <svg class="w-6 h-6 text-forest" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <span class="font-heading text-2xl font-bold text-white">Satu Meja</span>
                    </div>
                    <p class="text-sm text-sage-100 max-w-md leading-relaxed">
                        Platform Kolaborasi Pelaku Usaha dan Penerima Manfaat dalam Mewujudkan Pangan Cukup untuk Semua. Mengusung filosofi bahwa pemberi dan penerima duduk di meja yang sama sebagai mitra seimbang.
                    </p>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-forest-800 border border-sage/30 text-xs font-semibold text-sage-200">
                        <span>🌱 Subtema SEVENT X 2026: Zero Hunger (SDG 2)</span>
                    </div>
                </div>

                <!-- Col 2: Navigation -->
                <div>
                    <h3 class="font-heading text-lg font-bold text-white mb-4">Navigasi Utama</h3>
                    <ul class="space-y-2.5 text-sm text-sage-100">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ route('donations.index') }}" class="hover:text-white transition">Cari Donasi Pangan</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-white transition">Masuk Portal</a></li>
                        <li><a href="#cara-kerja" class="hover:text-white transition">Alur Cara Kerja</a></li>
                    </ul>
                </div>

                <!-- Col 3: Developer & Institution -->
                <div>
                    <h3 class="font-heading text-lg font-bold text-white mb-4">Pengembang</h3>
                    <p class="text-sm text-sage-100 font-semibold mb-2">Tim SEVENT X 2026:</p>
                    <ul class="space-y-1.5 text-xs text-sage-200 mb-4">
                        <li>• Jundhy NR Situmorang (42325002)</li>
                        <li>• Parlinggoman M. Sihombing (42325042)</li>
                        <li>• Ferdy Roberto Hutahean (42325024)</li>
                    </ul>
                    <p class="text-xs text-sage font-medium">Institut Teknologi Del, Toba</p>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-forest-800 text-center text-xs text-sage-200 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p>&copy; {{ date('Y') }} Satu Meja - Kolaborasi Pangan Layak Konsumsi. Seluruh Hak Cipta Dilindungi.</p>
                <p class="text-[11px] text-sage font-mono">Batas Layak & Kedaluwarsa Otomatis 15-Detik Active System</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        const btn = id => document.getElementById(id);
        const mobileBtn = btn('mobile-menu-btn');
        const mobileMenu = btn('mobile-menu');

        if (mobileBtn && mobileMenu) {
            mobileBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>
