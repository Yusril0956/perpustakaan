{{-- resources/views/components/layout/alert.blade.php --}}
<div x-data="{
        show: false,
        message: '',
        type: 'success',
        timer: null,

        init() {
            @if(session('success'))
                this.message = @js(session('success'));
                this.type    = 'success';
                this.show    = true;
            @elseif(session('warning'))
                this.message = @js(session('warning'));
                this.type    = 'warning';
                this.show    = true;
            @elseif(session('error'))
                this.message = @js(session('error'));
                this.type    = 'error';
                this.show    = true;
            @elseif(session('info'))
                this.message = @js(session('info'));
                this.type    = 'info';
                this.show    = true;
            @endif

            if (this.show) {
                this.timer = setTimeout(() => this.show = false, 5000);
            }
        },

        dismiss() {
            clearTimeout(this.timer);
            this.show = false;
        }
    }" x-init="init()" x-show="show" x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 translate-x-full" x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 translate-x-full"
    class="fixed bottom-8 right-8 z-[9999] max-w-sm w-full pointer-events-none" x-cloak>
    <div @click="dismiss()" class="pointer-events-auto cursor-pointer group relative bg-[#fcfaf5] border-2 border-ink p-1
               shadow-[10px_10px_0px_rgba(44,36,32,0.15)] overflow-hidden">
        <div class="border border-dashed border-sepia-edge/40 p-4 bg-white/50 flex gap-4 items-start">

            {{-- Icon --}}
            <div class="shrink-0">
                <template x-if="type === 'success'">
                    <div class="p-2 border-2 border-green-800/30 rounded-full">
                        <x-heroicon-s-check-badge class="w-6 h-6 text-green-800" />
                    </div>
                </template>
                <template x-if="type === 'warning'">
                    <div class="p-2 border-2 border-orange-600/30 rounded-full">
                        <x-heroicon-s-exclamation-triangle class="w-6 h-6 text-orange-600" />
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

            {{-- Text --}}
            <div class="flex-1 min-w-0">
                <div class="flex justify-between items-start mb-1">
                    <span class="text-[9px] font-mono font-black uppercase tracking-[0.3em] text-coffee/60" x-text="{
                            success: 'Konfirmasi Pustaka',
                            warning: 'Perhatian Pustaka',
                            error:   'Laporan Kegagalan',
                            info:    'Catatan Sistem'
                        }[type]"></span>
                </div>
                <p class="text-sm font-bold text-ink italic leading-tight pr-4" x-text="message"></p>
            </div>

            {{-- Close --}}
            <button class="text-ink/20 group-hover:text-ink transition-colors mt-1 shrink-0" aria-label="Tutup">
                <x-heroicon-s-x-mark class="w-4 h-4" />
            </button>
        </div>

        {{-- Progress bar --}}
        <div class="absolute bottom-0 left-0 h-1 bg-ink/10 w-full">
            <div class="h-full bg-ink/30 w-full" x-show="show"
                x-init="$nextTick(() => { if(show) { $el.style.transition = 'width 5000ms linear'; $el.style.width = '0%'; } })">
            </div>
        </div>

        {{-- Paper texture --}}
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none
                    bg-[url('https://www.transparenttextures.com/patterns/natural-paper.png')]"></div>
    </div>
</div>