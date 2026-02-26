<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-parchment-light font-serif text-ink antialiased">
    <div class="fixed inset-0 pointer-events-none opacity-[0.04] z-[100]"
        style="background-image: url('https://www.transparenttextures.com/patterns/sandpaper.png');"></div>

    <x-layout.guest-navbar />

    <main class="pt-32 pb-16 min-h-screen">
        {{ $slot }}
    </main>

    <x-layout.guest-footer />

    @livewireScripts
</body>

</html>