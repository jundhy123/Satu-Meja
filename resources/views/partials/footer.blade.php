<!-- Footer Section -->
<footer class="bg-forest text-white border-t border-forest-800 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
            <!-- Col 1: About -->
            <div class="md:col-span-2 space-y-4">
                <div class="flex items-center gap-3">
                    <span class="font-heading text-2xl font-bold text-white">Satu Meja</span>
                </div>
                <p class="text-sm text-sage-100 max-w-md leading-relaxed">
                    Platform Kolaborasi Pelaku Usaha dan Penerima Manfaat dalam Mewujudkan Pangan Cukup untuk Semua. Mengusung filosofi bahwa pemberi dan penerima duduk di meja yang sama sebagai mitra seimbang.
                </p>
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-forest-800 border border-sage/30 text-xs font-semibold text-sage-200">
                    <span>🌱 Subtema SEVENT X 2026: Zero Hunger (SDG 2)</span>
                </div>
            </div>

            <!-- Col 2: Navigation -->
            <div>
                <h3 class="font-heading text-lg font-bold text-white mb-4">Navigasi Utama</h3>
                <ul class="space-y-2.5 text-sm text-sage-100">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="{{ route('donations.index') }}" class="hover:text-white transition">Cari Donasi Pangan</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-white transition">Masuk Portal</a></li>
                    <li><a href="#cara-kerja" class="hover:text-white transition">Alur Cara Kerja</a></li>
                </ul>
            </div>

            <!-- Col 3: Developer & Institution -->
            <div>
                <h3 class="font-heading text-lg font-bold text-white mb-4">Pengembang</h3>
                <p class="text-sm text-sage-100 font-semibold mb-2">Tim SEVENT X 2026:</p>
                <ul class="space-y-1.5 text-xs text-sage-200 mb-4">
                    <li>• Jundhy NR Situmorang (42325002)</li>
                    <li>• Parlinggoman M. Sihombing (42325042)</li>
                    <li>• Ferdy Roberto Hutahean (42325024)</li>
                </ul>
                <p class="text-xs text-sage font-medium">Institut Teknologi Del, Toba</p>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-forest-800 text-center text-xs text-sage-200 flex flex-col sm:flex-row justify-between items-center gap-4">
            <p>&copy; {{ date('Y') }} Satu Meja - Kolaborasi Pangan Layak Konsumsi. Seluruh Hak Cipta Dilindungi.</p>
            <p class="text-[11px] text-sage font-mono">Batas Layak & Kedaluwarsa Otomatis 15-Detik Active System</p>
        </div>
    </div>
</footer>
