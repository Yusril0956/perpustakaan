{{-- Reusable Confirmation Modal Component --}}
<div x-show="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none;">

    {{-- Backdrop --}}
    <div @click="isModalOpen = false" class="absolute inset-0 bg-black/30"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    </div>

    {{-- Modal Content --}}
    <div class="relative z-10 bg-white border-2 border-ink max-w-md w-full mx-4" @click.stop
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

        {{-- Header --}}
        <div class="px-6 py-4 border-b border-ink/20">
            <h3 class="font-serif italic font-bold text-ink text-lg" x-text="modalTitle"></h3>
        </div>

        {{-- Body --}}
        <div class="px-6 py-6">
            <p class="text-sm text-ink/80 font-serif" x-html="modalMessage"></p>
        </div>

        {{-- Footer --}}
        <div class="px-6 py-4 border-t border-ink/20 flex gap-3 justify-end">
            <button @click="isModalOpen = false"
                class="px-4 py-2 border border-ink/30 text-ink text-sm font-mono font-bold hover:bg-ink/5 transition">
                Batal
            </button>

            <button @click="handleModalConfirm()" :disabled="wire.processing"
                :style="`background-color: ${modalButtonColor}; border-color: ${modalButtonColor};`"
                class="px-4 py-2 border-2 text-white text-sm font-mono font-bold transition"
                wire:loading.attr="disabled">
                <span wire:loading.remove x-text="modalButtonText"></span>
                <span wire:loading><span class="inline-block animate-spin mr-2">⟳</span>Memproses...</span>
            </button>
        </div>
    </div>
</div>