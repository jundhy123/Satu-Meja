@extends('layouts.app')

@section('title', 'Cari Donasi Pangan - Satu Meja')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
    <!-- Header Banner (Diperkecil padding-nya) -->
    <div class="bg-forest text-white rounded-2xl p-6 sm:p-8 shadow-lg flex flex-col md:flex-row md:items-center justify-between gap-4 border border-sage/20 relative overflow-hidden">
        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-48 h-48 bg-sage/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="space-y-2 relative z-10">
            <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-sage/30 text-sage-200 border border-sage/40">
                Pencarian Pangan Terverifikasi
            </span>
            <h1 class="font-heading text-2xl sm:text-3xl font-extrabold tracking-tight">Cari Donasi Pangan Layak Konsumsi</h1>
            <p class="text-xs sm:text-sm text-sage-100 max-w-2xl leading-relaxed">
                Temukan makanan berlebih dari pelaku usaha pangan terpercaya di sekitarmu.
            </p>
        </div>

        <div class="flex items-center gap-2 bg-forest-800/80 backdrop-blur-sm px-4 py-2 rounded-xl border border-sage/30 text-[11px] sm:text-xs text-sage-200 self-start md:self-auto shrink-0 relative z-10 shadow-inner">
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse shadow-[0_0_8px_rgba(52,211,153,0.8)]"></span>
            <span class="font-medium">Pengecekan Otomatis 15 Detik</span>
        </div>
    </div>

    <!-- Alerts -->
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

    <!-- Filter Bar (Lebih ringkas) -->
    <div class="bg-white rounded-2xl p-4 sm:p-5 shadow-sm border border-sage/20">
        <form action="{{ route('donations.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
            <div class="space-y-1">
                <label for="food_type" class="block text-[10px] font-bold text-gray-600 uppercase tracking-wider">
                    Jenis Makanan
                </label>
                <select id="food_type" name="food_type" class="w-full min-h-[40px] px-3 py-2 rounded-lg border border-gray-200 text-xs font-medium text-gray-800 bg-gray-50/50 hover:bg-white focus:bg-white focus:ring-2 focus:ring-forest/20 focus:border-forest transition-colors cursor-pointer">
                    <option value="">-- Semua Jenis Makanan --</option>
                    <option value="Makanan Berat" {{ request('food_type') === 'Makanan Berat' ? 'selected' : '' }}>Makanan Berat</option>
                    <option value="Roti & Kue" {{ request('food_type') === 'Roti & Kue' ? 'selected' : '' }}>Roti & Pastry</option>
                    <option value="Bahan Mentah" {{ request('food_type') === 'Bahan Mentah' ? 'selected' : '' }}>Bahan Mentah</option>
                    <option value="Minuman" {{ request('food_type') === 'Minuman' ? 'selected' : '' }}>Minuman</option>
                    <option value="Lainnya" {{ request('food_type') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            <div class="space-y-1">
                <label for="location" class="block text-[10px] font-bold text-gray-600 uppercase tracking-wider">
                    Lokasi / Area
                </label>
                <input id="location" name="location" type="text" value="{{ request('location') }}"
                       class="w-full min-h-[40px] px-3 py-2 rounded-lg border border-gray-200 text-xs font-medium text-gray-800 bg-gray-50/50 hover:bg-white focus:bg-white focus:ring-2 focus:ring-forest/20 focus:border-forest transition-colors"
                       placeholder="Cari lokasi...">
            </div>

            <div class="space-y-1">
                <label for="deadline_filter" class="block text-[10px] font-bold text-gray-600 uppercase tracking-wider">
                    Masa Layak Konsumsi
                </label>
                <select id="deadline_filter" name="deadline_filter" class="w-full min-h-[40px] px-3 py-2 rounded-lg border border-gray-200 text-xs font-medium text-gray-800 bg-gray-50/50 hover:bg-white focus:bg-white focus:ring-2 focus:ring-forest/20 focus:border-forest transition-colors cursor-pointer">
                    <option value="">-- Semua Batas Waktu --</option>
                    <option value="urgent" {{ request('deadline_filter') === 'urgent' ? 'selected' : '' }}>Segera Kedaluwarsa (&lt; 48 Jam)</option>
                    <option value="today" {{ request('deadline_filter') === 'today' ? 'selected' : '' }}>Hari Ini</option>
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit"
                        class="flex-1 min-h-[40px] px-3 py-2 bg-forest hover:bg-forest-800 text-white font-bold text-xs rounded-lg shadow-sm transition-all focus:ring-2 focus:ring-forest focus:ring-offset-2">
                    Terapkan
                </button>
                <a href="{{ route('donations.index') }}"
                   class="min-h-[40px] px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-xs rounded-lg transition-colors flex items-center justify-center border border-gray-200">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Grid Kartu Donasi (Diperkecil & Dirapatkan) -->
    @if($donations->count() > 0)
        <!-- Menggunakan grid-cols-2 pada mobile, dan grid-cols-3/4 pada layar besar -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 lg:gap-5" id="donation-grid">
            @foreach($donations as $donation)
                @php $st = $donation->computed_status; @endphp
                <div class="bg-white rounded-2xl p-3 sm:p-4 border border-sage/20 shadow-sm flex flex-col justify-between hover:shadow-md transition-all duration-300 group">

                    <div class="space-y-3">
                        <!-- Foto Produk / Placeholder Tanpa Foto -->
                        @if($donation->image_url_formatted)
                            <div class="w-full aspect-square overflow-hidden rounded-xl border border-gray-100 bg-white relative flex items-center justify-center p-1">
                                <img src="{{ $donation->image_url_formatted }}"
                                     alt="Foto {{ $donation->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 rounded-lg">
                            </div>
                        @else
                            <div class="w-full aspect-square rounded-xl border border-sage/20 bg-sage-100/40 flex flex-col items-center justify-center text-forest/60 gap-1">
                                <span class="text-3xl" aria-hidden="true">🍱</span>
                                <span class="text-[10px] font-semibold">Tanpa Foto</span>
                            </div>
                        @endif

                        <!-- Badges (Diperkecil) -->
                        <div class="flex flex-wrap items-center justify-between gap-1.5">
                            <span class="px-2 py-1 rounded-md text-[10px] font-bold bg-sage-100 text-forest border border-sage/30">
                                {{ $donation->food_type }}
                            </span>
                            @if($st === 'urgent')
                                <span class="px-2 py-1 rounded-md text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    Urgent
                                </span>
                            @else
                                <span class="px-2 py-1 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Tersedia
                                </span>
                            @endif
                        </div>

                        <!-- Title & Desc -->
                        <div>
                            <h2 class="font-heading text-sm sm:text-base font-bold text-gray-900 leading-tight line-clamp-2 mb-1 group-hover:text-forest transition-colors">
                                {{ $donation->title }}
                            </h2>
                            <p class="text-[11px] text-gray-500 line-clamp-2 leading-relaxed">
                                {{ $donation->description ?? 'Tidak ada deskripsi.' }}
                            </p>
                        </div>

                        <!-- Detail Information (Diperkecil & Dirapikan) -->
                        <div class="bg-gray-50/80 p-2.5 rounded-xl space-y-1.5 text-[11px] border border-gray-100">
                            <div class="flex justify-between items-start gap-2">
                                <span class="text-gray-500 font-medium shrink-0">Pendonasi</span>
                                <span class="font-bold text-forest text-right truncate">{{ $donation->donor->institution_name ?? $donation->donor->name ?? 'Pendonasi' }}</span>
                            </div>
                            <div class="flex justify-between items-start gap-2">
                                <span class="text-gray-500 font-medium shrink-0">Porsi</span>
                                <span class="font-bold text-gray-900 text-right">{{ $donation->quantity }}</span>
                            </div>
                            <div class="flex justify-between items-start gap-2">
                                <span class="text-gray-500 font-medium shrink-0">Metode</span>
                                <span class="font-semibold text-gray-800 text-right truncate">{{ $donation->delivery_method }}</span>
                            </div>
                            <div class="flex justify-between items-start gap-2">
                                <span class="text-gray-500 font-medium shrink-0">Lokasi</span>
                                <span class="font-semibold text-gray-800 text-right truncate" title="{{ $donation->location }}">{{ $donation->location }}</span>
                            </div>
                            <div class="pt-1.5 mt-1 border-t border-gray-200 flex justify-between items-center gap-2">
                                <span class="text-gray-500 font-bold shrink-0 text-[10px]">Batas Waktu</span>
                                <span class="font-mono text-forest font-bold bg-forest/5 px-1.5 py-0.5 rounded text-[10px]">
                                    {{ \Carbon\Carbon::parse($donation->deadline)->format('d M y H:i') }}
                                </span>
                            </div>
                        </div>

                        <!-- Notes (Allergen & Storage) -->
                        @if($donation->allergen_notes || $donation->storage_notes)
                            <div class="text-[10px] text-gray-600 space-y-1 bg-amber-50/60 p-2 rounded-lg border border-amber-100/80">
                                @if($donation->allergen_notes)
                                    <p class="line-clamp-1"><strong class="text-amber-800">Alergen:</strong> {{ $donation->allergen_notes }}</p>
                                @endif
                                @if($donation->storage_notes)
                                    <p class="line-clamp-1"><strong class="text-amber-800">Simpan:</strong> {{ $donation->storage_notes }}</p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Action Claim Button (Diperkecil) -->
                    <div class="pt-3 mt-auto">
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
                                                class="w-full min-h-[36px] px-4 py-2 inline-flex items-center justify-center bg-forest hover:bg-forest-800 text-white font-bold text-xs rounded-lg shadow-sm hover:shadow transition-all focus:outline-none focus:ring-2 focus:ring-forest focus:ring-offset-1">
                                            Klaim Donasi Ini
                                        </button>
                                    </form>
                                @else
                                    <button disabled
                                            class="w-full min-h-[36px] px-4 py-2 inline-flex items-center justify-center bg-amber-50 text-amber-700 font-bold text-[10px] rounded-lg cursor-not-allowed border border-amber-200 text-center leading-tight">
                                        🔒 Menunggu Verifikasi Admin
                                    </button>
                                @endif
                            @else
                                <div class="text-center p-2 bg-gray-50 border border-gray-200 rounded-lg text-[10px] text-gray-500 font-semibold">
                                    Khusus Akun Penerima
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                               class="w-full min-h-[36px] px-4 py-2 inline-flex items-center justify-center bg-white border-2 border-forest/20 text-forest font-bold text-xs rounded-lg hover:bg-forest/5 hover:border-forest/30 transition-all">
                                Masuk untuk Klaim
                            </a>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pt-6 flex justify-center">
            {{ $donations->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-2xl p-10 text-center border border-sage/20 space-y-4 max-w-xl mx-auto shadow-sm">
            <div class="w-16 h-16 rounded-full bg-sage-50 text-forest flex items-center justify-center text-3xl mx-auto border border-sage/20">
                🔍
            </div>
            <div class="space-y-1">
                <h3 class="font-heading text-xl font-bold text-forest">Tidak Ada Donasi Aktif</h3>
                <p class="text-xs text-gray-500 max-w-sm mx-auto leading-relaxed">
                    Belum ada donasi yang sesuai kriteria atau telah melewati batas waktu. Silakan atur ulang filter Anda.
                </p>
            </div>
            <a href="{{ route('donations.index') }}" class="inline-flex min-h-[40px] px-6 py-2 bg-forest hover:bg-forest-800 text-white font-bold text-xs rounded-lg shadow-sm transition-all">
                Reset Filter
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
