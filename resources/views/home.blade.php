@extends('layouts.app')

@section('title', 'Beranda - Satu Meja | Platform Berbagi Pangan Zero Hunger')

@section('content')
<style>
    html {
        scroll-behavior: smooth;
    }

    /* Tekstur pola titik organik untuk Section 2 */
    .bg-organic-cream {
        background-color: #F6F3EB;
        background-image: radial-gradient(rgba(30, 53, 33, 0.11) 1px, transparent 1px);
        background-size: 22px 22px;
    }

    /* Latar hijau hutan dalam untuk Section 3 */
    .bg-deep-forest {
        background: linear-gradient(145deg, #1B321E 0%, #244028 50%, #152818 100%);
    }

    /* Animasi cahaya melayang halus di latar belakang */
    @keyframes floatAmbient {
        0%, 100% { transform: translateY(0px) scale(1); }
        50% { transform: translateY(-18px) scale(1.05); }
    }
    .animate-ambient-1 {
        animation: floatAmbient 8s ease-in-out infinite;
    }
    .animate-ambient-2 {
        animation: floatAmbient 10s ease-in-out 2.5s infinite;
    }

    /* Animasi Scroll Reveal (Ringan & Tanpa Ketergantungan CDN) */
    .reveal-up {
        opacity: 0;
        transform: translateY(32px);
        transition: opacity 0.8s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.8s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .reveal-up.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    .reveal-zoom {
        opacity: 0;
        transform: scale(0.94) translateY(20px);
        transition: opacity 0.7s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .reveal-zoom.is-visible {
        opacity: 1;
        transform: scale(1) translateY(0);
    }

    /* Garis penghubung langkah 01 -> 04 yang menggambar otomatis saat terlihat */
    .step-line-draw {
        transform: scaleX(0);
        transform-origin: left center;
        transition: transform 1.3s cubic-bezier(0.22, 1, 0.36, 1) 0.25s;
    }
    .step-line-draw.is-visible {
        transform: scaleX(1);
    }

    /* Micro-interaction kartu filosofi */
    .pillar-card {
        transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1),
                    box-shadow 0.35s ease,
                    border-color 0.35s ease;
    }
    .pillar-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 22px 38px -12px rgba(27, 50, 30, 0.14);
    }
    .pillar-card .bottom-bar {
        width: 0%;
        transition: width 0.45s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .pillar-card:hover .bottom-bar {
        width: 100%;
    }
</style>

<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600;700&display=swap" rel="stylesheet">

<!-- ================================================================= -->
<!-- HERO SECTION WITH CLEAN FULL VIDEO BACKGROUND                     -->
<!-- ================================================================= -->
<section class="relative w-full h-screen flex flex-col justify-between overflow-hidden bg-black text-white">
    <!-- Clean Video Background -->
    <div class="absolute inset-0 z-0 bg-black">
        <video id="hero-bg-video" class="w-full h-full object-cover transition-opacity duration-700" autoplay muted playsinline preload="auto">
            <source src="{{ asset('animation/Diverse_people_eating_at_table_8cca1276.mp4') }}" type="video/mp4">
            Browser Anda tidak mendukung pemutaran video.
        </video>
        <!-- Gradient halus atas & bawah -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/30 pointer-events-none"></div>
    </div>

    <!-- Typewriter Text Tanpa Kotak Background (Menyatu Langsung dengan Video) -->
    <div class="relative z-10 mt-auto mb-24 sm:mb-28 md:mb-32 flex flex-col items-center justify-center text-center px-6 pointer-events-none">
        <div id="typewriter-container"
             class="opacity-0 translate-y-2 transition-all duration-700 max-w-2xl mx-auto">
            <p style="font-family: 'Quicksand', sans-serif; text-shadow: 0 2px 14px rgba(244, 235, 214, 0.9);"
               class="text-lg sm:text-xl md:text-2xl font-bold text-[#153B1E] tracking-wide leading-relaxed">
                <span id="typed-content"></span><span id="typewriter-cursor" class="inline-block w-0.5 h-5 sm:h-6 bg-[#153B1E] ml-1 align-middle animate-pulse"></span>
            </p>
        </div>
    </div>

    <!-- Transisi Lengkungan Organik ke Section 2 -->
    <div class="relative z-10 w-full overflow-hidden leading-none pointer-events-none">
        <svg class="block w-full h-7 sm:h-11" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,10 C320,115 880,115 1200,10 L1200,120 L0,120 Z" fill="#F6F3EB"></path>
        </svg>
    </div>
</section>


<!-- ================================================================= -->
<!-- SECTION 2: FILOSOFI & MENGAPA SATU MEJA                           -->
<!-- ================================================================= -->
<section id="tentang" class="relative py-24 bg-organic-cream border-b border-sage/20 overflow-hidden">
    <!-- Ornamen Cahaya Organik Melayang -->
    <div class="pointer-events-none absolute -top-24 -left-24 w-80 h-80 rounded-full bg-[#D6C296]/30 blur-3xl animate-ambient-1"></div>
    <div class="pointer-events-none absolute -bottom-24 -right-20 w-96 h-96 rounded-full bg-sage/20 blur-3xl animate-ambient-2"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="reveal-up text-center max-w-3xl mx-auto mb-16 space-y-3">
            <span class="inline-block px-3.5 py-1 rounded-full bg-forest/10 text-xs font-bold uppercase tracking-widest text-forest">
                Gagasan &amp; Filosofi
            </span>
            <h2 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-bold text-forest">
                Mengapa Memilih Satu Meja?
            </h2>
            <p class="text-base text-gray-600 leading-relaxed">
                Di Indonesia, timbulan <span class="font-semibold text-forest">Food Loss and Waste (FLW)</span> mencapai 23-48 juta ton per tahun, sementara prevalensi ketidakcukupan konsumsi pangan masih 7,89%. Satu Meja hadir menjembatani kesenjangan ini.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Pillar 1 -->
            <div style="transition-delay: 100ms;"
                 class="reveal-up pillar-card relative overflow-hidden bg-white/90 backdrop-blur-md rounded-3xl p-8 border border-sage/25 shadow-sm flex flex-col justify-between group">
                <div class="space-y-4">
                    <div class="w-14 h-14 rounded-2xl bg-forest text-white flex items-center justify-center text-2xl shadow-md transition-transform duration-300 group-hover:scale-110 group-hover:rotate-6">
                        🤝
                    </div>
                    <h3 class="font-heading text-xl font-bold text-forest">Kemitraan Setara</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Pendonasi dan Penerima berada di meja yang sama sebagai mitra seimbang. Menghapus stigma "pemberi dan peminta", memperkuat kolaborasi sosial yang bermartabat.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-sage/20 flex items-center justify-between text-xs font-semibold text-forest">
                    <span>SDG 2: Zero Hunger</span>
                    <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-sage">●</span>
                </div>
                <div class="bottom-bar absolute bottom-0 left-0 h-1 bg-forest"></div>
            </div>

            <!-- Pillar 2 -->
            <div style="transition-delay: 250ms;"
                 class="reveal-up pillar-card relative overflow-hidden bg-white/90 backdrop-blur-md rounded-3xl p-8 border border-sage/25 shadow-sm flex flex-col justify-between group">
                <div class="space-y-4">
                    <div class="w-14 h-14 rounded-2xl bg-sage text-forest flex items-center justify-center text-2xl shadow-md transition-transform duration-300 group-hover:scale-110 group-hover:-rotate-6">
                        ⏱️
                    </div>
                    <h3 class="font-heading text-xl font-bold text-forest">Kedaluwarsa Otomatis</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Sistem mengevaluasi batas waktu layak konsumsi secara real-time setiap 15 detik. Pangan yang telah lewat waktu otomatis disembunyikan agar kualitas dan keamanan terjamin.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-sage/20 flex items-center justify-between text-xs font-semibold text-forest">
                    <span>Keamanan Pangan Terjaga</span>
                    <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-sage">●</span>
                </div>
                <div class="bottom-bar absolute bottom-0 left-0 h-1 bg-sage"></div>
            </div>

            <!-- Pillar 3 -->
            <div style="transition-delay: 400ms;"
                 class="reveal-up pillar-card relative overflow-hidden bg-white/90 backdrop-blur-md rounded-3xl p-8 border border-sage/25 shadow-sm flex flex-col justify-between group">
                <div class="space-y-4">
                    <div class="w-14 h-14 rounded-2xl bg-khaki text-forest flex items-center justify-center text-2xl shadow-md transition-transform duration-300 group-hover:scale-110 group-hover:rotate-6">
                        🛡️
                    </div>
                    <h3 class="font-heading text-xl font-bold text-forest">100% Terverifikasi</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Setiap akun pelaku usaha dan lembaga sosial diverifikasi langsung oleh Admin sebelum dapat melakukan aktivitas posting atau klaim. Menjamin keamanan dua arah.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-sage/20 flex items-center justify-between text-xs font-semibold text-forest">
                    <span>Moderasi Admin Terpusat</span>
                    <span class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-khaki">●</span>
                </div>
                <div class="bottom-bar absolute bottom-0 left-0 h-1 bg-khaki"></div>
            </div>
        </div>
    </div>
</section>


<!-- ================================================================= -->
<!-- SECTION 3: CARA KERJA SYSTEM (DEEP FOREST + ANIMATED TIMELINE)    -->
<!-- ================================================================= -->
<section id="cara-kerja" class="relative py-24 bg-deep-forest text-white overflow-hidden">
    <!-- Cahaya hangat dekoratif -->
    <div class="pointer-events-none absolute top-0 right-1/4 w-96 h-96 rounded-full bg-[#D6C296]/10 blur-3xl"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="reveal-up text-center max-w-3xl mx-auto mb-16 space-y-3">
            <span class="inline-block px-3.5 py-1 rounded-full bg-white/10 text-xs font-bold uppercase tracking-widest text-[#D6C296]">
                Alur Penyelesaian
            </span>
            <h2 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-bold text-white">
                Cara Kerja Platform Satu Meja
            </h2>
            <p class="text-base text-stone-300 leading-relaxed">
                Empat langkah cepat mempertemukan makanan berlebih dengan lembaga penyalur sebelum melewati batas layak konsumsi.
            </p>
        </div>

        <div class="relative">
            <!-- Garis penghubung horizontal animatif pada layar desktop -->
            <div class="step-line-draw hidden lg:block absolute top-11 left-12 right-12 h-0.5 bg-gradient-to-r from-[#D6C296]/25 via-[#D6C296] to-[#D6C296]/25"></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 relative z-10">
                <!-- Step 1 -->
                <div style="transition-delay: 100ms;"
                     class="reveal-up group bg-white/[0.07] hover:bg-white/[0.13] backdrop-blur-md rounded-3xl p-7 border border-white/15 hover:border-[#D6C296]/60 shadow-lg transition-all duration-300 hover:-translate-y-2">
                    <span class="w-11 h-11 rounded-2xl bg-[#D6C296] text-[#1B321E] font-extrabold flex items-center justify-center font-heading mb-5 shadow-md transition-transform duration-300 group-hover:scale-110">
                        01
                    </span>
                    <h3 class="font-heading text-lg font-bold text-white group-hover:text-[#D6C296] transition-colors mb-2.5">
                        Registrasi &amp; Verifikasi
                    </h3>
                    <p class="text-xs sm:text-sm text-stone-300 leading-relaxed">
                        Pengguna mendaftar sebagai Pendonasi atau Penerima. Admin memeriksa identitas dan memverifikasi akun.
                    </p>
                </div>

                <!-- Step 2 -->
                <div style="transition-delay: 250ms;"
                     class="reveal-up group bg-white/[0.07] hover:bg-white/[0.13] backdrop-blur-md rounded-3xl p-7 border border-white/15 hover:border-[#D6C296]/60 shadow-lg transition-all duration-300 hover:-translate-y-2">
                    <span class="w-11 h-11 rounded-2xl bg-[#D6C296] text-[#1B321E] font-extrabold flex items-center justify-center font-heading mb-5 shadow-md transition-transform duration-300 group-hover:scale-110">
                        02
                    </span>
                    <h3 class="font-heading text-lg font-bold text-white group-hover:text-[#D6C296] transition-colors mb-2.5">
                        Bagikan Pangan
                    </h3>
                    <p class="text-xs sm:text-sm text-stone-300 leading-relaxed">
                        Pendonasi menerbitkan donasi (porsi, lokasi, batas waktu layak). Sistem menetapkan status Segera Kedaluwarsa/Tersedia.
                    </p>
                </div>

                <!-- Step 3 -->
                <div style="transition-delay: 400ms;"
                     class="reveal-up group bg-white/[0.07] hover:bg-white/[0.13] backdrop-blur-md rounded-3xl p-7 border border-white/15 hover:border-[#D6C296]/60 shadow-lg transition-all duration-300 hover:-translate-y-2">
                    <span class="w-11 h-11 rounded-2xl bg-[#D6C296] text-[#1B321E] font-extrabold flex items-center justify-center font-heading mb-5 shadow-md transition-transform duration-300 group-hover:scale-110">
                        03
                    </span>
                    <h3 class="font-heading text-lg font-bold text-white group-hover:text-[#D6C296] transition-colors mb-2.5">
                        Cari &amp; Klaim Donasi
                    </h3>
                    <p class="text-xs sm:text-sm text-stone-300 leading-relaxed">
                        Penerima terverifikasi memfilter pangan aktif dan mengklaim. Klaim ganda dicek dan dicegah oleh sistem.
                    </p>
                </div>

                <!-- Step 4 -->
                <div style="transition-delay: 550ms;"
                     class="reveal-up group bg-white/[0.07] hover:bg-white/[0.13] backdrop-blur-md rounded-3xl p-7 border border-white/15 hover:border-[#D6C296]/60 shadow-lg transition-all duration-300 hover:-translate-y-2">
                    <span class="w-11 h-11 rounded-2xl bg-[#D6C296] text-[#1B321E] font-extrabold flex items-center justify-center font-heading mb-5 shadow-md transition-transform duration-300 group-hover:scale-110">
                        04
                    </span>
                    <h3 class="font-heading text-lg font-bold text-white group-hover:text-[#D6C296] transition-colors mb-2.5">
                        Serah Terima &amp; Apresiasi
                    </h3>
                    <p class="text-xs sm:text-sm text-stone-300 leading-relaxed">
                        Pengambilan fisik dilakukan, data pengklaim tampil di dasbor, dan Penerima dapat mengirim ucapan terima kasih.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ================================================================= -->
<!-- SECTION 4: FEED DONASI AKTIF / KEADAAN KOSONG                    -->
<!-- ================================================================= -->
<section class="relative py-24 bg-gradient-to-b from-[#EBF0E7] via-[#F4F6F0] to-[#F6F3EB] border-t border-sage/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="reveal-up flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <span class="inline-block px-3 py-1 rounded-full bg-forest/10 text-xs font-bold uppercase tracking-widest text-forest mb-2">
                    Pangan Aktif Tersedia
                </span>
                <h2 class="font-heading text-3xl sm:text-4xl font-bold text-forest">Donasi Pangan Terbaru</h2>
            </div>
            <a href="{{ route('donations.index') }}"
               class="group min-h-[44px] px-5 inline-flex items-center gap-2 text-sm font-bold text-forest hover:text-forest-800 underline underline-offset-4">
                <span>Lihat Seluruh Daftar Donasi</span>
                <span class="transition-transform duration-300 group-hover:translate-x-1.5">→</span>
            </a>
        </div>

        @if(isset($latestDonations) && $latestDonations->count() > 0)
            <!-- Grid Donasi Aktif -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                @foreach($latestDonations as $index => $donation)
                    <div style="transition-delay: {{ ($index % 4) * 120 }}ms;"
                         class="reveal-zoom bg-white rounded-2xl p-4 border border-sage/25 shadow-sm flex flex-col justify-between hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group">
                        <div class="space-y-3">

                            <!-- Foto Produk Makanan -->
                            @if($donation->image_url_formatted)
                                <div class="w-full aspect-[4/3] overflow-hidden rounded-xl border border-sage/15 bg-white relative flex items-center justify-center p-1">
                                    <img src="{{ $donation->image_url_formatted }}"
                                         alt="Foto {{ $donation->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 rounded-lg">
                                </div>
                            @elseif($donation->photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($donation->photo))
                                <div class="w-full aspect-[4/3] overflow-hidden rounded-xl border border-sage/15 bg-white relative flex items-center justify-center p-1">
                                    <img src="{{ asset('storage/' . $donation->photo) }}"
                                         alt="Foto {{ $donation->title }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 rounded-lg">
                                </div>
                            @else
                                <div class="w-full aspect-[4/3] rounded-xl border border-sage/20 bg-sage-100/40 flex flex-col items-center justify-center text-forest/60 gap-1">
                                    <span class="text-3xl" aria-hidden="true">🍱</span>
                                    <span class="text-[10px] font-semibold">Tanpa Foto</span>
                                </div>
                            @endif

                            <!-- Badges -->
                            <div class="flex flex-wrap items-center justify-between gap-1.5">
                                <span class="px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-sage-100 text-forest border border-sage/30">
                                    {{ $donation->food_type ?? 'Pangan Berlebih' }}
                                </span>
                                @if(\Carbon\Carbon::parse($donation->deadline)->diffInHours(now()) <= 48)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-ping"></span>
                                        Urgent
                                    </span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                        Tersedia
                                    </span>
                                @endif
                            </div>

                            <!-- Title & Desc -->
                            <div>
                                <h3 class="font-heading text-sm sm:text-base font-bold text-gray-900 leading-tight line-clamp-2 group-hover:text-forest transition-colors">
                                    {{ $donation->title }}
                                </h3>
                                <p class="text-[11px] text-gray-600 line-clamp-2 mt-1">
                                    {{ $donation->description ?? 'Tidak ada deskripsi tambahan.' }}
                                </p>
                            </div>

                            <!-- Info Details -->
                            <div class="space-y-1.5 pt-2 border-t border-sage/20 text-[11px] text-gray-700">
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-gray-500">Jumlah Porsi:</span>
                                    <span class="font-bold text-forest">{{ $donation->quantity ?? '-' }}</span>
                                </div>
                                <div class="flex items-center justify-between gap-2">
                                    <span class="font-semibold text-gray-500 shrink-0">Lokasi:</span>
                                    <span class="font-medium text-gray-800 text-right truncate" title="{{ $donation->location }}">{{ $donation->location }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-gray-500">Batas Waktu:</span>
                                    <span class="font-mono text-forest font-bold bg-forest/5 px-1.5 py-0.5 rounded text-[10px]">
                                        {{ \Carbon\Carbon::parse($donation->deadline)->format('d M Y H:i') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="pt-4 mt-3 border-t border-sage/20">
                            <a href="{{ route('donations.index') }}"
                               class="w-full min-h-[38px] px-3 py-2 inline-flex items-center justify-center text-[11px] font-bold text-white bg-forest hover:bg-forest-800 rounded-lg transition-colors shadow-sm">
                                Detail &amp; Klaim Donasi
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Keadaan Kosong (Empty State) -->
            <div class="reveal-zoom bg-white/90 backdrop-blur-sm rounded-3xl p-10 sm:p-16 border border-dashed border-sage/40 text-center max-w-3xl mx-auto space-y-5 shadow-sm">
                <div class="w-16 h-16 rounded-3xl bg-forest-50 text-forest flex items-center justify-center text-3xl mx-auto shadow-inner animate-bounce">
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
<!-- JAVASCRIPT: HERO VIDEO, TYPEWRITER & SCROLL REVEAL ANIMATIONS     -->
<!-- ================================================================= -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // 1. Hero Video & Typewriter Animation
        const bgVideo = document.getElementById('hero-bg-video');
        const typewriterContainer = document.getElementById('typewriter-container');
        const typedContent = document.getElementById('typed-content');
        const typewriterCursor = document.getElementById('typewriter-cursor');
        const textToType = "Platform Kolaborasi Berbagi Pangan & Mewujudkan Zero Hunger";

        function startTypewriter() {
            if (!typedContent || !typewriterContainer) return;
            typewriterContainer.classList.remove('opacity-0', 'translate-y-2');
            typedContent.textContent = '';
            let index = 0;
            const speed = 38;

            function typeChar() {
                if (index < textToType.length) {
                    typedContent.textContent += textToType.charAt(index);
                    index++;
                    setTimeout(typeChar, speed);
                } else if (typewriterCursor) {
                    setTimeout(() => {
                        typewriterCursor.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                    }, 1200);
                }
            }
            typeChar();
        }

        if (bgVideo) {
            bgVideo.play().catch(err => console.log('Autoplay handled:', err));
            bgVideo.addEventListener('ended', () => {
                bgVideo.pause();
                startTypewriter();
            });
        }

        // 2. Scroll Reveal Observer untuk Section 2, 3, 4 & Garis Timeline
        const animatedElements = document.querySelectorAll('.reveal-up, .reveal-zoom, .step-line-draw');
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    obs.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -40px 0px'
        });

        animatedElements.forEach(el => observer.observe(el));
    });
</script>
@endsection
