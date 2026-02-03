@props(['variant' => 'primary'])

@php
    $baseClasses = 'inline-flex items-center justify-center transition-all duration-200 font-semibold text-sm';
    $variants = [
        'primary' => 'btn-primary',
        'outline' => 'btn-ghost',
    ];
@endphp

<button {{ $attributes->merge(['class' => trim($baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']))]) }}>
    {{ $slot }}
</button>