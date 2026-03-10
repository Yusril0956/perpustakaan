<?php

namespace App\Livewire\Admin\Borrowings;

use App\Models\Borrowing;
use App\Models\Fine;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    protected int $fineRatePerDay = 1000;

    #[On('return-book')]
    public function returnBook(int $borrowingId): void
    {
        $borrowing = Borrowing::with('book')->findOrFail($borrowingId);

        // Use database transaction for data consistency
        try {
            \Illuminate\Support\Facades\DB::transaction(function () use ($borrowing) {
                $now = now();
                $dueAt = \Carbon\Carbon::parse($borrowing->due_at);

                // Tandai buku dikembalikan
                $borrowing->update([
                    'returned_at' => $now,
                    'status' => 'RETURNED',
                ]);

                // Kembalikan ketersediaan buku
                $borrowing->book->increment('available_stock');
                if ($borrowing->book->available_stock > 0) {
                    $borrowing->book->update(['is_available' => true]);
                }

                // Buat denda hanya jika: terlambat DAN belum ada denda sebelumnya
                if ($now->greaterThan($dueAt) && !$borrowing->fine()->exists()) {
                    $daysOverdue = (int) $now->startOfDay()->diffInDays($dueAt->startOfDay());
                    $fineAmount = $daysOverdue * $this->fineRatePerDay;

                    Fine::create([
                        'borrowing_id' => $borrowing->id,
                        'amount' => $fineAmount,
                        'status' => 'UNPAID',
                    ]);

                    session()->flash(
                        'warning',
                        "Buku dikembalikan terlambat {$daysOverdue} hari. " .
                        "Denda Rp " . number_format($fineAmount, 0, ',', '.') . " telah dicatat."
                    );
                    return;
                }

                session()->flash('success', 'Buku berhasil dikembalikan. Tidak ada denda.');
            });
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function render()
    {
        $borrowings = Borrowing::with(['user', 'book'])
            ->where('status', 'BORROWED')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.borrowings.index', compact('borrowings'));
    }
}
