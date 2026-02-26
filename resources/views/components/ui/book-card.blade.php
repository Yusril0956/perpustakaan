@props(['book'])

<div
    class="group relative bg-white/40 backdrop-blur-sm border border-sepia-edge/30 p-4 shadow-sm hover:shadow-lg transition-all duration-500 rounded-sm overflow-hidden flex flex-col h-full">
    <!-- Cover Image -->
    <div class="relative aspect-[3/4] overflow-hidden shadow-md border-l-4 border-black/10 mb-3">
        <img src="{{ $book->cover_url }}" alt="{{ $book->title }}"
            class="w-full h-full object-cover sepia-[0.2] group-hover:sepia-0 transition-all duration-700">

        <!-- Stock Badge -->
        <div
            class="absolute top-2 right-2 bg-parchment-base text-[10px] font-bold px-2 py-1 border border-sepia-edge/50 shadow-sm">
            @if($book->available_stock > 0)
                <span class="text-green-700">{{ $book->available_stock }} Ada</span>
            @else
                <span class="text-red-600">Habis</span>
            @endif
        </div>
    </div>

    <!-- Book Info -->
    <div class="space-y-2 flex-1">
        <div class="flex items-center gap-1 text-[10px] font-mono text-sepia-edge uppercase tracking-widest">
            <x-heroicon-o-tag class="w-3 h-3" />
            {{ $book->category->name }}
        </div>
        <h3
            class="text-sm font-bold text-ink italic leading-tight group-hover:text-coffee transition-colors line-clamp-2">
            {{ $book->title }}
        </h3>
        <p class="text-xs text-coffee/70 italic">{{ $book->author }}</p>
    </div>

    <!-- Action Buttons -->
    <div class="mt-4 pt-3 border-t border-dashed border-sepia-edge/30 space-y-2">
        <button
            @click="$dispatch('livewire:navigate', { url: 'javascript:Livewire.find(' + @this.id + ').call(\'showDetail\', ' + {{ $book->id }} + ')' })"
            class="w-full text-xs font-bold uppercase tracking-tighter text-ink hover:text-coffee transition py-2 border border-sepia-edge/30 hover:bg-coffee/10 rounded-sm">
            📖 Detail
        </button>
        @if($book->available_stock > 0)
            <button
                onclick="Livewire.find('{{ $this->getId() ?? 'guest.book-explorer' }}').call('requestLoan', {{ $book->id }})"
                class="w-full text-xs font-bold uppercase tracking-tighter text-parchment-light bg-coffee hover:bg-coffee/90 transition py-2 rounded-sm">
                📚 Pinjam
            </button>
        @endif
    </div>
</div>