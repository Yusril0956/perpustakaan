<div class="w-full max-w-4xl mx-auto py-12 px-4">
    <div class="mb-8">
        <a href="{{ route('admin.books.index') }}" wire:navigate
            class="text-xs font-mono uppercase tracking-widest text-ink font-bold flex items-center gap-2 group">
            <span class="group-hover:-translate-x-1 transition-transform">←</span> Kembali ke Rak Utama
        </a>
    </div>

    <div class="relative bg-white p-2 border-2 border-ink/20 shadow-2xl">
        <div class="border-[3px] border-ink p-10 md:p-14 relative bg-[#fdfbf7]">

            {{-- Header --}}
            <div class="text-center mb-16 border-b-2 border-ink/10 pb-10">
                <h2 class="text-4xl font-serif italic text-ink font-black mb-3">Pendaftaran Koleksi Baru</h2>
                <span
                    class="text-[11px] font-mono uppercase tracking-[0.4em] text-ink font-bold py-1 px-4 bg-ink/5 border border-ink/10">
                    Lembar Inventaris Digital
                </span>
            </div>

            <form wire:submit="save" x-data="{ uploading: false, progress: 0 }"
                x-on:livewire-upload-start="uploading = true" x-on:livewire-upload-finish="uploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress" class="space-y-12">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-12">

                    {{-- Kolom Kiri --}}
                    <div class="space-y-10">
                        <x-forms.input label="01. Judul Lengkap Pustaka" wire:model="form.title" placeholder="..." />

                        <x-forms.input label="02. Nama Penulis / Pengarang" wire:model="form.author" placeholder="..." />

                        <div class="grid grid-cols-2 gap-8">
                            <x-forms.input label="03. Kode ISBN" wire:model="form.isbn" placeholder="978-..." />
                            <x-forms.input label="04. Stok Fisik" wire:model="form.total_stock" type="number" />
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="space-y-10">
                        <div>
                            <label
                                class="block text-[12px] font-mono uppercase font-black tracking-widest text-ink mb-2">05.
                                Penempatan Rak</label>
                            <select wire:model="form.category_id"
                                class="w-full bg-transparent border-0 border-b-2 border-ink/30 focus:border-ink focus:outline-none focus:ring-0 px-0 py-2 font-serif text-xl italic text-ink cursor-pointer">
                                <option value="">Pilih Klasifikasi...</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label
                                class="block text-[12px] font-mono uppercase font-black tracking-widest text-ink mb-4">06.
                                Sampul Depan</label>
                            <div class="flex items-center gap-8">
                                <label x-data="{ dragging: false }" @dragover.prevent="dragging = true"
                                    @dragleave.prevent="dragging = false" @drop.prevent="dragging = false"
                                    class="relative group w-32 h-44 border-2 border-ink bg-white overflow-hidden shadow-md cursor-pointer transition-all duration-200"
                                    :class="dragging ? 'ring-2 ring-ink scale-[1.02]' : ''">
                                    <input type="file" wire:model="form.cover_image" class="hidden">
                                    @if ($form->cover_image)
                                        <img src="{{ $form->cover_image->temporaryUrl() }}"
                                            class="w-full h-full object-cover" loading="lazy">
                                    @else
                                        <div
                                            class="w-full h-full flex flex-col items-center justify-center text-center opacity-40">
                                            <x-heroicon-o-photo class="w-8 h-8 mb-2" />
                                            <span class="text-[9px] font-mono uppercase font-bold">Drop Cover</span>
                                        </div>
                                    @endif

                                    <div
                                        class="absolute inset-0 bg-ink/80 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                        <div class="flex flex-col items-center text-white">
                                            <x-heroicon-o-arrow-up-tray class="w-6 h-6 mb-1" />
                                            <span class="text-[9px] font-mono uppercase tracking-widest">
                                                tambah sampul
                                            </span>
                                        </div>
                                    </div>
                                    <div x-show="uploading"
                                        class="absolute inset-0 bg-ink/90 flex items-center justify-center">
                                        <span class="text-xs font-mono font-bold text-white"
                                            x-text="progress + '%'"></span>
                                    </div>
                                </label>
                                <div class="flex-1">
                                    <p class="text-[10px] font-mono font-bold text-ink/40 italic leading-tight">
                                        * Drag & drop atau klik sampul untuk mengganti.<br>
                                        Format JPG/PNG, Maks 2MB.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label
                            class="block text-[12px] font-mono uppercase font-black tracking-widest text-ink mb-3">07.
                            Ikhtisar Pustakawan</label>
                        <textarea wire:model="form.description" rows="4"
                            class="w-full bg-white border-2 border-ink focus:ring-0 p-5 font-serif text-xl italic text-ink shadow-inner"></textarea>
                    </div>
                </div>

                {{-- Action Area --}}
                <div
                    class="flex flex-col md:flex-row items-center justify-between pt-10 border-t-2 border-ink/10 gap-8">
                    <div class="max-w-xs">
                        <p class="text-[11px] font-mono uppercase font-bold text-ink leading-relaxed">
                            Pastikan seluruh data telah diverifikasi sesuai dengan fisik buku.
                        </p>
                    </div>
                    <x-ui.button variant="outline">
                        Simpan Koleksi &rarr;
                    </x-ui.button>
                </div>
            </form>
        </div>
    </div>
</div>