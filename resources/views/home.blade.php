@extends('layouts.app')

@section('title', 'Beranda - Satu Meja | Platform Berbagi Pangan Zero Hunger')

@section('content')
<!-- ================================================================= -->
<!-- HERO SECTION WITH CLEAN FULL VIDEO BACKGROUND                     -->
<!-- ================================================================= -->
<section class="relative w-full h-screen flex flex-col justify-between overflow-hidden bg-black text-white">
    <!-- Clean Video Background (Natural Crisp Colors, Asset URL) -->
    <div class="absolute inset-0 z-0 bg-black">
        <video id="hero-bg-video" class="w-full h-full object-cover transition-opacity duration-700" autoplay muted playsinline preload="auto">
            <source src="{{ asset('animation/Diverse_people_eating_at_table_8cca1276.mp4') }}" type="video/mp4">
            Browser Anda tidak mendukung pemutaran video.
        </video>
        <!-- Soft subtle top/bottom gradient overlay for text readability -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-transparent to-black/40 pointer-events-none"></div>
    </div>

    <!-- Centered Typewriter Text Container (Positioned right under the large "Satu Meja" in the final frame) -->
    <div class="relative z-10 my-auto flex flex-col items-center justify-center text-center px-6 pt-36 sm:pt-48 pointer-events-none">
        <div id="typewriter-container" class="opacity-0 transition-opacity duration-700 max-w-3xl mx-auto">
            <p class="font-heading text-xl sm:text-2xl md:text-3xl font-extrabold text-forest-900 tracking-wide leading-relaxed drop-shadow-sm">
                <span id="typed-content"></span><span id="typewriter-cursor" class="inline-block w-0.5 h-6 sm:h-8 bg-forest-900 ml-1 animate-pulse">|</span>
            </p>
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
<!-- JAVASCRIPT FOR HERO VIDEO & TYPEWRITER ANIMATION                  -->
<!-- ================================================================= -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const bgVideo = document.getElementById('hero-bg-video');
        const typewriterContainer = document.getElementById('typewriter-container');
        const typedContent = document.getElementById('typed-content');
        const textToType = "Platform Kolaborasi Berbagi Pangan & Mewujudkan Zero Hunger";

        function startTypewriter() {
            if (!typedContent || !typewriterContainer) return;
            typewriterContainer.classList.remove('opacity-0');
            typedContent.textContent = '';
            let index = 0;
            const speed = 40; // Kecepatan mengetik per karakter (ms)

            function typeChar() {
                if (index < textToType.length) {
                    typedContent.textContent += textToType.charAt(index);
                    index++;
                    setTimeout(typeChar, speed);
                }
            }
            typeChar();
        }

        if (bgVideo) {
            bgVideo.play().catch(err => console.log('Autoplay handled:', err));
            bgVideo.addEventListener('ended', () => {
                bgVideo.pause(); // Tahan pada frame terakhir ("Satu Meja")
                startTypewriter(); // Mulai efek mengetik dari nol saat video selesai
            });
        }
    });
</script>
@endsection
