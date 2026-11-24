@extends('layouts.app')

@section('title', 'Panel Dasbor Admin - Satu Meja')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
    <!-- Header Banner -->
    <div class="bg-forest text-white rounded-3xl p-8 shadow-xl flex flex-col md:flex-row md:items-center justify-between gap-6 border border-sage/20">
        <div class="space-y-2">
            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-sage/30 text-sage-200 border border-sage/40">
                Panel Admin & Moderasi Terpusat
            </span>
            <h1 class="font-heading text-3xl font-bold">Dasbor Pengelola Platform Satu Meja</h1>
            <p class="text-xs text-sage-100">
                Memverifikasi akun Pendonasi & Penerima, memantau riwayat keamanan makanan, dan mengelola umpan balik.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <span class="w-3 h-3 rounded-full bg-emerald-400 animate-ping"></span>
            <span class="text-xs font-mono font-bold text-sage-100">Sistem Pemantauan Aktif</span>
        </div>
    </div>

    <!-- Alert Notices -->
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-900 px-5 py-4 rounded-2xl text-sm font-semibold shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Metric Cards Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
        <div class="bg-white rounded-2xl p-5 border border-sage/20 shadow-sm space-y-2">
            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Total Akun Mitra</span>
            <div class="font-heading text-3xl font-extrabold text-forest">{{ $metrics['total_users'] }}</div>
            <span class="text-[11px] text-gray-400">Terdaftar di platform</span>
        </div>

        <div class="bg-amber-50 rounded-2xl p-5 border border-amber-200 shadow-sm space-y-2">
            <span class="text-xs font-bold uppercase tracking-wider text-amber-800">Menunggu Verifikasi</span>
            <div class="font-heading text-3xl font-extrabold text-amber-700">{{ $metrics['pending_users'] }}</div>
            <span class="text-[11px] text-amber-600 font-semibold">Perlu tindakan Admin</span>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-sage/20 shadow-sm space-y-2">
            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Total Donasi Pangan</span>
            <div class="font-heading text-3xl font-extrabold text-forest">{{ $metrics['total_donations'] }}</div>
            <span class="text-[11px] text-emerald-700 font-semibold">{{ $metrics['claimed_donations'] }} Tersalurkan</span>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-sage/20 shadow-sm space-y-2">
            <span class="text-xs font-bold uppercase tracking-wider text-gray-500">Donasi Kedaluwarsa</span>
            <div class="font-heading text-3xl font-extrabold text-gray-600">{{ $metrics['expired_donations'] }}</div>
            <span class="text-[11px] text-gray-500">Otomatis disembunyikan</span>
        </div>
    </div>

    <!-- Moderasi Akun (Tabel User & Filter) -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-sage/20 space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gray-100 pb-4">
            <div>
                <h2 class="font-heading text-xl font-bold text-forest">Moderasi Akun Pendonasi & Penerima</h2>
                <p class="text-xs text-gray-500">Hanya akun terverifikasi yang diperbolehkan memposting atau mengklaim donasi.</p>
            </div>

            <!-- Filter Controls -->
            <form action="{{ route('admin.dashboard') }}" method="GET" class="flex flex-wrap items-center gap-2">
                <select name="status" onchange="this.form.submit()"
                        class="px-3 py-2 text-xs rounded-xl border border-gray-300 bg-white font-semibold text-gray-700">
                    <option value="">-- Semua Status --</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                    <option value="verified" {{ request('status') === 'verified' ? 'selected' : '' }}>Verified (Disetujui)</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected (Ditolak)</option>
                </select>

                <select name="role" onchange="this.form.submit()"
                        class="px-3 py-2 text-xs rounded-xl border border-gray-300 bg-white font-semibold text-gray-700">
                    <option value="">-- Semua Peran --</option>
                    <option value="pendonasi" {{ request('role') === 'pendonasi' ? 'selected' : '' }}>Pendonasi</option>
                    <option value="penerima" {{ request('role') === 'penerima' ? 'selected' : '' }}>Penerima</option>
                </select>
            </form>
        </div>

        @if($users->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-700">
                    <thead class="bg-page text-forest font-heading text-xs uppercase tracking-wider border-b border-sage/20">
                        <tr>
                            <th class="px-4 py-3 rounded-l-xl">Nama Usaha / Lembaga</th>
                            <th class="px-4 py-3">Peran & Kategori</th>
                            <th class="px-4 py-3">PIC & Kontak</th>
                            <th class="px-4 py-3">Status Saat Ini</th>
                            <th class="px-4 py-3 text-right rounded-r-xl">Aksi Moderasi Admin</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($users as $u)
                            <tr class="hover:bg-forest-50/30 transition">
                                <td class="px-4 py-4">
                                    <span class="font-bold text-gray-900 block">{{ $u->institution_name ?? $u->name }}</span>
                                    <span class="text-xs text-gray-500 block">{{ $u->email }}</span>
                                    <span class="text-[11px] text-gray-400 block">{{ $u->address }}</span>
                                </td>
                                <td class="px-4 py-4 text-xs">
                                    <span class="font-bold uppercase block text-forest">{{ $u->role }}</span>
                                    <span class="text-gray-500 block">{{ $u->category }}</span>
                                </td>
                                <td class="px-4 py-4 text-xs">
                                    <span class="font-bold block text-gray-800">{{ $u->pic_name ?? '-' }}</span>
                                    <span class="font-mono text-emerald-800 block">{{ $u->phone ?? '-' }}</span>
                                </td>
                                <td class="px-4 py-4 text-xs">
                                    @if($u->status === 'verified')
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                            ✓ Verified
                                        </span>
                                    @elseif($u->status === 'pending')
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200 animate-pulse">
                                            ⏳ Pending
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-200">
                                            ✕ Rejected
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-xs text-right">
                                    <div class="inline-flex items-center gap-1.5">
                                        @if($u->status !== 'verified')
                                            <form action="{{ route('admin.users.verify', $u->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="min-h-[36px] px-3 py-1.5 bg-emerald-700 hover:bg-emerald-800 text-white font-bold rounded-lg transition">
                                                    Verifikasi
                                                </button>
                                            </form>
                                        @endif

                                        @if($u->status !== 'rejected')
                                            <form id="reject-user-form-{{ $u->id }}" action="{{ route('admin.users.reject', $u->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button"
                                                        onclick="showConfirmModal({
                                                            title: 'Konfirmasi Penolakan Akun',
                                                            message: 'Apakah Anda yakin ingin menolak akun {{ addslashes($u->institution_name ?? $u->name) }}? Akun yang ditolak dilarang login ke sistem.',
                                                            icon: '⚠️',
                                                            confirmText: 'Ya, Tolak Akun',
                                                            cancelText: 'Batal',
                                                            confirmBtnClass: 'bg-red-600 hover:bg-red-700 text-white',
                                                            onConfirm: () => document.getElementById('reject-user-form-{{ $u->id }}').submit()
                                                        })"
                                                        class="min-h-[36px] px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition">
                                                    Tolak
                                                </button>
                                            </form>
                                        @endif

                                        @if($u->status !== 'pending')
                                            <form action="{{ route('admin.users.suspend', $u->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="min-h-[36px] px-3 py-1.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-lg transition">
                                                    Tangguhkan
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pt-4">
                {{ $users->links() }}
            </div>
        @else
            <p class="text-xs text-gray-500 italic text-center py-6">Tidak ditemukan akun sesuai filter yang dipilih.</p>
        @endif
    </div>

    <!-- Pantau Donasi (Audit Log Semua Donasi Termasuk Kedaluwarsa) -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-sm border border-sage/20 space-y-6">
        <div class="border-b border-gray-100 pb-4">
            <h2 class="font-heading text-xl font-bold text-forest">Pantau Donasi (Log Riwayat Pangan Platform)</h2>
            <p class="text-xs text-gray-500">Pantaulah seluruh paket donasi aktif, tersalurkan, dan yang kedaluwarsa.</p>
        </div>

        @if($donations->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-700">
                    <thead class="bg-page text-forest font-heading text-xs uppercase tracking-wider border-b border-sage/20">
                        <tr>
                            <th class="px-4 py-3 rounded-l-xl">Judul Donasi</th>
                            <th class="px-4 py-3">Usaha Pendonasi</th>
                            <th class="px-4 py-3">Batas Layak Konsumsi</th>
                            <th class="px-4 py-3">Status Real-Time</th>
                            <th class="px-4 py-3 rounded-r-xl">Pengklaim</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($donations as $don)
                            <tr class="hover:bg-forest-50/30 transition">
                                <td class="px-4 py-4 font-bold text-gray-900">
                                    {{ $don->title }}
                                    <span class="block text-xs font-normal text-gray-500">{{ $don->food_type }} • {{ $don->quantity }}</span>
                                </td>
                                <td class="px-4 py-4 text-xs">
                                    <span class="font-bold text-forest block">{{ $don->donor->institution_name ?? $don->donor->name ?? 'Pendonasi' }}</span>
                                    <span class="text-gray-500 block">PIC: {{ $don->pic_name }}</span>
                                </td>
                                <td class="px-4 py-4 text-xs font-mono">
                                    {{ \Carbon\Carbon::parse($don->deadline)->format('d M Y H:i') }}
                                </td>
                                <td class="px-4 py-4 text-xs">
                                    @php $st = $don->computed_status; @endphp
                                    @if($st === 'claimed')
                                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 border border-blue-200">
                                            Sudah Diklaim
                                        </span>
                                    @elseif($st === 'expired')
                                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-700 border border-gray-300">
                                            Kedaluwarsa
                                        </span>
                                    @elseif($st === 'urgent')
                                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                            Segera Kedaluwarsa
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                            Tersedia
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-xs">
                                    @if($don->claimedBy)
                                        <span class="font-bold text-forest block">{{ $don->claimedBy->institution_name ?? $don->claimedBy->name }}</span>
                                    @else
                                        <span class="text-gray-400 italic">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
