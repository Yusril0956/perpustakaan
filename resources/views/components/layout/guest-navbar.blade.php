<nav class="fixed top-6 left-0 right-0 z-50 px-6">
    <div class="max-w-7xl mx-auto">
        <div
            class="bg-parchment-base/95 backdrop-blur-md border border-sepia-edge/40 shadow-[0_10px_30px_-10px_rgba(111,78,55,0.3)] rounded-sm px-8 py-4 flex justify-between items-center relative overflow-hidden">

            <div class="absolute inset-0 opacity-[0.05] pointer-events-none"
                style="background-image: url('https://www.transparenttextures.com/patterns/natural-paper.png');"></div>

            <div class="relative z-10 flex flex-col">
                <a href="/" class="text-3xl font-bold text-ink italic leading-tight group">
                    Scriptoria
                    <svg class="absolute -bottom-2 left-0 w-0 group-hover:w-full transition-all duration-700 h-2 text-coffee/40"
                        preserveAspectRatio="none" viewBox="0 0 100 10">
                        <path d="M0 5 Q 25 0, 50 5 T 100 5" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" />
                    </svg>
                </a>
            </div>

            <div class="flex items-center space-x-10 relative z-10">
                <x-layout.nav-link href="{{ route('explore') }}"
                    :active="request()->is('explore')">Explore</x-layout.nav-link>
                <x-layout.nav-link href="{{ route('about') }}"
                    :active="request()->is('about')">Tentang</x-layout.nav-link>

                @auth
                    @role('admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-2 group italic text-coffee font-bold" wire:navigate>
                        <x-heroicon-o-academic-cap class="w-5 h-5 text-sepia-edge" />
                        <span class="border-b border-dashed border-coffee group-hover:border-solid transition-all">Meja
                            Belajar</span>
                    </a>
                    @endrole

                    @role('anggota')
                    <a href="{{ route('member.dashboard') }}" wire:navigate
                        class="flex items-center gap-2 group italic text-coffee font-bold">
                        <x-heroicon-o-academic-cap class="w-5 h-5 text-sepia-edge" />
                        <span class="border-b border-dashed border-coffee group-hover:border-solid transition-all">Meja
                            Belajar</span>
                    </a>
                    @endrole
                @else
                    <div class="flex items-center gap-6">
                        <x-ui.button href="{{ route('login') }}" wire:navigate class="rounded-sm" variant="ghost" size="sm">
                            Masuk
                        </x-ui.button>
                        <x-ui.button href="{{ route('register') }}" wire:navigate class="rounded-sm" size="sm">
                            Gabung
                        </x-ui.button>
                    </div>
                @endauth
            </div>
        </div>
    </div>
    </div>
</nav>