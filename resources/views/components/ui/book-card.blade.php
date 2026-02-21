@props(['book'])

<div
    class="group relative bg-white/40 backdrop-blur-sm border border-sepia-edge/30 p-3 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500 rounded-sm">
    <div class="relative aspect-[3/4] overflow-hidden shadow-md border-l-4 border-black/10">
        <img src="{{ $book->cover_image }}" alt="{{ $book->title }}"
            class="w-full h-full object-cover sepia-[0.2] group-hover:sepia-0 transition-all duration-700">

        <div
            class="absolute top-2 right-2 bg-parchment-base text-[10px] font-bold px-2 py-1 border border-sepia-edge/50 shadow-sm rotate-3 group-hover:rotate-0 transition-transform">
            {{ $book->available_stock }} TERSEDIA
        </div>
    </div>

    <div class="mt-4 space-y-1">
        <div class="flex items-center gap-1 text-[10px] font-mono text-sepia-edge uppercase tracking-widest">
            <x-heroicon-o-tag class="w-3 h-3" />
            {{ $book->category->name }}
        </div>
        <h3 class="text-lg font-bold text-ink italic leading-tight group-hover:text-coffee transition-colors">
            {{ $book->title }}
        </h3>
        <p class="text-sm text-coffee/70 italic italic">oleh {{ $book->author }}</p>
    </div>

    <div class="mt-4 pt-3 border-t border-dashed border-sepia-edge/30 flex justify-between items-center">
        <span class="text-[10px] text-coffee/50 font-mono">#{{ str_pad($book->id, 5, '0', STR_PAD_LEFT) }}</span>
        <button
            class="flex items-center gap-1 text-xs font-bold uppercase tracking-tighter text-ink hover:text-coffee transition">
            Lihat Detail
            <x-heroicon-o-chevron-right class="w-3 h-3" />
        </button>
    </div>
</div>