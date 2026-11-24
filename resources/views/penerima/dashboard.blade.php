@extends('layouts.app')

@section('title', 'Dasbor Penerima - Satu Meja')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
    <!-- Header Banner -->
    <div class="bg-forest text-white rounded-3xl p-8 shadow-xl flex flex-col md:flex-row md:items-center justify-between gap-6 border border-sage/20">
        <div class="space-y-2">
            <div class="flex items-center gap-3">
                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-sage/30 text-sage-200 border border-sage/40">
                    Ruang Kerja Penerima Manfaat
                </span>
                @if($user->status === 'verified')
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-200 border border-emerald-400/30">
                        ✓ Terverifikasi oleh Admin
                    </span>
                @elseif($user->status === 'pending')
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-500/20 text-amber-200 border border-amber-400/30 animate-pulse">
                        ⏳ Menunggu Verifikasi Admin
                    </span>
                @else
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-500/20 text-red-200 border border-red-400/30">
                        ✕ Ditolak
                    </span>
                @endif
            </div>
            <h1 class="font-heading text-3xl font-bold">{{ $user->institution_name ?? $user->name }}</h1>
            <p class="text-xs text-sage-100">
                Kategori: {{ $user->category ?? 'Lembaga Sosial' }} • PIC: {{ $user->pic_name ?? '-' }} • Telepon: {{ $user->phone ?? '-' }}
            </p>
        </div>

        <div>
            <a href="{{ route('donations.index') }}"
               class="min-h-[48px] px-6 py-3.5 inline-flex items-center justify-center bg-white text-forest hover:bg-sage-100 font-bold text-sm rounded-xl shadow-md transition">
                🔍 Cari Donasi Pangan Terdekat
            </a>
        </div>
    </div>

    <!-- Alert Notices -->
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-900 px-5 py-4 rounded-2xl text-sm font-semibold shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-900 px-5 py-4 rounded-2xl text-sm font-semibold shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    @if($user->status === 'pending')
        <div class="bg-amber-50 border border-amber-200 text-amber-900 p-6 rounded-2xl space-y-2">
            <h3 class="font-heading font-bold text-base flex items-center gap-2">
                ⚠️ Akun Menunggu Verifikasi Admin
            </h3>
            <p class="text-xs leading-relaxed text-amber-800">
                Akun lembaga Anda saat ini sedang diperiksa oleh Admin. Sebelum terverifikasi, Anda dapat melihat daftar donasi tetapi belum dapat menekan tombol Klaim.
            </p>
        </div>
    @endif

    <!-- Daftar Klaim Makanan -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-sage/20 space-y-6">
        <div class="flex items-center justify-between border-b border-gray-100 pb-4">
            <h2 class="font-heading text-xl font-bold text-forest">Daftar Donasi Pangan Yang Anda Klaim</h2>
            <span class="text-xs text-gray-500 font-medium">Total: {{ $claimedDonations->total() }} Klaim</span>
        </div>

        @if($claimedDonations->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($claimedDonations as $donation)
                    <div class="bg-page rounded-2xl p-6 border border-sage/20 shadow-sm space-y-4 flex flex-col justify-between">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="px-2.5 py-0.5 rounded text-[11px] font-bold bg-blue-100 text-blue-800 border border-blue-200">
                                    ✓ Diklaim pada {{ \Carbon\Carbon::parse($donation->claimed_at)->format('d M Y H:i') }}
                                </span>
                                <span class="px-2.5 py-0.5 rounded text-[11px] font-bold bg-sage-100 text-forest border border-sage/30">
                                    {{ $donation->food_type }}
                                </span>
                            </div>

                            <h3 class="font-heading text-lg font-bold text-gray-900 leading-snug">
                                {{ $donation->title }}
                            </h3>

                            <p class="text-xs text-gray-600">
                                {{ $donation->description ?? 'Tidak ada deskripsi tambahan.' }}
                            </p>

                            <!-- Information Box for Pickup -->
                            <div class="bg-white p-4 rounded-xl border border-gray-200 space-y-2 text-xs">
                                <div class="flex justify-between border-b border-gray-100 pb-1">
                                    <span class="font-semibold text-gray-500">Usaha Pendonasi:</span>
                                    <span class="font-bold text-forest">{{ $donation->donor->institution_name ?? $donation->donor->name ?? 'Pendonasi' }}</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-1">
                                    <span class="font-semibold text-gray-500">PIC Penanggung Jawab:</span>
                                    <span class="font-bold text-gray-800">{{ $donation->pic_name }}</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-1">
                                    <span class="font-semibold text-gray-500">Kontak WA / Telepon:</span>
                                    <span class="font-mono font-bold text-emerald-800">{{ $donation->pic_contact }}</span>
                                </div>
                                <div class="flex justify-between border-b border-gray-100 pb-1">
                                    <span class="font-semibold text-gray-500">Metode Penyerahan:</span>
                                    <span class="font-bold text-gray-800">{{ $donation->delivery_method }}</span>
                                </div>
                                <div class="pt-1">
                                    <span class="font-semibold text-gray-500 block mb-0.5">Alamat Pengambilan:</span>
                                    <p class="text-gray-800 font-medium">{{ $donation->pickup_address }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Ucapan Terima Kasih -->
                        <div class="pt-4 border-t border-sage/20 space-y-3">
                            @if($donation->thankYou)
                                <div class="bg-emerald-50 p-3 rounded-xl border border-emerald-200 text-xs text-emerald-900 space-y-1">
                                    <span class="font-bold block">💌 Ucapan Terima Kasih Terkirim:</span>
                                    <p class="italic">"{{ $donation->thankYou->message }}"</p>
                                </div>
                            @else
                                <form action="{{ route('penerima.thankyou.store') }}" method="POST" class="space-y-2">
                                    @csrf
                                    <input type="hidden" name="donation_id" value="{{ $donation->id }}">
                                    <label class="block text-xs font-bold text-forest uppercase tracking-wider">
                                        Kirim Ucapan Terima Kasih kepada Pendonasi:
                                    </label>
                                    <textarea name="message" rows="2" required
                                              class="w-full px-3 py-2 rounded-xl border border-gray-300 text-xs focus:outline-none focus:ring-2 focus:ring-forest bg-white"
                                              placeholder="Tulis pesan apresiasi untuk usaha pendonasi..."></textarea>
                                    <button type="submit"
                                            class="w-full min-h-[44px] px-4 py-2 bg-sage hover:bg-sage-600 text-white font-bold text-xs rounded-xl transition">
                                        Kirim Ucapan Terima Kasih
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pt-4">
                {{ $claimedDonations->links() }}
            </div>
        @else
            <div class="text-center py-10 text-gray-500 space-y-3">
                <p class="text-sm">Lembaga Anda belum memiliki donasi yang diklaim.</p>
                <a href="{{ route('donations.index') }}" class="inline-flex min-h-[44px] px-5 py-2.5 bg-forest text-white font-bold text-xs rounded-xl hover:bg-forest-800">
                    Cari Donasi Pangan Sekarang
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
