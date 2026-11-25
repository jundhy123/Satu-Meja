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
    <!-- Header Bar (Logo Left, Auth Right) -->
    <header class="{{ request()->routeIs('home') ? 'absolute top-0 left-0 w-full text-white z-50 bg-transparent' : 'sticky top-0 w-full text-white z-50 bg-forest shadow-md border-b border-forest-800' }}">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand / Logo Left -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 min-h-[44px] min-w-[44px] focus:outline-none rounded-lg px-2 py-1 transition group">
                    <span class="font-heading text-2xl font-bold tracking-tight text-white leading-tight drop-shadow-md">Satu Meja</span>
                </a>

                <!-- Right Auth Action Button -->
                <div class="flex items-center space-x-3">
                    @auth
                        <div class="relative group">
                            <!-- Minimalist Main Pill (User Name & Logout Button ">") -->
                            <div class="flex items-center gap-3 bg-forest-900/85 backdrop-blur-md px-4 py-2 rounded-2xl border border-white/20 shadow-xl cursor-pointer hover:border-tosca/50 transition-all duration-300">
                                <span class="text-xs font-bold text-white tracking-tight max-w-[160px] sm:max-w-[200px] truncate leading-tight">
                                    {{ auth()->user()->institution_name ?? auth()->user()->name }}
                                </span>

                                <form action="{{ route('logout') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" title="Keluar Akun"
                                            class="w-7 h-7 rounded-xl bg-red-600 hover:bg-red-500 text-white font-extrabold text-sm flex items-center justify-center transition-all duration-200 shadow hover:scale-110 active:scale-95 focus:outline-none">
                                        &gt;
                                    </button>
                                </form>
                            </div>

                            <!-- Minimalist Hover Dropdown (Only Shows Role Status) -->
                            <div class="absolute right-0 top-full mt-2 bg-forest-900/95 backdrop-blur-xl border border-white/20 rounded-xl px-4 py-2.5 shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-1 group-hover:translate-y-0 z-50 whitespace-nowrap">
                                <span class="text-xs font-bold text-white flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-tosca shadow-[0_0_6px_#1FD1A5] animate-pulse"></span>
                                    <span>Status: {{ ucfirst(auth()->user()->role) }}</span>
                                </span>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                           class="min-h-[44px] px-6 py-2.5 inline-flex items-center justify-center text-xs font-bold text-forest bg-white hover:bg-sage-100 transition rounded-2xl shadow-lg border border-white/20 hover:scale-105 active:scale-95 focus:outline-none">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- Global Floating Sidebar & Overlay Menu -->
    @include('partials.sidebar')

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

    <!-- Footer Partial -->
    @include('partials.footer')

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
