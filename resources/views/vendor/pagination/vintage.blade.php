@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}"
        class="flex items-center justify-center gap-4 py-10">
        {{-- Tombol Sebelumnya --}}
        @if ($paginator->onFirstPage())
            <span
                class="px-4 py-2 text-xs uppercase tracking-widest text-coffee/30 border border-sepia-edge/10 italic cursor-not-allowed">
                &larr; Arsip Sebelumnya
            </span>
        @else
            <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
                class="px-4 py-2 text-xs uppercase tracking-widest text-coffee border border-sepia-edge/40 hover:bg-coffee hover:text-parchment-light transition-all duration-300 shadow-[3px_3px_0px_#d2b48c] active:shadow-none active:translate-x-[2px] active:translate-y-[2px]">
                &larr; Arsip Sebelumnya
            </button>
        @endif

        {{-- Nomor Halaman (Halaman Buku) --}}
        <div
            class="hidden md:flex items-center gap-2 px-4 py-2 bg-parchment-base/50 border-x border-dashed border-sepia-edge/40 font-mono text-sm">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-2 text-coffee/40">{{ $element }}</span>
                @endif

                {{-- Array of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="w-8 h-8 flex items-center justify-center bg-coffee text-parchment-light rounded-full shadow-inner font-bold">
                                {{ $page }}
                            </span>
                        @else
                            <button wire:click="gotoPage({{ $page }})"
                                class="w-8 h-8 flex items-center justify-center text-coffee hover:bg-sepia-edge/20 transition-colors rounded-full">
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Tombol Selanjutnya --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
                class="px-4 py-2 text-xs uppercase tracking-widest text-coffee border border-sepia-edge/40 hover:bg-coffee hover:text-parchment-light transition-all duration-300 shadow-[3px_3px_0px_#d2b48c] active:shadow-none active:translate-x-[2px] active:translate-y-[2px]">
                Arsip Berikutnya &rarr;
            </button>
        @else
            <span
                class="px-4 py-2 text-xs uppercase tracking-widest text-coffee/30 border border-sepia-edge/10 italic cursor-not-allowed">
                Arsip Berikutnya &rarr;
            </span>
        @endif
    </nav>
@endif