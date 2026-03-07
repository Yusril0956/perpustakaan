@props(['icon', 'label', 'href', 'active' => false])

<a href="{{ $href }}" @class([
    'flex items-center gap-4 px-8 py-2.5 transition-colors duration-200 group text-sm font-serif relative',
    'bg-ink/5 text-ink font-bold' => $active,
    'text-coffee/80 hover:text-ink hover:bg-ink/5' => !$active
]) wire:navigate>
    @if($active)
        <div class="absolute left-0 top-0 bottom-0 w-[3px] bg-ink"></div>
    @endif

    <span @class([
        'transition-colors duration-200',
        'text-ink' => $active,
        'text-coffee/40 group-hover:text-ink/60' => !$active
    ])>
        @if($icon === 'dashboard' || $icon === 'chart-bar')
            <x-heroicon-o-squares-2x2 class="w-5 h-5 stroke-[1.5]" />
        @elseif($icon === 'home')
            <x-heroicon-o-home class="w-5 h-5 stroke-[1.5]" />
        @elseif($icon === 'book' || $icon === 'book-open')
            <x-heroicon-o-book-open class="w-5 h-5 stroke-[1.5]" />
        @elseif($icon === 'users')
            <x-heroicon-o-users class="w-5 h-5 stroke-[1.5]" />
        @elseif($icon === 'clipboard' || $icon === 'bookmark-square')
            <x-heroicon-o-clipboard-document-list class="w-5 h-5 stroke-[1.5]" />
        @elseif($icon === 'clock')
            <x-heroicon-o-clock class="w-5 h-5 stroke-[1.5]" />
        @elseif($icon === 'bookmark' || $icon === 'heart')
            <x-heroicon-o-bookmark class="w-5 h-5 stroke-[1.5]" />
        @elseif($icon === 'folder-open')
            <x-heroicon-o-folder-open class="w-5 h-5 stroke-[1.5]" />
        @else
            <x-heroicon-o-document class="w-5 h-5 stroke-[1.5]" />
        @endif
    </span>

    <span class="flex-1 tracking-wide">{{ $label }}</span>

    @if($active)
        <span class="font-serif text-ink text-lg leading-none opacity-50 relative -top-[1px]">›</span>
    @endif
</a>