@extends('layouts.app')

@section('title', 'Masuk Portal - Satu Meja')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 sm:p-10 rounded-3xl shadow-xl border border-sage/20">
        <!-- Header -->
        <div class="text-center space-y-2">
            <div class="w-14 h-14 rounded-2xl bg-forest text-white flex items-center justify-center font-heading text-2xl font-bold mx-auto shadow-md">
                🔐
            </div>
            <h2 class="font-heading text-3xl font-extrabold text-forest">
                Masuk Satu Portal
            </h2>
            <p class="text-xs text-gray-600">
                Satu portal untuk seluruh peran: Pendonasi, Penerima, dan Admin. Peran terdeteksi otomatis dari akun.
            </p>
        </div>

        <!-- Session Status / Errors -->
        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-xs font-semibold">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-xs font-semibold">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Form -->
        <form class="mt-8 space-y-5" action="{{ route('login.process') }}" method="POST">
            @csrf
            <div>
                <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                    Alamat Email
                </label>
                <input id="email" name="email" type="email" required autocomplete="email" value="{{ old('email') }}"
                       class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest focus:border-forest"
                       placeholder="nama@email.com">
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                    Kata Sandi
                </label>
                <input id="password" name="password" type="password" required autocomplete="current-password"
                       class="w-full min-h-[44px] px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-forest focus:border-forest"
                       placeholder="••••••••">
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded text-forest focus:ring-forest border-gray-300">
                    <span class="text-xs text-gray-600">Ingat Saya</span>
                </label>
            </div>

            <div>
                <button type="submit"
                        class="w-full min-h-[48px] px-6 py-3.5 inline-flex items-center justify-center text-sm font-bold text-white bg-forest hover:bg-forest-800 rounded-xl shadow-md transition focus:outline-none focus:ring-2 focus:ring-forest">
                    Masuk Sekarang
                </button>
            </div>
        </form>

        <!-- Quick Demo Hint & One-Click Auto Fill Buttons -->
        <div class="bg-page rounded-2xl p-4 border border-sage/20 text-xs text-gray-700 space-y-3">
            <span class="font-bold text-forest uppercase block text-[10px] tracking-wider">Isi Cepat Akun Demo (Klik untuk Isi):</span>
            <div class="grid grid-cols-2 gap-2 text-[11px]">
                <button type="button" onclick="fillDemo('admin@satumeja.id')"
                        class="px-2.5 py-1.5 bg-white border border-sage/40 rounded-lg text-left hover:bg-sage-100 font-medium">
                    👑 <strong>Admin</strong>
                </button>
                <button type="button" onclick="fillDemo('pendonasi@satumeja.id')"
                        class="px-2.5 py-1.5 bg-white border border-sage/40 rounded-lg text-left hover:bg-sage-100 font-medium">
                    🏬 <strong>Pendonasi (Verified)</strong>
                </button>
                <button type="button" onclick="fillDemo('penerima@satumeja.id')"
                        class="px-2.5 py-1.5 bg-white border border-sage/40 rounded-lg text-left hover:bg-sage-100 font-medium">
                    🏛️ <strong>Penerima (Verified)</strong>
                </button>
                <button type="button" onclick="fillDemo('bakery@satumeja.id')"
                        class="px-2.5 py-1.5 bg-white border border-sage/40 rounded-lg text-left hover:bg-sage-100 font-medium">
                    ⏳ <strong>Pendonasi (Pending)</strong>
                </button>
                <button type="button" onclick="fillDemo('dapur@satumeja.id')"
                        class="px-2.5 py-1.5 bg-white border border-sage/40 rounded-lg text-left hover:bg-sage-100 font-medium">
                    ⏳ <strong>Penerima (Pending)</strong>
                </button>
                <button type="button" onclick="fillDemo('rejected@satumeja.id')"
                        class="px-2.5 py-1.5 bg-white border border-sage/40 rounded-lg text-left hover:bg-sage-100 font-medium">
                    ✕ <strong>Akun Ditolak</strong>
                </button>
            </div>
        </div>

        <div class="text-center pt-2">
            <p class="text-xs text-gray-600">
                Belum memiliki akun?
                <a href="{{ route('register') }}" class="font-bold text-forest hover:underline">
                    Daftar Akun Baru
                </a>
            </p>
        </div>
    </div>
</div>

<script>
    function fillDemo(email) {
        document.getElementById('email').value = email;
        document.getElementById('password').value = 'password123';
    }
</script>
@endsection
