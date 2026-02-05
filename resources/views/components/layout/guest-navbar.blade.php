<nav class="fixed top-6 left-0 right-0 z-50 px-6">
    <div class="max-w-7xl mx-auto">
        <div
            class="bg-parchment-base/95 backdrop-blur-md border border-sepia-edge/40 shadow-[0_10px_30px_-10px_rgba(111,78,55,0.3)] rounded-sm px-8 py-4 flex justify-between items-center relative overflow-hidden">

            <div class="absolute inset-0 opacity-[0.05] pointer-events-none"
                style="background-image: url('https://www.transparenttextures.com/patterns/natural-paper.png');"></div>

            <div class="relative z-10 flex flex-col">
                <a href="/" class="text-3xl font-bold text-ink italic leading-tight group">
                    Pustaka <span class="text-coffee font-light">Digital</span>
                    <svg class="absolute -bottom-2 left-0 w-0 group-hover:w-full transition-all duration-700 h-2 text-coffee/40"
                        preserveAspectRatio="none" viewBox="0 0 100 10">
                        <path d="M0 5 Q 25 0, 50 5 T 100 5" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" />
                    </svg>
                </a>
            </div>

            <div class="flex items-center space-x-10 relative z-10">
                <x-layout.nav-link href="/" :active="request()->is('/')">Katalog</x-layout.nav-link>
                <x-layout.nav-link href="/about" :active="request()->is('about')">Tentang</x-layout.nav-link>

                @auth
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group italic text-coffee font-bold">
                        <x-heroicon-o-academic-cap class="w-5 h-5 text-sepia-edge" />
                        <span class="border-b border-dashed border-coffee group-hover:border-solid transition-all">Meja
                            Belajar</span>
                    </a>
                @else
                    <div class="flex items-center gap-6">
                        <a href="{{ route('login') }}"
                            class="text-sm font-bold uppercase tracking-widest text-coffee hover:text-ink transition flex items-center gap-2">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                            class="bg-coffee text-parchment-light px-6 py-2.5 rounded-sm shadow-[4px_4px_0px_#2c2420] hover:shadow-none hover:translate-x-1 hover:translate-y-1 transition-all duration-200 text-xs font-bold uppercase tracking-[0.2em] flex items-center gap-2">
                            Gabung
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
    </div>
</nav>