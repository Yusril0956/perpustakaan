<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset("images/library.svg") }}" type="image/x-icon">

    <title>{{ config('app.name', 'Perpustakaan') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=crimson-text:400,600,700&display=swap" rel="stylesheet" />

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <main class="min-h-screen flex items-center justify-center px-4">
        <section class="w-full max-w-md paper-card p-8">
            {{-- Header --}}
            <div class="text-center mb-6">
                <h1 class="text-2xl font-semibold tracking-wide text-ink">
                    {{ config('app.name', 'Perpustakaan') }}
                </h1>
                <p class="text-sm text-muted mt-1">
                    Arsip pengetahuan & buku lama
                </p>
            </div>

            {{-- Slot --}}
            {{ $slot }}
        </section>
    </main>
</body>

</html>