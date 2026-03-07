<x-guest-layout>
    <div class="max-w-4xl mx-auto px-6">
        <header class="text-center mb-16">
            <h1 class="text-5xl md:text-6xl font-bold text-ink italic leading-tight">Mengenai Pustaka Kami</h1>
            <div class="flex justify-center items-center gap-4 mt-6">
                <div class="h-[1px] w-12 bg-sepia-edge"></div>
                <span class="text-coffee uppercase tracking-[0.3em] text-xs font-bold">Sebuah Narasi Singkat</span>
                <div class="h-[1px] w-12 bg-sepia-edge"></div>
            </div>
        </header>

        <section class="prose prose-stone lg:prose-xl mx-auto italic text-coffee leading-relaxed mb-20">
            <p class="mb-8">
                <span
                    class="float-left text-7xl font-bold text-ink mr-3 mt-2 leading-none border-b-4 border-coffee">D</span>
                igitalisasi bukan berarti menghilangkan jiwa dari sebuah buku. Pustaka Klasik lahir dari sebuah
                keresahan akan hilangnya aroma kertas dan tekstur tinta di era yang serba cepat. Kami percaya bahwa
                setiap baris kalimat membawa beban sejarah yang harus dijaga keberadaannya.
            </p>
            <p>
                Melalui platform ini, kami berusaha menjembatani kesenjangan antara masa lalu yang penuh makna dan masa
                depan yang digital. Setiap entri buku yang Anda temukan di rak kami telah melalui proses kurasi yang
                panjang, memastikan bahwa pengetahuan tetap dapat diakses tanpa kehilangan sentuhan estetikanya.
            </p>
        </section>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">
            <div
                class="p-8 bg-parchment-base border border-sepia-edge/30 rounded-sm shadow-inner relative overflow-hidden group">
                <div
                    class="absolute -top-4 -right-4 text-8xl text-sepia-edge/10 font-bold group-hover:scale-110 transition-transform">
                    01</div>
                <h3 class="text-xl font-bold text-ink mb-4 italic">Preservasi Pengetahuan</h3>
                <p class="text-sm text-coffee leading-loose">Kami memastikan setiap data buku tersimpan dengan standar
                    arsip yang baik, menjaga detail penulis hingga nomor ISBN sebagai identitas abadi.</p>
            </div>

            <div
                class="p-8 bg-parchment-base border border-sepia-edge/30 rounded-sm shadow-inner relative overflow-hidden group">
                <div
                    class="absolute -top-4 -right-4 text-8xl text-sepia-edge/10 font-bold group-hover:scale-110 transition-transform">
                    02</div>
                <h3 class="text-xl font-bold text-ink mb-4 italic">Aksesibilitas Estetik</h3>
                <p class="text-sm text-coffee leading-loose">Membaca secara digital tidak harus membosankan. Kami
                    mendesain antarmuka yang tenang agar fokus Anda tetap pada buku yang Anda cari.</p>
            </div>
        </div>

        <section class="text-center py-16 border-t border-b border-sepia-edge/20 italic">
            <p class="text-2xl text-ink mb-8">"Buku adalah cermin jiwa; Anda hanya melihat di dalamnya apa yang sudah
                Anda miliki di dalam diri Anda."</p>
            <div class="flex justify-center gap-6">
                <x-ui.button variant="outline" href="{{ route('login') }}" wire:navigate>
                    Bergabung Menjadi Anggota
                </x-ui.button>
            </div>
        </section>
    </div>
</x-guest-layout>