<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Pustaka Klasik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="antialiased flex">

    <x-layout.sidebar />

    <div class="flex-1 ml-64 min-h-screen flex flex-col">
        <header class="h-16 bg-surface border-b flex items-center justify-between px-8 sticky top-0 z-40">
            <div class="italic text-muted">
                {{ now()->format('d F Y') }} — <span class="font-bold text-ink">Selamat Datang,
                    {{ auth()->user()->name }}</span>
            </div>
            <div class="flex items-center gap-4">
                <div
                    class="w-8 h-8 rounded-full bg-background flex items-center justify-center text-xs font-bold text-ink">
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