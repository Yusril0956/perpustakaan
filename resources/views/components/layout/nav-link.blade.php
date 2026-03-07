@props(['active', 'href'])

<a href="{{ $href }}" {{ $attributes }} @class([
    'relative italic text-lg transition-colors duration-300 group inline-block',
    'text-ink font-bold' => $active,
    'text-coffee hover:text-ink' => !$active
]) wire:navigate>
    {{ $slot }}

    <span @class([
        'absolute -bottom-1 left-0 h-[2px] bg-coffee/60 transition-all duration-500 ease-in-out',
        'w-full' => $active,
        'w-0 group-hover:w-full' => !$active
    ])></span>

    <span
        class="absolute -right-4 top-1 opacity-0 group-hover:opacity-100 transition-opacity text-[10px] text-coffee italic">✎</span>
</a>