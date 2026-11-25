@extends('layouts.app')

@section('title', 'Profil Akun & Lembaga - Satu Meja')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-8">

    {{-- Header Banner Profil --}}
    <div class="bg-forest text-white rounded-3xl p-6 sm:p-8 shadow-xl border border-forest-800 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
        <div class="space-y-2">
            <div class="flex flex-wrap items-center gap-2">
                <span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-white/15 text-white border border-white/20">
                    Peran: {{ ucfirst($user->role) }}
                </span>

                @if ($user->isVerified())
                    <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-500/20 text-tosca border border-tosca/40">
                        ✓ Akun Terverifikasi
                    </span>
                @elseif ($user->isPending())
                    <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-amber-500/20 text-amber-200 border border-amber-300/40">
                        ⏳ Menunggu Verifikasi Admin
                    </span>
                @else
                    <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-red-500/20 text-red-200 border border-red-300/40">
                        ✕ Akun Ditolak
                    </span>
                @endif
            </div>

            <h1 class="font-heading text-2xl sm:text-3xl font-extrabold tracking-tight">
                {{ $user->org_name }}
            </h1>
            <p class="text-xs text-sage-100">
                PIC: <strong class="text-white">{{ $user->pic }}</strong> • {{ $user->email }} • Kategori: {{ $user->kategori }}
            </p>
        </div>

        <a href="{{ $user->isAdmin() ? route('admin.dashboard') : ($user->isPendonasi() ? route('pendonasi.dashboard') : route('penerima.dashboard')) }}"
           class="min-h-[44px] px-5 py-2.5 rounded-2xl bg-white text-forest hover:bg-sage-100 font-bold text-xs inline-flex items-center justify-center shadow-md transition whitespace-nowrap">
            &larr; Kembali ke Dasbor
        </a>
    </div>

    {{-- Alert Notifikasi --}}
    @if (session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl text-xs font-semibold shadow-sm">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="bg-amber-50 border border-amber-200 text-amber-800 px-5 py-4 rounded-2xl text-xs font-semibold shadow-sm">
            ⚠️ {{ session('warning') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-2xl text-xs space-y-1 shadow-sm">
            <p class="font-bold">Periksa kembali isian formulir:</p>
            @foreach ($errors->all() as $error)
                <p>• {{ $error }}</p>
            @endforeach
        </div>
    @endif

    {{-- Card 1: Informasi Profil & Lembaga --}}
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-lg border border-sage/20 space-y-6">
        <div class="border-b border-gray-100 pb-4">
            <h2 class="font-heading text-xl font-bold text-forest">
                Informasi Profil & Lembaga
            </h2>
            <p class="text-xs text-gray-500 mt-1">
                Lengkapi atau perbarui data instansi, penanggung jawab (PIC), serta alamat lokasi pengambilan/penyaluran pangan.
            </p>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Nama Pengguna / Akun <span class="text-red-500">*</span>
                    </label>
                    <input id="name" name="name" type="text" required value="{{ old('name', $user->name) }}"
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest">
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Alamat Email <span class="text-gray-400 font-normal">(Tidak dapat diubah)</span>
                    </label>
                    <input id="email" type="email" disabled value="{{ $user->email }}"
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-100 text-gray-500 text-sm cursor-not-allowed">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="institution_name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Nama Usaha / Lembaga <span class="text-red-500">*</span>
                    </label>
                    <input id="institution_name" name="institution_name" type="text" required value="{{ old('institution_name', $user->institution_name) }}"
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                           placeholder="Nama resmi usaha atau yayasan">
                </div>

                <div>
                    <label for="category" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select id="category" name="category" required
                            class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest bg-white">
                        @php
                            $categories = ['Restoran', 'Toko Roti', 'Katering', 'Swalayan', 'Panti Asuhan', 'Dapur Umum', 'Yayasan', 'Lainnya'];
                        @endphp
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category', $user->category) === $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="pic_name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Nama Penanggung Jawab (PIC) <span class="text-red-500">*</span>
                    </label>
                    <input id="pic_name" name="pic_name" type="text" required value="{{ old('pic_name', $user->pic_name) }}"
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest">
                </div>

                <div>
                    <label for="phone" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        No. Telepon / WhatsApp <span class="text-red-500">*</span>
                    </label>
                    <input id="phone" name="phone" type="text" required value="{{ old('phone', $user->phone) }}"
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest">
                </div>
            </div>

            <div>
                <label for="address" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                    Alamat Lengkap Lokasi <span class="text-red-500">*</span>
                </label>
                <textarea id="address" name="address" rows="3" required
                          class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest">{{ old('address', $user->address) }}</textarea>
            </div>

            <div>
                <label for="description" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                    Deskripsi Singkat Usaha / Lembaga
                </label>
                <textarea id="description" name="description" rows="3"
                          class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                          placeholder="Tuliskan profil singkat, jam operasional, atau kebutuhan lembaga Anda">{{ old('description', $user->description) }}</textarea>
            </div>

            <div class="pt-2 flex justify-end">
                <button type="submit"
                        class="min-h-[46px] px-6 py-3 rounded-xl bg-forest hover:bg-forest-800 text-white font-bold text-xs shadow-md transition">
                    Simpan Perubahan Profil
                </button>
            </div>
        </form>
    </div>

    {{-- Card 2: Ubah Kata Sandi --}}
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-lg border border-sage/20 space-y-6">
        <div class="border-b border-gray-100 pb-4">
            <h2 class="font-heading text-xl font-bold text-forest">
                Keamanan Kata Sandi
            </h2>
            <p class="text-xs text-gray-500 mt-1">
                Perbarui kata sandi akun Anda secara berkala untuk menjaga keamanan data.
            </p>
        </div>

        <form action="{{ route('profile.password') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="current_password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                    Kata Sandi Saat Ini <span class="text-red-500">*</span>
                </label>
                <input id="current_password" name="current_password" type="password" required
                       class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                       placeholder="Masukkan kata sandi lama">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Kata Sandi Baru <span class="text-red-500">*</span>
                    </label>
                    <input id="password" name="password" type="password" required
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                           placeholder="Minimal 8 karakter">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Konfirmasi Kata Sandi Baru <span class="text-red-500">*</span>
                    </label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                           placeholder="Ulangi kata sandi baru">
                </div>
            </div>

            <div class="pt-2 flex justify-end">
                <button type="submit"
                        class="min-h-[46px] px-6 py-3 rounded-xl bg-sage-600 hover:bg-forest text-white font-bold text-xs shadow-md transition">
                    Perbarui Kata Sandi
                </button>
            </div>
        </form>
    </div>

</div>
@endsection