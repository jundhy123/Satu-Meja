@extends('layouts.app')

@section('title', 'Cari Donasi Pangan - Satu Meja')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
    <!-- Header Banner -->
    <div class="bg-forest text-white rounded-3xl p-8 shadow-xl flex flex-col md:flex-row md:items-center justify-between gap-6 border border-sage/20">
        <div class="space-y-2">
            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-sage/30 text-sage-200 border border-sage/40">
                Pencarian Pangan Terverifikasi
            </span>
            <h1 class="font-heading text-3xl sm:text-4xl font-extrabold">Cari Donasi Pangan Layak Konsumsi</h1>
            <p class="text-xs sm:text-sm text-sage-100 max-w-2xl">
                Temukan makanan berlebih dari pelaku usaha pangan terpercaya di sekitarmu. Hanya makanan aktif sebelum batas waktu kedaluwarsa yang ditampilkan.
            </p>
        </div>

        <div class="flex items-center gap-2 bg-forest-800/80 px-4 py-2 rounded-2xl border border-sage/30 text-xs text-sage-200">
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
            <span>Pengecekan Otomatis 15 Detik</span>
        </div>
    </div>

    <!-- Alerts -->
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

    <!-- Filter Bar -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-sage/20">
        <form action="{{ route('donations.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-4 items-end">
            <div>
                <label for="food_type" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                    Jenis Makanan
                </label>
                <select id="food_type" name="food_type" class="w-full min-h-[44px] px-3 py-2 rounded-xl border border-gray-300 text-xs font-semibold text-gray-800 bg-white">
                    <option value="">-- Semua Jenis Makanan --</option>
                    <option value="Makanan Berat" {{ request('food_type') === 'Makanan Berat' ? 'selected' : '' }}>Makanan Berat</option>
                    <option value="Roti & Kue" {{ request('food_type') === 'Roti & Kue' ? 'selected' : '' }}>Roti & Pastry</option>
                    <option value="Bahan Mentah" {{ request('food_type') === 'Bahan Mentah' ? 'selected' : '' }}>Bahan Mentah</option>
                    <option value="Minuman" {{ request('food_type') === 'Minuman' ? 'selected' : '' }}>Minuman</option>
                    <option value="Lainnya" {{ request('food_type') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            <div>
                <label for="location" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                    Lokasi / Area
                </label>
                <input id="location" name="location" type="text" value="{{ request('location') }}"
                       class="w-full min-h-[44px] px-3 py-2 rounded-xl border border-gray-300 text-xs text-gray-800"
                       placeholder="Cari lokasi...">
            </div>

            <div>
                <label for="deadline_filter" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                    Masa Layak Konsumsi
                </label>
                <select id="deadline_filter" name="deadline_filter" class="w-full min-h-[44px] px-3 py-2 rounded-xl border border-gray-300 text-xs font-semibold text-gray-800 bg-white">
                    <option value="">-- Semua Batas Waktu --</option>
                    <option value="urgent" {{ request('deadline_filter') === 'urgent' ? 'selected' : '' }}>Segera Kedaluwarsa (< 48 Jam)</option>
                    <option value="today" {{ request('deadline_filter') === 'today' ? 'selected' : '' }}>Hari Ini</option>
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit"
                        class="flex-1 min-h-[44px] px-4 py-2.5 bg-forest hover:bg-forest-800 text-white font-bold text-xs rounded-xl transition">
                    Terapkan Filter
                </button>
                <a href="{{ route('donations.index') }}"
                   class="min-h-[44px] px-4 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold text-xs rounded-xl transition flex items-center justify-center">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Grid Kartu Donasi -->
    @if($donations->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="donation-grid">
            @foreach($donations as $donation)
                @php $st = $donation->computed_status; @endphp
                <div class="bg-white rounded-3xl p-6 border border-sage/20 shadow-sm flex flex-col justify-between hover:shadow-md transition space-y-4">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-sage-100 text-forest border border-sage/30">
                                {{ $donation->food_type }}
                            </span>
                            @if($st === 'urgent')
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-100 text-amber-800 border border-amber-200 animate-pulse">
                                    ⚠️ Segera Kedaluwarsa
                                </span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    Tersedia
                                </span>
                            @endif
                        </div>

                        <h2 class="font-heading text-xl font-bold text-gray-900 leading-snug">
                            {{ $donation->title }}
                        </h2>

                        <p class="text-xs text-gray-600 line-clamp-3">
                            {{ $donation->description ?? 'Tidak ada deskripsi tambahan.' }}
                        </p>

                        <!-- Detail Information -->
                        <div class="bg-page p-3.5 rounded-2xl space-y-2 text-xs border border-sage/15">
                            <div class="flex justify-between border-b border-sage/15 pb-1">
                                <span class="text-gray-500 font-semibold">Usaha Pendonasi:</span>
                                <span class="font-bold text-forest">{{ $donation->donor->institution_name ?? $donation->donor->name ?? 'Pendonasi' }}</span>
                            </div>
                            <div class="flex justify-between border-b border-sage/15 pb-1">
                                <span class="text-gray-500 font-semibold">Jumlah Porsi:</span>
                                <span class="font-bold text-gray-900">{{ $donation->quantity }}</span>
                            </div>
                            <div class="flex justify-between border-b border-sage/15 pb-1">
                                <span class="text-gray-500 font-semibold">Metode Penyerahan:</span>
                                <span class="font-semibold text-gray-800">{{ $donation->delivery_method }}</span>
                            </div>
                            <div class="flex justify-between border-b border-sage/15 pb-1">
                                <span class="text-gray-500 font-semibold">Lokasi Pengambilan:</span>
                                <span class="font-semibold text-gray-800">{{ $donation->location }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 font-semibold">Batas Layak Konsumsi:</span>
                                <span class="font-mono text-forest font-bold">
                                    {{ \Carbon\Carbon::parse($donation->deadline)->format('d M Y H:i') }}
                                </span>
                            </div>
                        </div>

                        <!-- Notes (Allergen & Storage) -->
                        @if($donation->allergen_notes || $donation->storage_notes)
                            <div class="text-[11px] text-gray-500 space-y-1 bg-amber-50/50 p-3 rounded-xl border border-amber-100">
                                @if($donation->allergen_notes)
                                    <p><strong>Alergen:</strong> {{ $donation->allergen_notes }}</p>
                                @endif
                                @if($donation->storage_notes)
                                    <p><strong>Penyimpanan:</strong> {{ $donation->storage_notes }}</p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Action Claim Button -->
                    <div class="pt-2">
                        @auth
                            @if(auth()->user()->isPenerima())
                                @if(auth()->user()->status === 'verified')
                                    <form id="claim-form-{{ $donation->id }}" action="{{ route('penerima.donations.claim', $donation->id) }}" method="POST">
                                        @csrf
                                        <button type="button"
                                                onclick="showConfirmModal({
                                                    title: 'Konfirmasi Klaim Donasi Pangan',
                                                    message: 'Apakah Anda yakin ingin mengklaim paket donasi {{ addslashes($donation->title) }}? Lembaga Anda akan dicatat sebagai penerima resmi.',
                                                    icon: '🍲',
                                                    confirmText: 'Ya, Klaim Sekarang',
                                                    cancelText: 'Batal',
                                                    confirmBtnClass: 'bg-forest hover:bg-forest-800 text-white',
                                                    onConfirm: () => document.getElementById('claim-form-{{ $donation->id }}').submit()
                                                })"
                                                class="w-full min-h-[48px] px-6 py-3 inline-flex items-center justify-center bg-forest hover:bg-forest-800 text-white font-bold text-sm rounded-xl shadow-md transition focus:outline-none focus:ring-2 focus:ring-forest">
                                            Klaim Donasi Pangan Ini
                                        </button>
                                    </form>
                                @else
                                    <button disabled
                                            class="w-full min-h-[48px] px-6 py-3 inline-flex items-center justify-center bg-amber-100 text-amber-800 font-bold text-xs rounded-xl cursor-not-allowed border border-amber-300">
                                        🔒 Klaim Terkunci (Akun Menunggu Verifikasi Admin)
                                    </button>
                                @endif
                            @else
                                <div class="text-center p-3 bg-gray-100 rounded-xl text-xs text-gray-600 font-semibold">
                                    Hanya akun Penerima yang diperbolehkan mengklaim
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                               class="w-full min-h-[48px] px-6 py-3 inline-flex items-center justify-center bg-white border border-sage/40 text-forest font-bold text-sm rounded-xl hover:bg-sage-100 transition">
                                Masuk Portal untuk Mengklaim
                            </a>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pt-6">
            {{ $donations->links() }}
        </div>
    @else
        <div class="bg-white rounded-3xl p-12 text-center border border-sage/20 space-y-4 max-w-2xl mx-auto">
            <div class="w-16 h-16 rounded-2xl bg-forest-50 text-forest flex items-center justify-center text-3xl mx-auto">
                🔍
            </div>
            <h3 class="font-heading text-2xl font-bold text-forest">Tidak Ada Donasi Aktif Sesuai Kriteria</h3>
            <p class="text-xs text-gray-600">
                Belum ada donasi makanan berlebih yang tersedia atau telah melewati batas waktu layak konsumsi. Silakan coba atur ulang filter pencarian Anda.
            </p>
            <a href="{{ route('donations.index') }}" class="inline-flex min-h-[44px] px-6 py-2.5 bg-forest text-white font-bold text-xs rounded-xl">
                Reset Filter Pencarian
            </a>
        </div>
    @endif
</div>

<!-- 15-Second Automatic Polling Script -->
<script>
    setInterval(function() {
        fetch("{{ route('donations.json') }}")
            .then(response => response.json())
            .then(data => {
                console.log('Automated 15s check:', data.count, 'active donations');
            })
            .catch(err => console.error('Polling error:', err));
    }, 15000);
</script>
@endsection
