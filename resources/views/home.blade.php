@extends('layouts.app')

@section('title', 'Beranda - Satu Meja | Platform Berbagi Pangan Zero Hunger')

@section('content')
<!-- ================================================================= -->
<!-- HERO SECTION WITH CLEAN FULL VIDEO BACKGROUND                     -->
<!-- ================================================================= -->
<section class="relative w-full h-[88vh] flex flex-col justify-between overflow-hidden bg-black text-white">
    <!-- Clean Video Background (Natural Crisp Colors, Asset URL) -->
    <div class="absolute inset-0 z-0 bg-black">
        <video id="hero-bg-video" class="w-full h-full object-cover transition-opacity duration-700" autoplay muted playsinline preload="auto">
            <source src="{{ asset('animation/Diverse_people_eating_at_table_8cca1276.mp4') }}" type="video/mp4">
            Browser Anda tidak mendukung pemutaran video.
        </video>
        <!-- Soft subtle top/bottom gradient overlay for text readability -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-transparent to-black/40 pointer-events-none"></div>
    </div>

    <!-- Sub-Header Bar (Minimalist: Subtheme Badge Left & Days Counter Right) -->
    <div class="relative z-10 max-w-7xl mx-auto w-full px-6 pt-24 flex items-center justify-between pointer-events-none">
        <!-- Brand Subtheme Badge -->
        <div class="pointer-events-auto flex items-center gap-2 bg-black/60 backdrop-blur-md px-4 py-2 rounded-full border border-white/20 text-xs font-bold text-white shadow-xl">
            <span>🌱 Subtema Zero Hunger (SDG 2)</span>
        </div>

        <!-- Days Counter Pill -->
        <div id="hm-days-counter" class="pointer-events-auto flex items-center gap-2 text-xs font-semibold text-white bg-black/60 backdrop-blur-md px-4 py-2 rounded-full border border-white/20 shadow-xl">
            <span class="w-2.5 h-2.5 rounded-full bg-tosca animate-ping"></span>
            <span id="days-until-monday">Calculating days...</span>
        </div>
    </div>


    <!-- Dynamic Hover Curved Wave Sidebar Trigger (Floating Icon Default -> Wave on Hover) -->
    <div id="hm-curved-tab" class="fixed right-0 top-1/2 -translate-y-1/2 z-40 h-[65vh] w-28 flex items-center justify-end pointer-events-auto group cursor-pointer">
        <!-- SVG Curved Background Wave (Smoothly expands on hover) -->
        <svg id="hm-tab-svg" class="absolute right-0 top-0 h-full w-28 text-forest drop-shadow-2xl transition-all duration-500 ease-out opacity-0 group-hover:opacity-100 transform origin-right scale-x-75 group-hover:scale-x-100"
             viewBox="0 0 100 600" preserveAspectRatio="none" aria-label="Open menu" role="button" tabindex="0">
            <path id="hm-tab-path" class="transition-all duration-500" fill="currentColor"
                  d="M 100 0 C 100 150, 100 200, 100 300 C 100 400, 100 450, 100 600 L 100 0 Z" />
        </svg>

        <!-- Floating Circular Icon Button (Always Visible) -->
        <button id="hm-menu-btn" type="button"
                class="relative z-50 mr-4 w-12 h-12 rounded-full bg-forest text-white shadow-2xl flex items-center justify-center border border-white/20 group-hover:scale-110 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-tosca"
                aria-label="Open menu" aria-expanded="false">
            <svg id="hm-hamburger-icon" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 8h16M4 16h16"></path>
            </svg>
            <svg id="hm-close-icon" class="w-6 h-6 hidden transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>


    <!-- Fullscreen Menu Overlay (Replaces 100% Screen Seamlessly, Uniform Solid Forest Green) -->
    <div id="hm-menu-overlay" class="fixed inset-0 z-50 bg-forest text-white flex flex-col justify-between p-8 sm:p-14 hidden opacity-0 transition-opacity duration-300 pointer-events-auto">
        <!-- Top Overlay Header -->
        <div class="max-w-7xl mx-auto w-full flex items-center justify-between border-b border-white/10 pb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-sage flex items-center justify-center text-forest font-bold text-xl shadow-inner">
                    🌱
                </div>
                <div class="flex flex-col">
                    <span class="font-heading text-2xl font-bold tracking-tight text-white leading-tight">Satu Meja</span>
                    <span class="text-[10px] uppercase tracking-widest text-tosca font-bold">Zero Hunger Platform</span>
                </div>
            </div>

            <!-- Close Button -->
            <button type="button" id="hm-close-overlay-btn" class="w-12 h-12 rounded-full bg-forest-800 text-white flex items-center justify-center border border-white/20 hover:bg-forest-900 transition focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Center Menu Nav Links -->
        <div class="max-w-7xl mx-auto w-full my-auto py-8">
            <nav aria-label="Main Fullscreen Menu">
                <ul class="space-y-6">
                    <li class="hm-menu-item">
                        <a href="{{ route('home') }}" class="group inline-flex items-center text-3xl sm:text-5xl font-heading text-white hover:text-tosca transition-all duration-300">
                            <span class="opacity-0 group-hover:opacity-100 -ml-8 mr-3 font-mono text-tosca text-3xl transition-all duration-300">—</span>
                            <span class="transform group-hover:translate-x-3 transition-transform duration-300">Beranda</span>
                        </a>
                    </li>
                    <li class="hm-menu-item">
                        <a href="{{ route('donations.index') }}" class="group inline-flex items-center text-3xl sm:text-5xl font-heading text-white hover:text-tosca transition-all duration-300">
                            <span class="opacity-0 group-hover:opacity-100 -ml-8 mr-3 font-mono text-tosca text-3xl transition-all duration-300">—</span>
                            <span class="transform group-hover:translate-x-3 transition-transform duration-300">Cari Donasi Pangan</span>
                        </a>
                    </li>

                    @auth
                        <li class="hm-menu-item">
                            <a href="{{ route(auth()->user()->isAdmin() ? 'admin.dashboard' : (auth()->user()->isPendonasi() ? 'pendonasi.dashboard' : 'penerima.dashboard')) }}"
                               class="group inline-flex items-center text-3xl sm:text-5xl font-heading text-white hover:text-tosca transition-all duration-300">
                                <span class="opacity-0 group-hover:opacity-100 -ml-8 mr-3 font-mono text-tosca text-3xl transition-all duration-300">—</span>
                                <span class="transform group-hover:translate-x-3 transition-transform duration-300">
                                    Dasbor {{ ucfirst(auth()->user()->role) }}
                                </span>
                            </a>
                        </li>

                        @if(auth()->user()->isPendonasi() && auth()->user()->status === 'verified')
                            <li class="hm-menu-item">
                                <a href="{{ route('pendonasi.donations.create') }}" class="group inline-flex items-center text-2xl sm:text-4xl font-heading text-tosca hover:text-white transition-all duration-300">
                                    <span class="opacity-0 group-hover:opacity-100 -ml-8 mr-3 font-mono text-white text-3xl transition-all duration-300">—</span>
                                    <span class="transform group-hover:translate-x-3 transition-transform duration-300">+ Bagikan Pangan Berlebih</span>
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="hm-menu-item">
                            <a href="{{ route('login') }}" class="group inline-flex items-center text-3xl sm:text-5xl font-heading text-white hover:text-tosca transition-all duration-300">
                                <span class="opacity-0 group-hover:opacity-100 -ml-8 mr-3 font-mono text-tosca text-3xl transition-all duration-300">—</span>
                                <span class="transform group-hover:translate-x-3 transition-transform duration-300">Masuk Portal Pengguna</span>
                            </a>
                        </li>
                    @endauth

                    <li class="hm-menu-item">
                        <a href="#tentang" onclick="closeHmMenu()" class="group inline-flex items-center text-2xl sm:text-4xl font-heading text-sage-200 hover:text-white transition-all duration-300">
                            <span class="opacity-0 group-hover:opacity-100 -ml-8 mr-3 font-mono text-tosca text-2xl transition-all duration-300">—</span>
                            <span class="transform group-hover:translate-x-3 transition-transform duration-300">Filosofi Satu Meja</span>
                        </a>
                    </li>
                    <li class="hm-menu-item">
                        <a href="#cara-kerja" onclick="closeHmMenu()" class="group inline-flex items-center text-2xl sm:text-4xl font-heading text-sage-200 hover:text-white transition-all duration-300">
                            <span class="opacity-0 group-hover:opacity-100 -ml-8 mr-3 font-mono text-tosca text-2xl transition-all duration-300">—</span>
                            <span class="transform group-hover:translate-x-3 transition-transform duration-300">Alur Cara Kerja</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Bottom Footer Info -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <p>&copy; {{ date('Y') }} Satu Meja - Kolaborasi Pangan Layak Konsumsi</p>
        </div>
    </div>
</section>


<!-- ================================================================= -->
<!-- SECTION 2: FILOSOFI & MENGAPA SATU MEJA                           -->
<!-- ================================================================= -->
<section id="tentang" class="py-20 bg-white border-y border-sage/15">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-sage">Gagasan & Filosofi</span>
            <h2 class="font-heading text-3xl sm:text-4xl font-bold text-forest">
                Mengapa Memilih Satu Meja?
            </h2>
            <p class="text-base text-gray-600 leading-relaxed">
                Di Indonesia, timbulan <span class="font-semibold text-forest">Food Loss and Waste (FLW)</span> mencapai 23-48 juta ton per tahun, sementara prevalensi ketidakcukupan konsumsi pangan masih 7,89%. Satu Meja hadir menjembatani kesenjangan ini.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Pillar 1 -->
            <div class="bg-page rounded-3xl p-8 border border-sage/20 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="space-y-4">
                    <div class="w-14 h-14 rounded-2xl bg-forest text-white flex items-center justify-center text-2xl shadow-md">
                        🤝
                    </div>
                    <h3 class="font-heading text-xl font-bold text-forest">Kemitraan Setara</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Pendonasi dan Penerima berada di meja yang sama sebagai mitra seimbang. Menghapus stigma "pemberi dan peminta", memperkuat kolaborasi sosial yang bermartabat.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-sage/20 flex items-center gap-2 text-xs font-semibold text-forest">
                    <span>SDG 2: Zero Hunger</span>
                </div>
            </div>

            <!-- Pillar 2 -->
            <div class="bg-page rounded-3xl p-8 border border-sage/20 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="space-y-4">
                    <div class="w-14 h-14 rounded-2xl bg-sage text-forest flex items-center justify-center text-2xl shadow-md">
                        ⏱️
                    </div>
                    <h3 class="font-heading text-xl font-bold text-forest">Kedaluwarsa Otomatis</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Sistem mengevaluasi batas waktu layak konsumsi secara real-time setiap 15 detik. Pangan yang telah lewat waktu otomatis disembunyikan agar kualitas dan keamanan terjamin.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-sage/20 flex items-center gap-2 text-xs font-semibold text-forest">
                    <span>Keamanan Pangan Terjaga</span>
                </div>
            </div>

            <!-- Pillar 3 -->
            <div class="bg-page rounded-3xl p-8 border border-sage/20 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                <div class="space-y-4">
                    <div class="w-14 h-14 rounded-2xl bg-khaki text-forest flex items-center justify-center text-2xl shadow-md">
                        🛡️
                    </div>
                    <h3 class="font-heading text-xl font-bold text-forest">100% Terverifikasi</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Setiap akun pelaku usaha dan lembaga sosial diverifikasi langsung oleh Admin sebelum dapat melakukan aktivitas posting atau klaim. Menjamin keamanan dua arah.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-sage/20 flex items-center gap-2 text-xs font-semibold text-forest">
                    <span>Moderasi Admin Terpusat</span>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ================================================================= -->
<!-- SECTION 3: CARA KERJA SYSTEM (HOW IT WORKS)                      -->
<!-- ================================================================= -->
<section id="cara-kerja" class="py-20 bg-page">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-sage">Alur Penyelesaian</span>
            <h2 class="font-heading text-3xl sm:text-4xl font-bold text-forest">
                Cara Kerja Platform Satu Meja
            </h2>
            <p class="text-base text-gray-600">
                Empat langkah cepat mempertemukan makanan berlebih dengan lembaga penyalur sebelum melewati batas layak konsumsi.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Step 1 -->
            <div class="bg-white rounded-3xl p-6 border border-gray-200 shadow-sm relative">
                <span class="w-10 h-10 rounded-xl bg-forest text-white font-bold flex items-center justify-center font-heading mb-4">
                    01
                </span>
                <h3 class="font-heading text-lg font-bold text-forest mb-2">Registrasi & Verifikasi</h3>
                <p class="text-xs text-gray-600 leading-relaxed">
                    Pengguna mendaftar sebagai Pendonasi atau Penerima. Admin memeriksa identitas dan memverifikasi akun.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="bg-white rounded-3xl p-6 border border-gray-200 shadow-sm relative">
                <span class="w-10 h-10 rounded-xl bg-forest text-white font-bold flex items-center justify-center font-heading mb-4">
                    02
                </span>
                <h3 class="font-heading text-lg font-bold text-forest mb-2">Bagikan Pangan</h3>
                <p class="text-xs text-gray-600 leading-relaxed">
                    Pendonasi menerbitkan donasi (porsi, lokasi, batas waktu layak). Sistem menetapkan status Segera Kedaluwarsa/Tersedia.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="bg-white rounded-3xl p-6 border border-gray-200 shadow-sm relative">
                <span class="w-10 h-10 rounded-xl bg-forest text-white font-bold flex items-center justify-center font-heading mb-4">
                    03
                </span>
                <h3 class="font-heading text-lg font-bold text-forest mb-2">Cari & Klaim Donasi</h3>
                <p class="text-xs text-gray-600 leading-relaxed">
                    Penerima terverifikasi memfilter pangan aktif dan mengklaim. Klaim ganda dicek dan dicegah oleh sistem.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="bg-white rounded-3xl p-6 border border-gray-200 shadow-sm relative">
                <span class="w-10 h-10 rounded-xl bg-forest text-white font-bold flex items-center justify-center font-heading mb-4">
                    04
                </span>
                <h3 class="font-heading text-lg font-bold text-forest mb-2">Serah Terima & Apresiasi</h3>
                <p class="text-xs text-gray-600 leading-relaxed">
                    Pengambilan fisik dilakukan, data pengklaim tampil di dasbor, dan Penerima dapat mengirim ucapan terima kasih.
                </p>
            </div>
        </div>
    </div>
</section>


<!-- ================================================================= -->
<!-- SECTION 4: FEED DONASI AKTIF / KEADAAN KOSONG (EMPTY STATE)      -->
<!-- ================================================================= -->
<section class="py-20 bg-white border-t border-sage/15">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-sage">Pangan Aktif Tersedia</span>
                <h2 class="font-heading text-3xl font-bold text-forest">Donasi Pangan Terbaru</h2>
            </div>
            <a href="{{ route('donations.index') }}"
               class="min-h-[44px] px-5 inline-flex items-center text-sm font-bold text-forest hover:text-forest-800 underline underline-offset-4">
                Lihat Seluruh Daftar Donasi →
            </a>
        </div>

        @if(isset($latestDonations) && $latestDonations->count() > 0)
            <!-- Grid Donasi Aktif -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($latestDonations as $donation)
                    <div class="bg-page rounded-3xl p-6 border border-sage/20 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-sage-100 text-forest border border-sage/30">
                                    {{ $donation->food_type ?? 'Pangan Berlebih' }}
                                </span>
                                @if(\Carbon\Carbon::parse($donation->deadline)->diffInHours(now()) <= 48)
                                    <span class="px-2.5 py-0.5 rounded text-[11px] font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                        Segera Kedaluwarsa
                                    </span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded text-[11px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                        Tersedia
                                    </span>
                                @endif
                            </div>

                            <h3 class="font-heading text-lg font-bold text-gray-900 leading-snug">
                                {{ $donation->title }}
                            </h3>

                            <p class="text-xs text-gray-600 line-clamp-2">
                                {{ $donation->description ?? 'Tidak ada deskripsi tambahan.' }}
                            </p>

                            <div class="space-y-1.5 pt-2 border-t border-sage/20 text-xs text-gray-700">
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-gray-500">Jumlah Porsi:</span>
                                    <span class="font-bold text-forest">{{ $donation->quantity ?? '-' }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-gray-500">Lokasi:</span>
                                    <span class="font-medium text-gray-800">{{ $donation->location }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-gray-500">Batas Waktu:</span>
                                    <span class="font-mono text-forest font-bold">
                                        {{ \Carbon\Carbon::parse($donation->deadline)->format('d M Y H:i') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-5 mt-4 border-t border-sage/20">
                            <a href="{{ route('donations.index') }}"
                               class="w-full min-h-[44px] px-4 py-2.5 inline-flex items-center justify-center text-xs font-bold text-white bg-forest hover:bg-forest-800 rounded-xl transition">
                                Detail & Klaim Donasi
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Keadaan Kosong (Empty State) -->
            <div class="bg-page rounded-3xl p-10 sm:p-16 border border-dashed border-sage/40 text-center max-w-3xl mx-auto space-y-5">
                <div class="w-16 h-16 rounded-3xl bg-forest-50 text-forest flex items-center justify-center text-3xl mx-auto shadow-inner">
                    🌾
                </div>
                <div class="space-y-2">
                    <h3 class="font-heading text-2xl font-bold text-forest">
                        Belum Ada Donasi Pangan Aktif Saat Ini
                    </h3>
                    <p class="text-sm text-gray-600 max-w-lg mx-auto">
                        Donasi makanan berlebih baru saja tersalurkan atau belum ada entri aktif. Pelaku usaha pangan terverifikasi dapat mempublikasikan makanan layak konsumsi sekarang.
                    </p>
                </div>
                <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('donations.index') }}"
                       class="min-h-[44px] px-6 py-2.5 inline-flex items-center justify-center bg-forest hover:bg-forest-800 text-white font-bold rounded-xl text-sm transition">
                        Buka Halaman Cari Donasi
                    </a>
                    @guest
                        <a href="{{ route('login') }}"
                           class="min-h-[44px] px-6 py-2.5 inline-flex items-center justify-center bg-white border border-sage/40 text-forest font-bold rounded-xl text-sm hover:bg-sage-100 transition">
                            Masuk untuk Berbagi Pangan
                        </a>
                    @endguest
                </div>
            </div>
        @endif
    </div>
</section>


<!-- ================================================================= -->
<!-- JAVASCRIPT FOR VIDEO CONTROLS & DYNAMIC HOVER WAVE               -->
<!-- ================================================================= -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // 1. Video End Listener & Play Trigger
        const bgVideo = document.getElementById('hero-bg-video');
        if (bgVideo) {
            bgVideo.play().catch(err => console.log('Autoplay handled:', err));
            bgVideo.addEventListener('ended', () => {
                bgVideo.pause(); // Hold cleanly on final frame ("Satu Meja")
            });
        }

        // 2. Days Until Monday Calculator
        function calcDaysUntilMonday() {
            const today = new Date();
            const day = today.getDay(); // 0: Sun, 1: Mon, ...
            const daysLeft = (8 - day) % 7;
            const text = daysLeft === 0 ? "Today is Monday!" : `${daysLeft} days until Monday`;
            const el = document.getElementById('days-until-monday');
            if (el) el.textContent = text;
        }
        calcDaysUntilMonday();


        // 3. Dynamic Smooth Wave Morphing on Hover (GSAP Morph)
        const curvedTabContainer = document.getElementById('hm-curved-tab');
        const tabPath = document.getElementById('hm-tab-path');

        const flatPath = "M 100 0 C 100 150, 100 200, 100 300 C 100 400, 100 450, 100 600 L 100 0 Z";
        const wavePath = "M 100 0 C 100 150, 15 200, 15 300 C 15 400, 100 450, 100 600 L 100 0 Z";

        if (curvedTabContainer && tabPath) {
            curvedTabContainer.addEventListener('mouseenter', () => {
                if (typeof gsap !== 'undefined') {
                    gsap.to(tabPath, {
                        attr: { d: wavePath },
                        duration: 0.6,
                        ease: "power3.out"
                    });
                }
            });

            curvedTabContainer.addEventListener('mouseleave', () => {
                if (!isHmMenuOpen && typeof gsap !== 'undefined') {
                    gsap.to(tabPath, {
                        attr: { d: flatPath },
                        duration: 0.5,
                        ease: "power2.inOut"
                    });
                }
            });
        }


        // 4. Seamless Fullscreen Overlay Menu Logic
        let isHmMenuOpen = false;
        const menuBtn = document.getElementById('hm-menu-btn');
        const hamburgerIcon = document.getElementById('hm-hamburger-icon');
        const closeIcon = document.getElementById('hm-close-icon');
        const closeOverlayBtn = document.getElementById('hm-close-overlay-btn');
        const overlay = document.getElementById('hm-menu-overlay');

        window.openHmMenu = function() {
            if (!overlay) return;
            isHmMenuOpen = true;
            if (menuBtn) menuBtn.setAttribute('aria-expanded', 'true');
            overlay.classList.remove('hidden');

            requestAnimationFrame(() => {
                overlay.classList.remove('opacity-0');
            });

            if (hamburgerIcon) hamburgerIcon.classList.add('hidden');
            if (closeIcon) closeIcon.classList.remove('hidden');
        };

        window.closeHmMenu = function() {
            if (!overlay) return;
            isHmMenuOpen = false;
            if (menuBtn) menuBtn.setAttribute('aria-expanded', 'false');

            overlay.classList.add('opacity-0');
            setTimeout(() => {
                overlay.classList.add('hidden');
            }, 300);

            if (closeIcon) closeIcon.classList.add('hidden');
            if (hamburgerIcon) hamburgerIcon.classList.remove('hidden');

            if (typeof gsap !== 'undefined' && tabPath) {
                gsap.to(tabPath, {
                    attr: { d: flatPath },
                    duration: 0.4,
                    ease: "power2.inOut"
                });
            }
        };

        if (curvedTabContainer) {
            curvedTabContainer.addEventListener('click', () => {
                if (!isHmMenuOpen) openHmMenu(); else closeHmMenu();
            });
        }

        if (closeOverlayBtn) {
            closeOverlayBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                closeHmMenu();
            });
        }

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && isHmMenuOpen) {
                closeHmMenu();
            }
        });
    });
</script>
@endsection
