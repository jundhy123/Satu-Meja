@extends('layouts.app')

@section('title', 'Pendaftaran Akun Baru - Satu Meja')

@section('content')
<div class="max-w-2xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white p-8 sm:p-10 rounded-3xl shadow-xl border border-sage/20 space-y-8">
        <!-- Header -->
        <div class="text-center space-y-2">
            <span class="px-3 py-1 rounded-full text-xs font-bold bg-sage-100 text-forest border border-sage/30">
                Pendaftaran Terpusat
            </span>
            <h2 class="font-heading text-3xl font-extrabold text-forest">
                Daftar Akun Satu Meja
            </h2>
            <p class="text-xs text-gray-600 max-w-md mx-auto">
                Pilih peran sebagai Pelaku Usaha (Pendonasi) atau Lembaga Sosial (Penerima). Seluruh akun baru akan masuk ke status <strong>Menunggu Verifikasi</strong> oleh Admin.
            </p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form class="space-y-6" action="{{ route('register.process') }}" method="POST">
            @csrf

            <!-- Role Selection -->
            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                    Pilih Peran Pengguna <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label class="border-2 border-sage/30 rounded-2xl p-4 flex items-center gap-3 cursor-pointer hover:border-forest hover:bg-forest-50/50 transition has-[:checked]:border-forest has-[:checked]:bg-forest-50">
                        <input type="radio" name="role" value="pendonasi" required {{ old('role') === 'pendonasi' ? 'checked' : '' }} class="w-4 h-4 text-forest focus:ring-forest">
                        <div>
                            <span class="font-heading font-bold text-forest text-sm block">Pendonasi (Pelaku Usaha)</span>
                            <span class="text-[11px] text-gray-500">Restoran, Toko Roti, Katering, Swalayan</span>
                        </div>
                    </label>

                    <label class="border-2 border-sage/30 rounded-2xl p-4 flex items-center gap-3 cursor-pointer hover:border-forest hover:bg-forest-50/50 transition has-[:checked]:border-forest has-[:checked]:bg-forest-50">
                        <input type="radio" name="role" value="penerima" required {{ old('role', 'penerima') === 'penerima' ? 'checked' : '' }} class="w-4 h-4 text-forest focus:ring-forest">
                        <div>
                            <span class="font-heading font-bold text-forest text-sm block">Penerima (Lembaga Sosial)</span>
                            <span class="text-[11px] text-gray-500">Panti Asuhan, Dapur Umum, Yayasan</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Basic Info -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Nama Pengguna / Akun <span class="text-red-500">*</span>
                    </label>
                    <input id="name" name="name" type="text" required value="{{ old('name') }}"
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                           placeholder="Contoh: Restoran Melati">
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Alamat Email <span class="text-red-500">*</span>
                    </label>
                    <input id="email" name="email" type="email" required value="{{ old('email') }}"
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                           placeholder="email@domain.com">
                </div>
            </div>

            <!-- Password -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Kata Sandi <span class="text-red-500">*</span>
                    </label>
                    <input id="password" name="password" type="password" required
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                           placeholder="Minimal 8 karakter">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Konfirmasi Kata Sandi <span class="text-red-500">*</span>
                    </label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                           placeholder="Ulangi kata sandi">
                </div>
            </div>

            <!-- Institution Details -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-gray-100">
                <div>
                    <label for="institution_name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Nama Usaha / Lembaga <span class="text-red-500">*</span>
                    </label>
                    <input id="institution_name" name="institution_name" type="text" required value="{{ old('institution_name') }}"
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                           placeholder="Nama resmi lembaga / usaha">
                </div>

                <div>
                    <label for="category" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select id="category" name="category" required
                            class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest bg-white">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Restoran" {{ old('category') === 'Restoran' ? 'selected' : '' }}>Restoran</option>
                        <option value="Toko Roti" {{ old('category') === 'Toko Roti' ? 'selected' : '' }}>Toko Roti / Bakery</option>
                        <option value="Katering" {{ old('category') === 'Katering' ? 'selected' : '' }}>Katering</option>
                        <option value="Swalayan" {{ old('category') === 'Swalayan' ? 'selected' : '' }}>Swalayan / Minimarket</option>
                        <option value="Panti Asuhan" {{ old('category') === 'Panti Asuhan' ? 'selected' : '' }}>Panti Asuhan</option>
                        <option value="Dapur Umum" {{ old('category') === 'Dapur Umum' ? 'selected' : '' }}>Dapur Umum</option>
                        <option value="Yayasan" {{ old('category') === 'Yayasan' ? 'selected' : '' }}>Yayasan Sosial</option>
                        <option value="Lainnya" {{ old('category') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
            </div>

            <!-- PIC & Contact -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="pic_name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Nama Penanggung Jawab (PIC) <span class="text-red-500">*</span>
                    </label>
                    <input id="pic_name" name="pic_name" type="text" required value="{{ old('pic_name') }}"
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                           placeholder="Nama lengkap PIC">
                </div>

                <div>
                    <label for="phone" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        No. Telepon / WhatsApp <span class="text-red-500">*</span>
                    </label>
                    <input id="phone" name="phone" type="text" required value="{{ old('phone') }}"
                           class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                           placeholder="08123456789">
                </div>
            </div>

            <div>
                <label for="address" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                    Alamat Lengkap Lokasi <span class="text-red-500">*</span>
                </label>
                <textarea id="address" name="address" rows="3" required
                          class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                          placeholder="Jalan, nomor, kecamatan, kabupaten/kota">{{ old('address') }}</textarea>
            </div>

            <div>
                <label for="description" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                    Deskripsi Singkat Usaha / Lembaga <span class="text-gray-400 font-normal">(Opsional)</span>
                </label>
                <textarea id="description" name="description" rows="2"
                          class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest"
                          placeholder="Ceritakan singkat mengenai aktivitas usaha atau lembaga sosial Anda">{{ old('description') }}</textarea>
            </div>

            <div>
                <button type="submit"
                        class="w-full min-h-[48px] px-6 py-3.5 inline-flex items-center justify-center text-sm font-bold text-white bg-forest hover:bg-forest-800 rounded-xl shadow-md transition focus:outline-none focus:ring-2 focus:ring-forest">
                    Daftar Akun Baru
                </button>
            </div>
        </form>

        <div class="text-center">
            <p class="text-xs text-gray-600">
                Sudah memiliki akun?
                <a href="{{ route('login') }}" class="font-bold text-forest hover:underline">
                    Masuk Portal
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
