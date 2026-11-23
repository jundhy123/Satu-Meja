@extends('layouts.app')

@section('title', 'Cari Donasi Makanan - Satu Meja')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Header Halaman --}}
    <div class="mb-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
            Cari Donasi Makanan
        </h1>
        <p class="mt-2 text-base text-gray-700">
            Temukan makanan layak konsumsi di sekitarmu sebelum batas waktu pengambilan berakhir.
        </p>
    </div>

    {{-- Notifikasi Sukses / Error setelah menekan Klaim --}}
    @if (session('success'))
        <div role="alert" class="mb-6 p-4 rounded-lg bg-emerald-100 border border-emerald-400 text-emerald-900 font-medium">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div role="alert" class="mb-6 p-4 rounded-lg bg-red-100 border border-red-400 text-red-900 font-medium">
            {{ session('error') }}
        </div>
    @endif

    {{-- Form Filter Pencarian --}}
    <section aria-labelledby="filter-heading" class="bg-white p-5 sm:p-6 rounded-xl shadow-sm border border-gray-200 mb-8">
        <h2 id="filter-heading" class="text-lg font-semibold text-gray-900 mb-4">
            Filter Donasi
        </h2>

        <form method="GET" action="{{ route('donations.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            {{-- Filter Jenis Makanan --}}
            <div>
                <label for="food_type" class="block text-sm font-semibold text-gray-900 mb-1.5">
                    Jenis Makanan
                </label>
                <select id="food_type" name="food_type"
                    class="w-full min-h-[44px] px-3 py-2 rounded-lg border border-gray-400 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-700">
                    <option value="">Semua Jenis</option>
                    <option value="Makanan Berat" {{ request('food_type') == 'Makanan Berat' ? 'selected' : '' }}>Makanan Berat</option>
                    <option value="Makanan Ringan" {{ request('food_type') == 'Makanan Ringan' ? 'selected' : '' }}>Makanan Ringan</option>
                    <option value="Roti & Kue" {{ request('food_type') == 'Roti & Kue' ? 'selected' : '' }}>Roti & Kue</option>
                    <option value="Bahan Makanan" {{ request('food_type') == 'Bahan Makanan' ? 'selected' : '' }}>Bahan Makanan</option>
                </select>
            </div>

            {{-- Filter Lokasi --}}
            <div>
                <label for="location" class="block text-sm font-semibold text-gray-900 mb-1.5">
                    Lokasi / Area
                </label>
                <input type="text" id="location" name="location" value="{{ request('location') }}"
                    placeholder="Contoh: Bandung, Tebet..."
                    class="w-full min-h-[44px] px-3 py-2 rounded-lg border border-gray-400 bg-white text-gray-900 placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-emerald-700">
            </div>

            {{-- Filter Batas Waktu --}}
            <div>
                <label for="deadline" class="block text-sm font-semibold text-gray-900 mb-1.5">
                    Batas Waktu Maksimal
                </label>
                <input type="date" id="deadline" name="deadline" value="{{ request('deadline') }}"
                    class="w-full min-h-[44px] px-3 py-2 rounded-lg border border-gray-400 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-700">
            </div>

            {{-- Tombol Aksi Filter (Minimal 44px) --}}
            <div class="flex gap-2">
                <button type="submit"
                    class="flex-1 min-h-[44px] min-w-[44px] px-4 py-2 bg-emerald-800 hover:bg-emerald-900 text-white font-semibold rounded-lg transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-800 cursor-pointer">
                    Terapkan Filter
                </button>
                <a href="{{ route('donations.index') }}"
                    class="min-h-[44px] min-w-[44px] px-4 py-2 inline-flex items-center justify-center bg-gray-200 hover:bg-gray-300 text-gray-900 font-semibold rounded-lg transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-600">
                    Reset
                </a>
            </div>
        </form>
    </section>

    {{-- Daftar Kartu Donasi --}}
    <section aria-label="Daftar Donasi Tersedia">
        @if ($donations->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($donations as $donation)
                    @php
                        $deadline = \Carbon\Carbon::parse($donation->deadline);
                        $isExpired = $deadline->isPast() && $donation->status === 'available';
                    @endphp

                    <article class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex flex-col justify-between">
                        <div>
                            {{-- Baris Atas: Jenis Makanan & Badge Penanda Status --}}
                            <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                                <span class="text-xs font-bold uppercase tracking-wider px-2.5 py-1 rounded bg-gray-100 text-gray-900 border border-gray-300">
                                    {{ $donation->food_type }}
                                </span>

                                @if ($isExpired || $donation->status === 'expired')
                                    <span class="text-xs font-bold px-3 py-1 rounded-full bg-red-100 text-red-900 border border-red-300">
                                        Kedaluwarsa
                                    </span>
                                @elseif ($donation->status === 'available')
                                    <span class="text-xs font-bold px-3 py-1 rounded-full bg-emerald-100 text-emerald-900 border border-emerald-300">
                                        Tersedia
                                    </span>
                                @else
                                    <span class="text-xs font-bold px-3 py-1 rounded-full bg-amber-100 text-amber-900 border border-amber-300">
                                        Sudah Diklaim
                                    </span>
                                @endif
                            </div>

                            {{-- Judul Donasi --}}
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                {{ $donation->title }}
                            </h3>

                            @if (!empty($donation->description))
                                <p class="text-sm text-gray-700 mb-4 line-clamp-2">
                                    {{ $donation->description }}
                                </p>
                            @endif

                            {{-- Informasi Lokasi & Batas Waktu --}}
                            <dl class="space-y-1.5 text-sm text-gray-800 mb-5">
                                <div class="flex items-start gap-2">
                                    <dt class="font-semibold text-gray-900 min-w-[95px]">Lokasi:</dt>
                                    <dd>{{ $donation->location }}</dd>
                                </div>
                                <div class="flex items-start gap-2">
                                    <dt class="font-semibold text-gray-900 min-w-[95px]">Batas Waktu:</dt>
                                    <dd>{{ $deadline->translatedFormat('d M Y, H:i') }} WIB</dd>
                                </div>
                                @if (!empty($donation->quantity))
                                    <div class="flex items-start gap-2">
                                        <dt class="font-semibold text-gray-900 min-w-[95px]">Porsi/Jumlah:</dt>
                                        <dd>{{ $donation->quantity }}</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>

                        {{-- Area Tombol Aksi Klaim (Langkah 4) --}}
                        <div class="pt-4 border-t border-gray-200">
                            @if ($donation->status === 'available' && !$isExpired)
                                @guest
                                    {{-- Keadaan sebelum login --}}
                                    <a href="{{ route('login') }}"
                                        class="w-full min-h-[44px] min-w-[44px] px-4 py-2 inline-flex items-center justify-center bg-gray-900 hover:bg-gray-800 text-white font-semibold rounded-lg transition">
                                        Login untuk Mengklaim
                                    </a>
                                @else
                                    @if (auth()->user()->role === 'penerima' && auth()->user()->is_verified)
                                        <form method="POST" action="{{ route('donations.claim', $donation->id) }}"
                                              onsubmit="return confirm('Yakin ingin mengklaim donasi ini?');">
                                            @csrf
                                            <button type="submit"
                                                class="w-full min-h-[44px] min-w-[44px] px-4 py-2 bg-emerald-800 hover:bg-emerald-900 text-white font-semibold rounded-lg transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-800 cursor-pointer">
                                                Klaim Donasi
                                            </button>
                                        </form>
                                    @elseif (auth()->user()->role === 'penerima' && !auth()->user()->is_verified)
                                        <p class="min-h-[44px] flex items-center justify-center text-center text-sm font-medium text-amber-900 bg-amber-50 border border-amber-300 rounded-lg px-3 py-2">
                                            Akun menunggu verifikasi untuk klaim
                                        </p>
                                    @else
                                        <p class="min-h-[44px] flex items-center justify-center text-center text-sm font-medium text-gray-700 bg-gray-100 rounded-lg px-3 py-2">
                                            Khusus akun Penerima terverifikasi
                                        </p>
                                    @endif
                                @endguest
                            @else
                                <button type="button" disabled
                                    class="w-full min-h-[44px] min-w-[44px] px-4 py-2 bg-gray-300 text-gray-700 font-semibold rounded-lg cursor-not-allowed">
                                    Tidak Dapat Diklaim
                                </button>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $donations->links() }}
            </div>
        @else
            {{-- Keadaan Kosong (Empty State) --}}
            <div class="bg-white rounded-xl border border-gray-200 p-10 text-center">
                <h3 class="text-lg font-bold text-gray-900 mb-2">
                    Belum ada donasi yang sesuai
                </h3>
                <p class="text-gray-700 mb-6">
                    Coba ubah atau reset filter pencarian kamu untuk melihat donasi makanan lainnya.
                </p>
                <a href="{{ route('donations.index') }}"
                    class="min-h-[44px] min-w-[44px] px-6 py-2.5 inline-flex items-center justify-center bg-emerald-800 hover:bg-emerald-900 text-white font-semibold rounded-lg transition">
                    Lihat Semua Donasi
                </a>
            </div>
        @endif
    </section>

</div>
@endsection