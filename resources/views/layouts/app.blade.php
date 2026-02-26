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

<body class="antialiased flex">

    <x-layout.sidebar />

    <div class="flex-1 ml-64 min-h-screen flex flex-col">
        <header class="h-16 bg-surface border-b flex items-center justify-between px-8 sticky top-0 z-40">
            <div class="italic text-muted">
                {{ now()->format('d F Y') }} — <span class="font-bold text-ink">Selamat Datang,
                    {{ auth()->user()->name }}</span>
            </div>
            <div class="flex items-center gap-4">
                <!-- tag role -->
                <div class="text-xs uppercase tracking-widest text-muted font-bold">
                    @foreach(auth()->user()->getRoleNames() as $role)
                    <span class="px-3 py-1 text-xs text-muted font-bold uppercase rounded">{{ $role }}</span>
                    @endforeach
                </div>
                <img src="{{ auth()->user()->profile_photo_url }}"
                    alt="{{ auth()->user()->name }}"
                    class="w-14 h-14 rounded-full object-cover border-2 border-accent shadow-md">
            </div>
        </header>

        <main class="p-8">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>

</html>