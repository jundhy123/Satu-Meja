@extends('layouts.app')

@section('title', 'Dasbor Penerima - Satu Meja')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
    <!-- Header Banner -->
    <div class="bg-forest text-white rounded-2xl p-5 sm:p-6 shadow-lg flex flex-col md:flex-row md:items-center justify-between gap-4 border border-sage/20 relative overflow-hidden">
        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-48 h-48 bg-sage/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="space-y-2 relative z-10">
            <div class="flex flex-wrap items-center gap-2">
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-sage/30 text-sage-200 border border-sage/40">
                    Ruang Kerja Penerima
                </span>
                @if($user->status === 'verified')
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/20 text-emerald-200 border border-emerald-400/30 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Terverifikasi
                    </span>
                @elseif($user->status === 'pending')
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/20 text-amber-200 border border-amber-400/30 animate-pulse flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Menunggu Verifikasi
                    </span>
                @else
                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-red-500/20 text-red-200 border border-red-400/30 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        Ditolak
                    </span>
                @endif
            </div>
            <div>
                <h1 class="font-heading text-xl sm:text-2xl font-extrabold tracking-tight">{{ $user->institution_name ?? $user->name }}</h1>
                <p class="text-[11px] sm:text-xs text-sage-100 mt-1 flex flex-wrap items-center gap-x-2 gap-y-1">
                    <span>Kategori: <strong class="text-white">{{ $user->category ?? 'Lembaga Sosial' }}</strong></span>
                    <span class="hidden sm:inline text-sage-400">•</span>
                    <span>PIC: <strong class="text-white">{{ $user->pic_name ?? '-' }}</strong></span>
                    <span class="hidden sm:inline text-sage-400">•</span>
                    <span>Telepon: <strong class="text-white">{{ $user->phone ?? '-' }}</strong></span>
                </p>
            </div>
        </div>

        <div class="relative z-10 shrink-0">
            <a href="{{ route('donations.index') }}"
               class="min-h-[40px] px-4 py-2 inline-flex items-center justify-center bg-white text-forest hover:bg-gray-50 font-bold text-xs rounded-lg shadow-sm transition-all w-full md:w-auto">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                Cari Donasi
            </a>
        </div>
    </div>

    <!-- Alert Notices -->
    @if(session('success'))
        <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-900 px-4 py-3 rounded-r-xl text-xs font-semibold shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 text-red-900 px-4 py-3 rounded-r-xl text-xs font-semibold shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    @if($user->status === 'pending')
        <div class="bg-amber-50 border border-amber-200 text-amber-900 p-4 rounded-xl flex items-start gap-3 shadow-sm">
            <div class="text-amber-500 mt-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <div class="space-y-0.5">
                <h3 class="font-bold text-xs">Akun Menunggu Verifikasi Admin</h3>
                <p class="text-[11px] text-amber-800 leading-relaxed">
                    Akun lembaga Anda sedang diperiksa. Anda dapat melihat daftar donasi tetapi belum dapat menekan tombol Klaim.
                </p>
            </div>
        </div>
    @endif

    <!-- Daftar Klaim Makanan -->
    <div class="bg-white rounded-2xl p-5 sm:p-6 shadow-sm border border-sage/20 space-y-5">
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-gray-100 pb-4">
            <h2 class="font-heading text-lg sm:text-xl font-bold text-forest">Riwayat Klaim Donasi</h2>
            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-gray-50 border border-gray-200 text-[11px] text-gray-600 font-semibold w-fit">
                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                Total: {{ $claimedDonations->total() }} Klaim
            </span>
        </div>

        @if($claimedDonations->count() > 0)
            <!-- List Vertikal (Bukan Grid) agar lebih memanjang ke bawah namun ringkas per item -->
            <div class="flex flex-col gap-4">
                @foreach($claimedDonations as $donation)
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300 flex flex-col sm:flex-row overflow-hidden">
                        
                        <!-- Bagian Kiri: Foto Kecil & Utuh -->
                        <div class="w-full sm:w-32 md:w-40 shrink-0 bg-gray-50/50 border-b sm:border-b-0 sm:border-r border-gray-100 p-3 flex items-center justify-center">
                            @if($donation->photo)
                                <div class="w-full aspect-square sm:h-24 md:h-28 overflow-hidden rounded-lg bg-white border border-gray-100 p-1 relative group">
                                    <img src="{{ asset('storage/' . $donation->photo) }}"
                                         alt="Foto {{ $donation->title }}"
                                         class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                                </div>
                            @else
                                <div class="w-full aspect-square sm:h-24 md:h-28 rounded-lg border border-gray-200 bg-white flex flex-col items-center justify-center text-gray-400 gap-1">
                                    <span class="text-2xl">🍱</span>
                                    <span class="text-[9px] font-semibold">Tanpa Foto</span>
                                </div>
                            @endif
                        </div>

                        <!-- Bagian Kanan: Detail Informasi -->
                        <div class="flex-1 p-4 flex flex-col justify-between gap-3">
                            
                            <div class="space-y-2">
                                <!-- Badges & Title -->
                                <div class="flex flex-wrap items-start justify-between gap-2">
                                    <div>
                                        <h3 class="font-heading text-sm sm:text-base font-bold text-gray-900 leading-tight line-clamp-1">
                                            {{ $donation->title }}
                                        </h3>
                                        <p class="text-[11px] text-gray-500 line-clamp-1 mt-0.5">
                                            {{ $donation->description ?? 'Tidak ada deskripsi tambahan.' }}
                                        </p>
                                    </div>
                                    <div class="flex flex-wrap gap-1.5 shrink-0">
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-100 flex items-center gap-1">
                                            ✓ {{ \Carbon\Carbon::parse($donation->claimed_at)->format('d M y, H:i') }}
                                        </span>
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-sage-50 text-forest border border-sage/20">
                                            {{ $donation->food_type }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Grid Info (2 Kolom agar ringkas) -->
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 text-[11px] bg-gray-50/50 p-2.5 rounded-lg border border-gray-100">
                                    <div>
                                        <span class="text-gray-400 block text-[9px] uppercase font-bold tracking-wider">Pendonasi</span>
                                        <span class="font-semibold text-forest truncate block" title="{{ $donation->donor->institution_name ?? $donation->donor->name }}">{{ $donation->donor->institution_name ?? $donation->donor->name ?? 'Pendonasi' }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-400 block text-[9px] uppercase font-bold tracking-wider">PIC</span>
                                        <span class="font-semibold text-gray-800 truncate block" title="{{ $donation->pic_name }}">{{ $donation->pic_name }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-400 block text-[9px] uppercase font-bold tracking-wider">Kontak</span>
                                        <span class="font-mono font-bold text-emerald-700 truncate block">{{ $donation->pic_contact }}</span>
                                    </div>
                                    <div>
                                        <span class="text-gray-400 block text-[9px] uppercase font-bold tracking-wider">Metode</span>
                                        <span class="font-semibold text-gray-800 truncate block">{{ $donation->delivery_method }}</span>
                                    </div>
                                    <div class="col-span-2 sm:col-span-4 mt-1 pt-1 border-t border-gray-200">
                                        <span class="text-gray-400 block text-[9px] uppercase font-bold tracking-wider">Alamat Pengambilan</span>
                                        <span class="font-medium text-gray-800 truncate block" title="{{ $donation->pickup_address }}">{{ $donation->pickup_address }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Ucapan Terima Kasih (Inline & Ringkas) -->
                            <div class="pt-2 border-t border-gray-100">
                                @if($donation->thankYou)
                                    <div class="bg-emerald-50/80 px-3 py-2 rounded-lg border border-emerald-100 flex items-start gap-2">
                                        <svg class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        <div>
                                            <span class="text-[10px] font-bold text-emerald-800 block">Ucapan Terima Kasih Terkirim:</span>
                                            <p class="text-[11px] text-emerald-900 italic leading-relaxed">"{{ $donation->thankYou->message }}"</p>
                                        </div>
                                    </div>
                                @else
                                    <form action="{{ route('penerima.thankyou.store') }}" method="POST" class="flex flex-col sm:flex-row gap-2 items-start sm:items-center">
                                        @csrf
                                        <input type="hidden" name="donation_id" value="{{ $donation->id }}">
                                        <textarea id="message-{{ $donation->id }}" name="message" rows="1" required
                                                  class="w-full px-2.5 py-1.5 rounded-lg border border-gray-200 text-[11px] focus:outline-none focus:ring-2 focus:ring-forest/20 focus:border-forest bg-white transition-colors resize-none flex-1"
                                                  placeholder="Tulis ucapan terima kasih untuk pendonasi..."></textarea>
                                        <button type="submit"
                                                class="shrink-0 min-h-[32px] px-4 py-1.5 bg-forest hover:bg-forest-800 text-white font-bold text-[11px] rounded-lg transition-all shadow-sm flex items-center justify-center gap-1.5">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                            Kirim
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="pt-4 flex justify-center">
                {{ $claimedDonations->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12 px-4 bg-gray-50/50 rounded-xl border border-dashed border-gray-200 space-y-3">
                <div class="w-14 h-14 rounded-full bg-white border border-gray-100 text-gray-400 flex items-center justify-center text-xl mx-auto shadow-sm">
                    📭
                </div>
                <div class="space-y-1">
                    <h3 class="font-heading text-base font-bold text-gray-800">Belum Ada Klaim</h3>
                    <p class="text-[11px] text-gray-500 max-w-sm mx-auto">Lembaga Anda belum memiliki riwayat donasi pangan yang diklaim.</p>
                </div>
                <a href="{{ route('donations.index') }}" class="inline-flex min-h-[36px] px-5 py-1.5 bg-forest text-white font-bold text-[11px] rounded-lg hover:bg-forest-800 transition-colors shadow-sm">
                    Cari Donasi Pangan Sekarang
                </a>
            </div>
        @endif
    </div>
</div>
@endsection