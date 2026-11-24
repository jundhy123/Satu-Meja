@extends('layouts.app')

@section('title', 'Dasbor Pendonasi - Satu Meja')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
    <!-- Header Banner -->
    <div class="bg-forest text-white rounded-3xl p-8 shadow-xl flex flex-col md:flex-row md:items-center justify-between gap-6 border border-sage/20">
        <div class="space-y-2">
            <div class="flex items-center gap-3">
                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-sage/30 text-sage-200 border border-sage/40">
                    Ruang Kerja Pendonasi
                </span>
                @if($user->status === 'verified')
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-200 border border-emerald-400/30">
                        ✓ Akun Terverifikasi
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
                PIC: {{ $user->pic_name ?? '-' }} • Telepon: {{ $user->phone ?? '-' }} • {{ $user->address ?? '' }}
            </p>
        </div>

        <div>
            @if($user->status === 'verified')
                <a href="{{ route('pendonasi.donations.create') }}"
                   class="min-h-[48px] px-6 py-3.5 inline-flex items-center justify-center bg-white text-forest hover:bg-sage-100 font-bold text-sm rounded-xl shadow-md transition">
                    + Bagikan Pangan Berlebih
                </a>
            @else
                <button disabled
                        class="min-h-[48px] px-6 py-3.5 inline-flex items-center justify-center bg-gray-400/50 text-white/80 font-bold text-sm rounded-xl cursor-not-allowed">
                    🔒 Fitur Terkunci (Menunggu Verifikasi)
                </button>
            @endif
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
                ⚠️ Status Akun: Menunggu Verifikasi Admin
            </h3>
            <p class="text-xs leading-relaxed text-amber-800">
                Sesuai protokol keamanan pangan platform Satu Meja, 100% akun Pendonasi dan Penerima harus melewati verifikasi Admin sebelum dapat mempublikasikan donasi. Silakan tunggu konfirmasi dari Admin.
            </p>
        </div>
    @endif

    <!-- Daftar Donasi Milik Pendonasi -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-sage/20 space-y-6">
        <div class="flex items-center justify-between border-b border-gray-100 pb-4">
            <h2 class="font-heading text-xl font-bold text-forest">Daftar Donasi Pangan Anda</h2>
            <span class="text-xs text-gray-500 font-medium">Total: {{ $donations->total() }} Donasi</span>
        </div>

        @if($donations->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-700">
                    <thead class="bg-page text-forest font-heading text-xs uppercase tracking-wider border-b border-sage/20">
                        <tr>
                            <th class="px-4 py-3 rounded-l-xl">Paket Donasi</th>
                            <th class="px-4 py-3">Jenis & Porsi</th>
                            <th class="px-4 py-3">Batas Waktu Layak</th>
                            <th class="px-4 py-3">Status Pangan</th>
                            <th class="px-4 py-3 rounded-r-xl">Data Pengklaim</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($donations as $donation)
                            <tr class="hover:bg-forest-50/30 transition">
                                <td class="px-4 py-4 font-bold text-gray-900">
                                    {{ $donation->title }}
                                    <span class="block text-xs font-normal text-gray-500">{{ $donation->location }}</span>
                                </td>
                                <td class="px-4 py-4 text-xs">
                                    <span class="font-semibold block text-forest">{{ $donation->food_type }}</span>
                                    <span class="text-gray-500">{{ $donation->quantity }}</span>
                                </td>
                                <td class="px-4 py-4 text-xs font-mono">
                                    {{ \Carbon\Carbon::parse($donation->deadline)->format('d M Y H:i') }}
                                </td>
                                <td class="px-4 py-4 text-xs">
                                    @php $st = $donation->computed_status; @endphp
                                    @if($st === 'claimed')
                                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 border border-blue-200">
                                            ✓ Sudah Diklaim
                                        </span>
                                    @elseif($st === 'expired')
                                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-700 border border-gray-300">
                                            ✕ Kedaluwarsa
                                        </span>
                                    @elseif($st === 'urgent')
                                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200 animate-pulse">
                                            ⚠️ Segera Kedaluwarsa
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                            Tersedia
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-xs">
                                    @if($donation->claimedBy)
                                        <div class="bg-forest-50/80 p-2.5 rounded-xl border border-sage/20 space-y-1">
                                            <span class="font-bold text-forest block">{{ $donation->claimedBy->institution_name ?? $donation->claimedBy->name }}</span>
                                            <span class="text-gray-600 block">PIC: {{ $donation->claimedBy->pic_name ?? '-' }}</span>
                                            <span class="text-emerald-800 font-semibold block">WA/Telp: {{ $donation->claimedBy->phone ?? '-' }}</span>
                                        </div>
                                    @else
                                        <span class="text-gray-400 italic">Belum diklaim</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pt-4">
                {{ $donations->links() }}
            </div>
        @else
            <div class="text-center py-10 text-gray-500 space-y-3">
                <p class="text-sm">Anda belum memiliki riwayat donasi pangan.</p>
                @if($user->status === 'verified')
                    <a href="{{ route('pendonasi.donations.create') }}" class="inline-flex min-h-[44px] px-5 py-2.5 bg-forest text-white font-bold text-xs rounded-xl hover:bg-forest-800">
                        Mulai Publikasikan Donasi
                    </a>
                @endif
            </div>
        @endif
    </div>

    <!-- Feedback & Ucapan Terima Kasih Diterima -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-sage/20 space-y-4">
        <h2 class="font-heading text-xl font-bold text-forest flex items-center gap-2">
            💌 Ucapan Terima Kasih dari Lembaga Penerima
        </h2>
        @if(isset($thankYous) && $thankYous->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($thankYous as $thanks)
                    <div class="bg-page p-5 rounded-2xl border border-sage/20 space-y-2">
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-bold text-forest">{{ $thanks->sender->institution_name ?? $thanks->sender->name }}</span>
                            <span class="text-gray-400">{{ $thanks->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-xs text-gray-700 italic">"{{ $thanks->message }}"</p>
                        <span class="text-[11px] text-gray-500 block pt-1 border-t border-sage/20">
                            Donasi: {{ $thanks->donation->title ?? '-' }}
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-xs text-gray-500 italic">Belum ada ucapan terima kasih yang diterima.</p>
        @endif
    </div>
</div>
@endsection
