<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Pustaka Klasik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-parchment-light antialiased font-serif flex">

    <x-layout.sidebar />

    <div class="flex-1 ml-64 min-h-screen flex flex-col">
        <header
            class="h-16 bg-white/30 backdrop-blur-sm border-b border-sepia-edge/20 flex items-center justify-between px-8 sticky top-0 z-40">
            <div class="italic text-coffee">
                {{ now()->format('d F Y') }} — <span class="font-bold">Selamat Datang, {{ auth()->user()->name }}</span>
            </div>
            <div class="flex items-center gap-4">
                <div
                    class="w-8 h-8 rounded-full bg-sepia-edge/30 border border-coffee/20 flex items-center justify-center text-xs font-bold">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <main class="p-8">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>

</html>