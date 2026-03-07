<x-guest-layout>
    <div class="text-center">
        <div class="text-9xl font-black text-ink/20 font-mono" aria-hidden="true">
            404
        </div>

        <h1 class="text-4xl font-bold font-serif mt-4 text-ink">
            Halaman Tidak Ditemukan
        </h1>

        <p class="mt-4 text-lg text-ink/80">
            Maaf, kami tidak dapat menemukan halaman yang Anda cari.
        </p>

        <div class="mt-8">
            <div class="mt-8">
            <x-ui.button href="{{ route('home') }}">
                Kembali ke Beranda
            </x-ui.button>
        </div>
        </div>
    </div>
</x-guest-layout>
