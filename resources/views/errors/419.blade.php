<x-guest-layout>
    <div class="text-center">
        <div class="text-9xl font-black text-ink/20 font-mono" aria-hidden="true">
            419
        </div>

        <h1 class="text-4xl font-bold font-serif mt-4 text-ink">
            Halaman Kadaluarsa
        </h1>

        <p class="mt-4 text-lg text-ink/80">
            Maaf, halaman ini telah kadaluarsa. Silakan kembali dan coba lagi.
        </p>

        <div class="mt-8">
            <x-ui.button href="{{ url()->previous() }}">
                Kembali
            </x-ui.button>
        </div>
    </div>
</x-guest-layout>
