{{-- resources/views/components/layout/alert.blade.php --}}
<div x-data="{ 
        show: false, 
        message: '', 
        type: 'success',
        timer: null
    }" {{-- Mendengarkan Session Flash Laravel --}} x-init="
        @if(session('success'))
            message = '{{ session('success') }}'; type = 'success'; show = true;
        @elseif(session('error'))
            message = '{{ session('error') }}'; type = 'error'; show = true;
        @elseif(session('info'))
            message = '{{ session('info') }}'; type = 'info'; show = true;
        @endif

        if(show) {
            timer = setTimeout(() => show = false, 5000);
        }
    " {{-- Animasi Muncul: Geser dari Kanan --}} x-show="show" x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 translate-x-full"
    class="fixed bottom-8 right-8 z-[9999] max-w-sm w-full pointer-events-none" x-cloak>
    <div @click="show = false"
        class="pointer-events-auto cursor-pointer group relative bg-[#fcfaf5] border-2 border-ink p-1 shadow-[10px_10px_0px_rgba(44,36,32,0.15)] overflow-hidden">

        <div class="border border-dashed border-sepia-edge/40 p-4 bg-white/50 flex gap-4 items-start">

            <div class="shrink-0">
                <template x-if="type === 'success'">
                    <div class="p-2 border-2 border-green-800/30 rounded-full">
                        <x-heroicon-s-check-badge class="w-6 h-6 text-green-800" />
                    </div>
                </template>
                <template x-if="type === 'error'">
                    <div class="p-2 border-2 border-red-800/30 rounded-full">
                        <x-heroicon-s-exclamation-circle class="w-6 h-6 text-red-800" />
                    </div>
                </template>
                <template x-if="type === 'info'">
                    <div class="p-2 border-2 border-blue-800/30 rounded-full">
                        <x-heroicon-s-information-circle class="w-6 h-6 text-blue-800" />
                    </div>
                </template>
            </div>

            <div class="flex-1">
                <div class="flex justify-between items-start mb-1">
                    <span class="text-[9px] font-mono font-black uppercase tracking-[0.3em] text-coffee/60"
                        x-text="type === 'success' ? 'Konfirmasi Pustaka' : (type === 'error' ? 'Laporan Kegagalan' : 'Catatan Sistem')">
                    </span>
                </div>
                <p class="text-sm font-bold text-ink italic leading-tight pr-4" x-text="message"></p>
            </div>

            <button class="text-ink/20 group-hover:text-ink transition-colors mt-1">
                <x-heroicon-s-x-mark class="w-4 h-4" />
            </button>
        </div>

        <div class="absolute bottom-0 left-0 h-1 bg-ink/10 w-full">
            <div class="h-full bg-ink/30 transition-all linear"
                :style="show ? 'width: 0%; transition-duration: 5000ms;' : 'width: 100%;'" x-show="show"
                x-init="$nextTick(() => { if(show) $el.style.width = '100%' })"></div>
        </div>

        <div
            class="absolute inset-0 opacity-[0.03] pointer-events-none bg-[url('https://www.transparenttextures.com/patterns/natural-paper.png')]">
        </div>
    </div>
</div>