<x-guest-layout>
    <div class="text-center">
        <div class="text-9xl font-black text-ink/20 font-mono" aria-hidden="true">
            403
        </div>

        <h1 class="text-4xl font-bold font-serif mt-4 text-ink">
            Akses Ditolak
        </h1>

        <p class="mt-4 text-lg text-ink/80">
            Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.
        </p>

        <div class="mt-8">
            <x-ui.button href="{{ route('home') }}" wire:navigate>
                Kembali ke Beranda
            </x-ui.button>
        </div>
    </div>
</x-guest-layout>
