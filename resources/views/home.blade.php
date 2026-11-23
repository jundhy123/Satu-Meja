@extends('layouts.app')

@section('title', 'Beranda - Satu Meja')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
    <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 sm:p-12 text-center">
        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-emerald-100 text-emerald-900 mb-4">
            Platform Berbagi Makanan Layak Konsumsi
        </span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-4">
            Selamat Datang di Satu Meja
        </h1>
        <p class="max-w-2xl mx-auto text-base sm:text-lg text-gray-700 mb-8">
            Temukan donasi makanan berlebih dari donatur terpercaya di sekitarmu atau salurkan makanan agar tidak terbuang sia-sia.
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('donations.index') }}"
                class="w-full sm:w-auto min-h-[44px] min-w-[44px] px-6 py-3 inline-flex items-center justify-center bg-emerald-800 hover:bg-emerald-900 text-white font-semibold rounded-lg transition">
                Cari Donasi Sekarang
            </a>

            @guest
                <a href="{{ route('login') }}"
                    class="w-full sm:w-auto min-h-[44px] min-w-[44px] px-6 py-3 inline-flex items-center justify-center bg-gray-200 hover:bg-gray-300 text-gray-900 font-semibold rounded-lg transition">
                    Masuk sebagai Penerima
                </a>
            @endguest
        </div>
    </section>
</div>
@endsection