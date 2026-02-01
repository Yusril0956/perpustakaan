@props(['variant' => 'primary'])

@php
    $baseClasses = "px-6 py-2 transition-all duration-300 font-bold uppercase tracking-widest text-xs shadow-sm active:translate-y-0.5";
    $variants = [
        'primary' => "bg-coffee text-white hover:brightness-110 shadow-[4px_4px_0px_#2c2420]",
        'outline' => "border border-coffee text-coffee hover:bg-parchment-base",
    ];
@endphp

<button {{ $attributes->merge(['class' => $baseClasses . ' ' . $variants[$variant]]) }}>
    {{ $slot }}
</button>