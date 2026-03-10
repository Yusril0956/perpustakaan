<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset("images/library.svg") }}" type="image/x-icon">
    <title>{{ config('app.name', 'Scriptoria') }}</title>
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

    <x-layout.footer />

    @livewireScripts
</body>

</html>