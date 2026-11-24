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
                        tosca: '#1FD1A5',
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

    <!-- GSAP for Smooth Morphing & Stagger Animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

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
    <!-- Transparent Header Bar (Logo Left, Auth Right) -->
    <header class="absolute top-0 left-0 w-full text-white z-50 bg-transparent">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand / Logo Left -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 min-h-[44px] min-w-[44px] focus:outline-none rounded-lg px-2 py-1 transition group">
                    <div class="w-10 h-10 rounded-xl bg-forest/80 backdrop-blur-md text-white flex items-center justify-center font-bold text-xl border border-white/20 shadow-lg group-hover:bg-forest transition">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-heading text-2xl font-bold tracking-tight text-white leading-tight drop-shadow-md">Satu Meja</span>
                        <span class="text-[10px] uppercase tracking-widest text-emerald-200 font-bold drop-shadow">Zero Hunger Platform</span>
                    </div>
                </a>

                <!-- Right Auth Action Button -->
                <div class="flex items-center space-x-3">
                    @auth
                        <div class="flex items-center gap-3 bg-black/50 backdrop-blur-md px-3.5 py-1.5 rounded-xl border border-white/20 shadow-lg">
                            <div class="flex flex-col text-right">
                                <span class="text-[10px] text-tosca font-semibold uppercase tracking-wider">
                                    {{ auth()->user()->role ?? 'Pengguna' }} ({{ auth()->user()->status }})
                                </span>
                                <span class="text-xs font-bold text-white leading-tight">
                                    {{ auth()->user()->institution_name ?? auth()->user()->name }}
                                </span>
                            </div>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" title="Keluar Akun"
                                        class="min-h-[36px] px-3 py-1 inline-flex items-center text-xs font-bold text-white bg-red-600/90 hover:bg-red-700 rounded-lg transition shadow">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                           class="min-h-[44px] px-5 inline-flex items-center justify-center text-sm font-bold text-forest bg-white hover:bg-sage-100 transition rounded-xl shadow-lg focus:outline-none">
                            Masuk Portal
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Custom Animated Confirmation Modal -->
    <div id="confirm-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm hidden transition-opacity duration-300 opacity-0">
        <div id="confirm-modal-card" class="bg-white rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl border border-sage/30 transform scale-95 opacity-0 transition-all duration-300 space-y-5 text-center">
            <!-- Animated Icon Badge -->
            <div id="confirm-modal-icon" class="w-16 h-16 rounded-2xl bg-forest-50 text-forest flex items-center justify-center text-3xl mx-auto shadow-inner border border-sage/20 animate-bounce">
                🤝
            </div>

            <!-- Content -->
            <div class="space-y-2">
                <h3 id="confirm-modal-title" class="font-heading text-2xl font-bold text-forest">
                    Konfirmasi Tindakan
                </h3>
                <p id="confirm-modal-message" class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                    Apakah Anda yakin ingin melanjutkan tindakan ini?
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="pt-2 flex items-center gap-3">
                <button type="button" id="confirm-modal-cancel"
                        class="flex-1 min-h-[44px] px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-bold text-xs hover:bg-gray-100 transition focus:outline-none">
                    Batal
                </button>
                <button type="button" id="confirm-modal-submit"
                        class="flex-1 min-h-[44px] px-5 py-2.5 rounded-xl bg-forest hover:bg-forest-800 text-white font-bold text-xs shadow-md transition focus:outline-none">
                    Ya, Lanjutkan
                </button>
            </div>
        </div>
    </div>

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

    <!-- Global JavaScript Modal -->
    <script>
        // Animated Custom Confirmation Modal System
        window.showConfirmModal = function({
            title = 'Konfirmasi Tindakan',
            message = 'Apakah Anda yakin ingin melanjutkan?',
            icon = '🤝',
            confirmText = 'Ya, Lanjutkan',
            cancelText = 'Batal',
            confirmBtnClass = 'bg-forest hover:bg-forest-800 text-white',
            onConfirm = () => {}
        }) {
            const modal = document.getElementById('confirm-modal');
            const card = document.getElementById('confirm-modal-card');
            const titleEl = document.getElementById('confirm-modal-title');
            const msgEl = document.getElementById('confirm-modal-message');
            const iconEl = document.getElementById('confirm-modal-icon');
            const cancelBtn = document.getElementById('confirm-modal-cancel');
            const submitBtn = document.getElementById('confirm-modal-submit');

            if (!modal || !card) return;

            titleEl.textContent = title;
            msgEl.textContent = message;
            iconEl.textContent = icon;
            cancelBtn.textContent = cancelText;
            submitBtn.textContent = confirmText;
            submitBtn.className = `flex-1 min-h-[44px] px-5 py-2.5 rounded-xl font-bold text-xs shadow-md transition focus:outline-none ${confirmBtnClass}`;

            // Reveal modal with smooth animation
            modal.classList.remove('hidden');
            requestAnimationFrame(() => {
                modal.classList.remove('opacity-0');
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            });

            const closeModal = () => {
                card.classList.remove('scale-100', 'opacity-100');
                card.classList.add('scale-95', 'opacity-0');
                modal.classList.add('opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            };

            cancelBtn.onclick = closeModal;
            submitBtn.onclick = () => {
                closeModal();
                onConfirm();
            };

            // Close on backdrop click or Escape key
            modal.onclick = (e) => {
                if (e.target === modal) closeModal();
            };

            const escHandler = (e) => {
                if (e.key === 'Escape') {
                    closeModal();
                    document.removeEventListener('keydown', escHandler);
                }
            };
            document.addEventListener('keydown', escHandler);
        };
    </script>
</body>
</html>
