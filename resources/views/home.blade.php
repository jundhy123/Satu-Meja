@extends('layouts.app')

@section('title', 'Beranda - Satu Meja | Platform Berbagi Pangan Zero Hunger')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-gradient-to-b from-forest/5 via-page to-page pt-12 pb-20 lg:pt-20 lg:pb-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

            <!-- Hero Left Content -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <!-- Subtheme Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-forest-50 border border-sage/30 text-forest font-semibold text-xs sm:text-sm tracking-wide shadow-sm">
                    <span class="w-2.5 h-2.5 rounded-full bg-sage animate-pulse"></span>
                    <span>SEVENT X 2026 • Subtema Zero Hunger (SDG 2)</span>
                </div>

                <!-- Main Headline -->
                <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-extrabold text-forest leading-tight tracking-tight">
                    Duduk Bersama di <span class="text-sage underline decoration-sage/40 decoration-wavy decoration-2">Satu Meja</span>, Wujudkan Pangan Cukup untuk Semua
                </h1>

                <!-- Subheadline -->
                <p class="text-base sm:text-lg text-gray-700 leading-relaxed max-w-2xl mx-auto lg:mx-0 font-normal">
                    Platform kolaborasi berbagi pangan berlebih layak konsumsi yang menghubungkan pelaku usaha pangan (<span class="font-semibold text-forest">Pendonasi</span>) dengan lembaga sosial terverifikasi (<span class="font-semibold text-forest">Penerima</span>). Duduk di meja yang sama sebagai mitra seimbang, bukan pemberi dan peminta.
                </p>

                <!-- CTA Action Buttons (Accessibility min 44px) -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                    <a href="{{ route('donations.index') }}"
                       class="w-full sm:w-auto min-h-[48px] min-w-[44px] px-8 py-3.5 inline-flex items-center justify-center bg-forest hover:bg-forest-800 text-white font-bold rounded-xl shadow-lg shadow-forest/20 transition-all duration-200 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-forest focus:ring-offset-2">
                        <svg class="w-5 h-5 mr-2 -ml-1 text-sage-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari Donasi Pangan
                    </a>

                    @guest
                        <a href="{{ route('login') }}"
                           class="w-full sm:w-auto min-h-[48px] min-w-[44px] px-8 py-3.5 inline-flex items-center justify-center bg-white hover:bg-sage-100 text-forest font-bold rounded-xl border border-sage/40 shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-forest focus:ring-offset-2">
                            <svg class="w-5 h-5 mr-2 -ml-1 text-forest" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Masuk Portal Pengguna
                        </a>
                    @else
                        <span class="inline-flex items-center text-sm font-semibold text-forest bg-sage-100 px-4 py-2 rounded-xl">
                            ✓ Anda telah masuk sebagai {{ ucfirst(auth()->user()->role ?? 'pengguna') }}
                        </span>
                    @endguest
                </div>

                <!-- Feature Pillars Checklist -->
                <div class="pt-4 grid grid-cols-1 sm:grid-cols-3 gap-3 text-left">
                    <div class="flex items-center gap-2">
                        <div class="w-5 h-5 rounded-full bg-sage/20 text-forest flex items-center justify-center text-xs font-bold">✓</div>
                        <span class="text-xs font-bold text-gray-800">100% Akun Terverifikasi</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-5 h-5 rounded-full bg-sage/20 text-forest flex items-center justify-center text-xs font-bold">✓</div>
                        <span class="text-xs font-bold text-gray-800">Kedaluwarsa Otomatis</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-5 h-5 rounded-full bg-sage/20 text-forest flex items-center justify-center text-xs font-bold">✓</div>
                        <span class="text-xs font-bold text-gray-800">Umpan Balik Dua Arah</span>
                    </div>
                </div>
            </div>

            <!-- Hero Right Visual Banner -->
            <div class="lg:col-span-5">
                <div class="relative bg-white rounded-3xl p-6 sm:p-8 shadow-xl border border-sage/20 space-y-6">
                    <!-- Top Badge -->
                    <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-2xl bg-forest text-white flex items-center justify-center font-heading text-xl font-bold shadow-md">
                                🍲
                            </div>
                            <div>
                                <h3 class="font-heading font-bold text-forest text-lg leading-tight">Status Pangan Real-Time</h3>
                                <p class="text-xs text-gray-500">Pengecekan Otomatis Setiap 15 Detik</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                            Aktif
                        </span>
                    </div>

                    <!-- Live Stat Card Mock -->
                    <div class="bg-forest-50/60 rounded-2xl p-4 border border-forest-100 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-forest">Donasi Pangan Layak Konsumsi</span>
                            <span class="text-xs font-bold px-2 py-0.5 rounded bg-amber-100 text-amber-800 border border-amber-200">Segera Kedaluwarsa</span>
                        </div>
                        <p class="font-heading font-bold text-gray-900 text-base">50 Porsi Nasi Kotak Ayam Bakar</p>
                        <div class="flex items-center justify-between text-xs text-gray-600 pt-1 border-t border-forest-100/60">
                            <span>📍 Restoran Melati, Laguboti</span>
                            <span class="font-mono text-amber-700 font-bold">⏰ Sisa 18 Jam</span>
                        </div>
                    </div>

                    <!-- Visual Metrics Mini Grid -->
                    <div class="grid grid-cols-2 gap-3 pt-2">
                        <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm text-center">
                            <span class="block text-2xl font-extrabold text-forest font-heading">
                                {{ $stats['claimed_donations'] ?? 0 }}
                            </span>
                            <span class="text-xs text-gray-600 font-semibold">Porsi Tersalurkan</span>
                        </div>
                        <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm text-center">
                            <span class="block text-2xl font-extrabold text-forest font-heading">
                                {{ $stats['verified_institutions'] ?? 0 }}
                            </span>
                            <span class="text-xs text-gray-600 font-semibold">Lembaga Terverifikasi</span>
                        </div>
                    </div>

                    <!-- Bottom Quote -->
                    <p class="text-xs text-gray-500 italic text-center pt-2">
                        "Setiap porsi makanan yang diselamatkan adalah porsi yang mengenyangkan mereka yang membutuhkan."
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Section 2: Filosofi & Mengapa Satu Meja -->
<section id="tentang" class="py-16 bg-white border-y border-sage/15">
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
            <div class="bg-page rounded-2xl p-8 border border-sage/20 shadow-sm flex flex-col justify-between hover:shadow-md transition">
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
            <div class="bg-page rounded-2xl p-8 border border-sage/20 shadow-sm flex flex-col justify-between hover:shadow-md transition">
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
            <div class="bg-page rounded-2xl p-8 border border-sage/20 shadow-sm flex flex-col justify-between hover:shadow-md transition">
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

<!-- Section 3: Cara Kerja System (How It Works) -->
<section id="cara-kerja" class="py-16 sm:py-24 bg-page">
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
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm relative">
                <span class="w-10 h-10 rounded-xl bg-forest text-white font-bold flex items-center justify-center font-heading mb-4">
                    01
                </span>
                <h3 class="font-heading text-lg font-bold text-forest mb-2">Registrasi & Verifikasi</h3>
                <p class="text-xs text-gray-600 leading-relaxed">
                    Pengguna mendaftar sebagai Pendonasi atau Penerima. Admin memeriksa identitas dan memverifikasi akun.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm relative">
                <span class="w-10 h-10 rounded-xl bg-forest text-white font-bold flex items-center justify-center font-heading mb-4">
                    02
                </span>
                <h3 class="font-heading text-lg font-bold text-forest mb-2">Bagikan Pangan</h3>
                <p class="text-xs text-gray-600 leading-relaxed">
                    Pendonasi menerbitkan donasi (porsi, lokasi, batas waktu layak). Sistem menetapkan status Segera Kedaluwarsa/Tersedia.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm relative">
                <span class="w-10 h-10 rounded-xl bg-forest text-white font-bold flex items-center justify-center font-heading mb-4">
                    03
                </span>
                <h3 class="font-heading text-lg font-bold text-forest mb-2">Cari & Klaim Donasi</h3>
                <p class="text-xs text-gray-600 leading-relaxed">
                    Penerima terverifikasi memfilter pangan aktif dan mengklaim. Klaim ganda dicek dan dicegah oleh sistem.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm relative">
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

<!-- Section 4: Feed Donasi Aktif / Keadaan Kosong (Available Donations Feed) -->
<section class="py-16 bg-white border-t border-sage/15">
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
                    <div class="bg-page rounded-2xl p-6 border border-sage/20 shadow-sm flex flex-col justify-between hover:shadow-md transition">
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
            <!-- Keadaan Kosong (Empty State - Sesuai Spesifikasi Panduan) -->
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

<!-- Section 5: Dua Peran Mitra (Sektor Mitra) -->
<section class="py-16 bg-page">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
            <span class="text-xs font-bold uppercase tracking-widest text-sage">Peran Pengguna</span>
            <h2 class="font-heading text-3xl font-bold text-forest">Satu Meja Terbuka Untuk Siapa Saja?</h2>
            <p class="text-base text-gray-600">
                Menghubungkan dua pihak utama yang memiliki peranan kunci dalam mewujudkan Zero Hunger.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Box Pendonasi -->
            <div class="bg-white rounded-3xl p-8 border border-sage/20 shadow-sm space-y-5">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-forest text-white flex items-center justify-center text-2xl">
                        🏬
                    </div>
                    <div>
                        <h3 class="font-heading text-xl font-bold text-forest">Pendonasi (Pelaku Usaha Pangan)</h3>
                        <p class="text-xs text-sage-600 font-semibold">Restoran, Toko Roti, Katering, Swalayan, Hotel</p>
                    </div>
                </div>
                <ul class="space-y-2.5 text-xs text-gray-700">
                    <li class="flex items-start gap-2">
                        <span class="text-forest font-bold">✓</span>
                        <span>Mengurangi makanan berlebih yang terbuang sia-sia dan menghemat biaya pengelolaan limbah.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-forest font-bold">✓</span>
                        <span>Mendapatkan pencatatan donasi otomatis pada Dasbor Pendonasi & laporan riwayat.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-forest font-bold">✓</span>
                        <span>Menerima apresiasi dan ucapan terima kasih langsung dari lembaga penerima manfaat.</span>
                    </li>
                </ul>
            </div>

            <!-- Box Penerima -->
            <div class="bg-white rounded-3xl p-8 border border-sage/20 shadow-sm space-y-5">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-sage text-forest flex items-center justify-center text-2xl">
                        🏛️
                    </div>
                    <div>
                        <h3 class="font-heading text-xl font-bold text-forest">Penerima (Lembaga Sosial & Komunitas)</h3>
                        <p class="text-xs text-sage-600 font-semibold">Panti Asuhan, Dapur Umum, Yayasan, Komunitas Berbagi</p>
                    </div>
                </div>
                <ul class="space-y-2.5 text-xs text-gray-700">
                    <li class="flex items-start gap-2">
                        <span class="text-forest font-bold">✓</span>
                        <span>Akses cepat ke makanan layak konsumsi terverifikasi tanpa biaya tambahan.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-forest font-bold">✓</span>
                        <span>Sistem pencarian dengan filter lokasi, jenis makanan, dan batas layak konsumsi.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-forest font-bold">✓</span>
                        <span>Informasi penanggung jawab (PIC) dan alamat pengambilan yang transparan.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Section 6: Call To Action Penutup -->
<section class="py-16 bg-forest text-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-sage/20 text-sage-200 border border-sage/30">
            Mari Bergabung Bersama Kami
        </span>
        <h2 class="font-heading text-3xl sm:text-4xl font-extrabold text-white leading-tight">
            Siap Menyelamatkan Pangan Berlebih Hari Ini?
        </h2>
        <p class="text-base sm:text-lg text-sage-100 max-w-2xl mx-auto">
            Jangan biarkan makanan layak konsumsi terbuang. Jadilah bagian dari gerakan kolaborasi Zero Hunger bersama Satu Meja.
        </p>
        <div class="pt-4 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('donations.index') }}"
               class="w-full sm:w-auto min-h-[48px] min-w-[44px] px-8 py-3.5 inline-flex items-center justify-center bg-white text-forest hover:bg-sage-100 font-bold rounded-xl shadow-md transition">
                Cari Donasi Pangan
            </a>
            @guest
                <a href="{{ route('login') }}"
                   class="w-full sm:w-auto min-h-[48px] min-w-[44px] px-8 py-3.5 inline-flex items-center justify-center bg-forest-800 text-white hover:bg-forest-900 border border-sage/30 font-bold rounded-xl transition">
                    Daftar / Masuk Akun
                </a>
            @endguest
        </div>
    </div>
</section>
@endsection
