<x-app-layout>
    <div class="space-y-8">
        <div class="relative p-8 bg-parchment-base border border-sepia-edge/40 shadow-sm overflow-hidden">
            <div class="relative z-10">
                <h1 class="text-3xl font-bold text-ink italic">Ringkasan Pustaka</h1>
                <p class="text-coffee mt-1">Anda memiliki <span class="font-bold">2 buku</span> yang harus segera
                    dikembalikan.</p>
            </div>
            <div class="absolute top-0 right-0 p-4 opacity-10">
                <x-heroicon-s-star class="w-24 h-24" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @php
                $stats = [
                    ['label' => 'Buku Dipinjam', 'value' => '05', 'icon' => 'book-open'],
                    ['label' => 'Menunggu Verifikasi', 'value' => '01', 'icon' => 'clock'],
                    ['label' => 'Total Denda', 'value' => 'Rp 4.000', 'icon' => 'currency-dollar'],
                ];
            @endphp

            @foreach($stats as $stat)
                <div class="bg-white/50 border-b-4 border-coffee p-6 shadow-sm hover:shadow-md transition">
                    <div class="text-[10px] uppercase tracking-widest text-coffee/60 font-bold mb-1">{{ $stat['label'] }}
                    </div>
                    <x-heroicon-o-{{ $stat['icon'] }} class="w-8 h-8 text-coffee mb-2" />
                    <div class="text-3xl font-bold text-ink italic">{{ $stat['value'] }}</div>
                </div>
            @endforeach
        </div>

        <div class="bg-white/80 border border-sepia-edge/20 shadow-sm rounded-sm overflow-hidden">
            <div class="p-4 bg-parchment-base border-b border-sepia-edge/20 font-bold italic text-ink">
                Log Aktivitas Terakhir
            </div>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[11px] uppercase tracking-widest text-coffee/70 bg-parchment-light/50">
                        <th class="p-4 font-medium border-b border-sepia-edge/10">Buku</th>
                        <th class="p-4 font-medium border-b border-sepia-edge/10">Status</th>
                        <th class="p-4 font-medium border-b border-sepia-edge/10">Jatuh Tempo</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <tr>
                        <td class="p-4 border-b border-sepia-edge/5 font-bold italic">Filosofi Teras</td>
                        <td class="p-4 border-b border-sepia-edge/5">
                            <span
                                class="px-2 py-1 bg-green-100 text-green-800 text-[10px] font-bold uppercase">Aktif</span>
                        </td>
                        <td class="p-4 border-b border-sepia-edge/5 text-coffee">12 Feb 2026</td>
                    </tr>
                    <tr>
                        <td class="p-4 border-b border-sepia-edge/5 font-bold italic">The Great Gatsby</td>
                        <td class="p-4 border-b border-sepia-edge/5">
                            <span
                                class="px-2 py-1 bg-yellow-100 text-yellow-800 text-[10px] font-bold uppercase">Pending</span>
                        </td>
                        <td class="p-4 border-b border-sepia-edge/5 text-coffee">-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>