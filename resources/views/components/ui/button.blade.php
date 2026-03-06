@props([
'href' => null,
'type' => 'button',
'variant' => 'primary',
'size' => 'md',
'iconLeft' => null,
'iconRight' => null,
'loading' => null,
])

@php
$base = "relative inline-flex items-center justify-center gap-2 border-2 font-mono font-black uppercase overflow-hidden transition-all duration-200 ease-out disabled:opacity-60 disabled:cursor-not-allowed";

$variants = [
'primary' => 'bg-[#fcfaf5] text-ink border-ink shadow-[6px_6px_0px_rgba(44,36,32,1)] hover:translate-y-1 hover:shadow-[2px_2px_0px_rgba(44,36,32,1)]',
'outline' => 'group bg-transparent text-ink border-ink',
'ghost' => 'bg-transparent border-transparent text-ink hover:bg-ink/10',
];

$sizes = [
'sm' => 'px-4 py-2 text-xs tracking-[0.2em]',
'md' => 'px-8 py-3 text-sm tracking-[0.25em]',
'lg' => 'px-10 py-4 text-sm tracking-[0.3em]',
];

$style = $base.' '.($variants[$variant] ?? $variants['primary']).' '.($sizes[$size] ?? $sizes['md']);

$tag = $href ? 'a' : 'button';
@endphp

<{{ $tag }}
{{ $attributes->class($style) }}
@if($href) href="{{ $href }}" @else type="{{ $type }}" @endif
wire:loading.attr="disabled"
>

@if($variant === 'outline')
<span class="absolute inset-0 w-0 bg-ink transition-all duration-300 group-hover:w-full"></span>
@endif

{{-- NORMAL CONTENT --}}
<span
class="relative z-10 flex items-center gap-2 transition-colors {{ $variant === 'outline' ? 'group-hover:text-white' : '' }}"
@if($loading)
wire:loading.remove
wire:target="{{ $loading }}"
@endif
>

@if($iconLeft)
<x-dynamic-component :component="$iconLeft" class="w-5 h-5 shrink-0"/>
@endif

<span class="whitespace-nowrap">
{{ $slot }}
</span>

@if($iconRight)
<x-dynamic-component :component="$iconRight" class="w-5 h-5 shrink-0"/>
@endif

</span>

{{-- LOADING STATE --}}
@if($loading)
<span
wire:loading
wire:target="{{ $loading }}"
class="relative z-10 flex items-center gap-2"
>

<svg class="w-4 h-4 animate-spin" viewBox="0 0 24 24" fill="none">
<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" opacity="0.25"/>
<path d="M22 12a10 10 0 00-10-10" stroke="currentColor" stroke-width="3"/>
</svg>

<span>Loading...</span>

</span>
@endif

</{{ $tag }}>