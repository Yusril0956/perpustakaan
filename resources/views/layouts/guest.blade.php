<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-parchment-light font-serif">
    <nav class="bg-parchment-base/90 border-b border-sepia-edge/40 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="flex flex-col">
                <a href="/" class="text-3xl font-bold tracking-tight text-ink italic leading-none">
                    Pustaka <span class="text-coffee font-light italic">Klasik</span>
                </a>
                <span class="text-[10px] uppercase tracking-[0.2em] text-coffee/70">Est. 1924 Digital Edition</span>
            </div>

            <div class="hidden md:flex items-center space-x-8 text-coffee">
                <a href="/"
                    class="hover:text-ink transition decoration-sepia-edge underline-offset-4 underline">Katalog</a>
                <a href="/about" class="hover:text-ink transition">Tentang</a>
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="px-6 py-2 border border-coffee text-coffee hover:bg-coffee hover:text-white transition-all duration-300">
                        Meja Belajar
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-ink transition">Masuk</a>
                    <a href="{{ route('register') }}"
                        class="px-6 py-2 bg-coffee text-white rounded-sm shadow-md hover:brightness-110 transition">
                        Gabung Anggota
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="py-12">
        {{ $slot }}
    </main>

    <h1>kocak</h1>

    @livewireScripts
</body>

</html>