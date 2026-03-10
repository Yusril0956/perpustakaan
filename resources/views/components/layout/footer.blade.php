<footer class="bg-parchment-base border-t-2 border-sepia-edge/30 relative overflow-hidden">
    <div class="h-1 border-b border-sepia-edge/20 mb-1"></div>
    <div class="h-4 bg-coffee/5"></div>

    <div class="max-w-7xl mx-auto px-6 py-16 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">

            <div class="col-span-1 md:col-span-1">
                <a href="{{ route('home') }}" wire:navigate
                    class="text-2xl font-bold text-ink italic leading-none block mb-4">
                    Scriptoria
                </a>
                <p class="text-sm text-coffee/80 leading-relaxed italic">
                    "Where Knowledge is Preserved."
                </p>
                <div
                    class="mt-6 inline-block border-2 border-sepia-edge/40 px-3 py-1 rounded-full rotate-[-5deg] opacity-60">
                    <span class="text-[10px] font-bold text-sepia-edge uppercase tracking-widest">Arsip
                        Terverifikasi</span>
                </div>
            </div>

            <div>
                <h4
                    class="text-xs uppercase tracking-[0.2em] font-bold text-ink mb-6 border-b border-sepia-edge/20 pb-2 inline-block">
                    Navigasi Rak</h4>
                <ul class="space-y-4 text-sm italic text-coffee">
                    <li><a href="/" class="hover:text-ink transition-colors">Katalog Lengkap</a></li>
                    <li><a href="/categories" class="hover:text-ink transition-colors">Kategori Buku</a></li>
                    <li><a href="/new-arrivals" class="hover:text-ink transition-colors">Koleksi Terbaru</a></li>
                    <li><a href="/popular" class="hover:text-ink transition-colors">Paling Banyak Dibaca</a></li>
                </ul>
            </div>

            <div>
                <h4
                    class="text-xs uppercase tracking-[0.2em] font-bold text-ink mb-6 border-b border-sepia-edge/20 pb-2 inline-block">
                    Layanan</h4>
                <ul class="space-y-4 text-sm italic text-coffee">
                    <li><a href="{{ route('login') }}" wire:navigate class="hover:text-ink transition-colors">Masuk
                            Anggota</a></li>
                    <li><a href="{{ route('register') }}" wire:navigate
                            class="hover:text-ink transition-colors">Pendaftaran Baru</a></li>
                    <li><a href="{{ route('rules') }}" wire:navigate class="hover:text-ink transition-colors">Aturan
                            Peminjaman</a></li>
                    <li><a href="/fines" class="hover:text-ink transition-colors">Informasi Denda</a></li>
                </ul>
            </div>

            <div>
                <h4
                    class="text-xs uppercase tracking-[0.2em] font-bold text-ink mb-6 border-b border-sepia-edge/20 pb-2 inline-block">
                    Korespondensi</h4>
                <div class="text-sm italic text-coffee space-y-4">
                    <p class="flex items-start gap-3">
                        <x-heroicon-o-map-pin class="w-5 h-5 text-sepia-edge" />
                        <span>Jl. Scriptoria No. 12, Kota Knowledge</span>
                    </p>
                    <p class="flex items-center gap-3">
                        <x-heroicon-o-envelope class="w-5 h-5 text-sepia-edge" />
                        <span>info@scriptoria.id</span>
                    </p>
                    <p class="flex items-center gap-3">
                        <x-heroicon-o-phone class="w-5 h-5 text-sepia-edge" />
                        <span>(021) 1234-5678</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-16 pt-8 border-t border-sepia-edge/20 flex flex-col md:row justify-between items-center gap-4">
            <div class="text-[11px] uppercase tracking-widest text-coffee/60">
                Membangun Peradaban Sejak 2026 — Ditenagai oleh Laravel 12
            </div>
            <div class="flex gap-8 text-[11px] uppercase tracking-widest text-coffee/60">
                <a href="#" class="hover:text-ink transition">Kebijakan Privasi</a>
                <a href="{{ route('rules') }}" wire:navigate class="hover:text-ink transition">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>

    <div class="h-2 bg-ink/5"></div>
</footer>