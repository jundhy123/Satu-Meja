@extends('layouts.app')

@section('title', 'Bagikan Pangan Berlebih - Satu Meja')

@section('content')
<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white p-8 sm:p-10 rounded-3xl shadow-xl border border-sage/20 space-y-8">
        <!-- Header -->
        <div class="text-center space-y-2">
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-sage-100 text-forest border border-sage/30">
                Formulir Bagikan Pangan
            </span>
            <h1 class="font-heading text-3xl font-extrabold text-forest">
                Publikasi Paket Donasi Pangan
            </h1>
            <p class="text-xs text-gray-600 max-w-md mx-auto">
                Isi rincian makanan berlebih secara akurat. Sistem akan menghitung sisa masa layak konsumsi dan memantau status secara berkala.
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form class="space-y-6" action="{{ route('pendonasi.donations.store') }}" method="POST">
            @csrf

            <!-- Title & Food Type -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="title" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Judul Paket Makanan <span class="text-red-500">*</span>
                    </label>
                    <input id="title" name="title" type="text" required value="{{ old('title') }}"
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                           placeholder="Contoh: 30 Porsi Nasi Kotak Ayam Bakar">
                </div>

                <div>
                    <label for="food_type" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Jenis Makanan <span class="text-red-500">*</span>
                    </label>
                    <select id="food_type" name="food_type" required
                            class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest bg-white">
                        <option value="">-- Pilih Jenis --</option>
                        <option value="Makanan Berat" {{ old('food_type') === 'Makanan Berat' ? 'selected' : '' }}>Makanan Berat (Nasi/Lauk/Sop)</option>
                        <option value="Roti & Kue" {{ old('food_type') === 'Roti & Kue' ? 'selected' : '' }}>Roti & Pastry</option>
                        <option value="Bahan Mentah" {{ old('food_type') === 'Bahan Mentah' ? 'selected' : '' }}>Bahan Mentah (Beras/Sayur/Buah)</option>
                        <option value="Minuman" {{ old('food_type') === 'Minuman' ? 'selected' : '' }}>Minuman</option>
                        <option value="Lainnya" {{ old('food_type') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
            </div>

            <!-- Quantity, Delivery Method & Deadline -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="quantity" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Jumlah / Porsi <span class="text-red-500">*</span>
                    </label>
                    <input id="quantity" name="quantity" type="text" required value="{{ old('quantity') }}"
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                           placeholder="Contoh: 50 Porsi / 10 Kg">
                </div>

                <div>
                    <label for="delivery_method" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Metode Penyerahan <span class="text-red-500">*</span>
                    </label>
                    <select id="delivery_method" name="delivery_method" required
                            class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest bg-white">
                        <option value="Ambil Sendiri" {{ old('delivery_method') === 'Ambil Sendiri' ? 'selected' : '' }}>Ambil Sendiri di Lokasi</option>
                        <option value="Diantar Pendonasi" {{ old('delivery_method') === 'Diantar Pendonasi' ? 'selected' : '' }}>Diantar oleh Pendonasi</option>
                    </select>
                </div>

                <div>
                    <label for="deadline" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Batas Layak Konsumsi <span class="text-red-500">*</span>
                    </label>
                    <input id="deadline" name="deadline" type="datetime-local" required value="{{ old('deadline') }}"
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest">
                </div>
            </div>

            <!-- Location & Address -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="location" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Kota / Area Lokasi <span class="text-red-500">*</span>
                    </label>
                    <input id="location" name="location" type="text" required value="{{ old('location', $user->address ?? '') }}"
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                           placeholder="Contoh: Laguboti, Toba">
                </div>

                <div>
                    <label for="pickup_address" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Alamat Pengambilan Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input id="pickup_address" name="pickup_address" type="text" required value="{{ old('pickup_address', $user->address ?? '') }}"
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                           placeholder="Jalan, nomor, patokan gedung">
                </div>
            </div>

            <!-- PIC Name & Contact -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="pic_name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Nama PIC Penanggung Jawab <span class="text-red-500">*</span>
                    </label>
                    <input id="pic_name" name="pic_name" type="text" required value="{{ old('pic_name', $user->pic_name ?? $user->name) }}"
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest">
                </div>

                <div>
                    <label for="pic_contact" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        No. Telepon / WhatsApp PIC <span class="text-red-500">*</span>
                    </label>
                    <input id="pic_contact" name="pic_contact" type="text" required value="{{ old('pic_contact', $user->phone ?? '') }}"
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest">
                </div>
            </div>

            <!-- Descriptions & Allergen / Storage Notes -->
            <div>
                <label for="description" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                    Deskripsi Makanan
                </label>
                <textarea id="description" name="description" rows="2"
                          class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                          placeholder="Jelaskan kondisi makanan, kebersihan, kemasan">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="allergen_notes" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Catatan Alergen / Halal
                    </label>
                    <input id="allergen_notes" name="allergen_notes" type="text" value="{{ old('allergen_notes') }}"
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                           placeholder="Contoh: Mengandung kacang, Bebas babi">
                </div>

                <div>
                    <label for="storage_notes" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Catatan Penyimpanan
                    </label>
                    <input id="storage_notes" name="storage_notes" type="text" value="{{ old('storage_notes') }}"
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                           placeholder="Contoh: Hangatkan sebelum dikonsumsi">
                </div>
            </div>

            <div class="pt-4 flex gap-4">
                <a href="{{ route('pendonasi.dashboard') }}"
                   class="w-1/3 min-h-[48px] px-6 py-3.5 inline-flex items-center justify-center text-sm font-bold text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-xl transition">
                    Batal
                </a>
                <button type="submit"
                        class="w-2/3 min-h-[48px] px-6 py-3.5 inline-flex items-center justify-center text-sm font-bold text-white bg-forest hover:bg-forest-800 rounded-xl shadow-md transition">
                    Publikasikan Paket Donasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
