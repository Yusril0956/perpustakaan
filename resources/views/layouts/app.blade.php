<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('images/library.svg') }}" type="image/x-icon">
    <title>Dashboard - Pustaka Klasik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="antialiased flex bg-[#fcfaf5] text-ink selection:bg-ink selection:text-[#fcfaf5]">

    <x-layout.sidebar />

    <div class="flex-1 ml-64 min-h-screen flex flex-col relative">

        <header
            class="h-20 bg-[#fcfaf5] border-b-2 border-ink flex items-center justify-between px-8 sticky top-0 z-40 relative shadow-sm">

            <div
                class="absolute inset-0 opacity-[0.03] pointer-events-none bg-[url('https://www.transparenttextures.com/patterns/natural-paper.png')]">
            </div>

            <div class="flex items-center gap-6 relative z-10">
                <div
                    class="border-2 border-ink px-3 py-1.5 shadow-[4px_4px_0px_rgba(44,36,32,1)] bg-[#fcfaf5] transform -rotate-2">
                    <span class="font-mono text-xs font-black text-ink uppercase tracking-widest">
                        {{ now()->format('d M Y') }}
                    </span>
                </div>

                <div class="font-serif italic text-lg text-ink/80 mt-1">
                    Selamat Bertugas, <span
                        class="font-bold text-ink border-b border-dashed border-ink/40 pb-0.5">{{ auth()->user()->name }}</span>
                </div>
            </div>

            <div class="flex items-center gap-6 relative z-10">

                <div class="flex gap-2">
                    @foreach(auth()->user()->getRoleNames() as $role)
                        <span
                            class="px-2 py-1 border border-ink/50 font-mono text-[10px] font-black uppercase tracking-widest text-ink bg-ink/5">
                            [{{ $role }}]
                        </span>
                    @endforeach
                </div>

                <div class="relative group cursor-pointer">
                    <div
                        class="absolute -top-3 left-1/2 -translate-x-1/2 w-6 h-2 bg-ink/10 backdrop-blur-sm transform rotate-3 z-20">
                    </div>

                    <a href="{{ route('profile.show') }}" wire:navigate class="flex items-center gap-2 group">
                        <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}"
                            loading="lazy"
                            class="w-12 h-12 object-cover border-2 border-ink shadow-[4px_4px_0px_rgba(44,36,32,1)] hover:sepia-[20%] hover:grayscale-[30%] group-hover:translate-y-px group-hover:shadow-[2px_2px_0px_rgba(44,36,32,1)] transition-all duration-200">
                    </a>
                </div>
            </div>
        </header>

        <main class="p-8 relative z-10">
            {{ $slot }}
        </main>

        <x-layout.footer />
    </div>
    <x-layout.alert />
    @livewireScripts
</body>

</html>