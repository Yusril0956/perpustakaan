<?php

namespace App\Livewire\Admin\Loans;

use App\Models\Loan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.app')]
class Management extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $filter = 'pending';

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $sortBy = 'created_at';

    #[Url(history: true)]
    public $sortDir = 'desc';

    /**
     * Reset halaman saat filter atau pencarian berubah.
     */
    public function updatedFilter()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    /**
     * Fitur Sorting
     */
    public function sort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDir = 'asc';
        }
    }

    /**
     * Menggunakan Computed Property untuk efisiensi query.
     */
    #[Computed]
    public function loans()
    {
        return Loan::query()
            ->with(['user', 'book'])
            ->where('status', $this->filter)
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->whereHas('user', fn($user) => $user->where('name', 'like', "%{$this->search}%"))
                        ->orWhereHas('book', fn($book) => $book->where('title', 'like', "%{$this->search}%"));
                });
            })
            // Logika sorting khusus
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate(15);
    }

    public function approveLoan(int $loanId)
    {
        DB::transaction(function () use ($loanId) {
            $loan = Loan::lockForUpdate()->with('book')->findOrFail($loanId);

            if ($loan->status !== 'pending')
                throw new \Exception('Status tidak valid.');
            if ($loan->book->available_stock <= 0)
                throw new \Exception('Stok habis.');

            $loan->update([
                'status' => 'active',
                'loan_date' => now(),
                'due_date' => now()->addDays(7),
            ]);

            $loan->book->decrement('available_stock');
        });

        $this->dispatch('alert', type: 'success', message: 'Peminjaman telah disetujui.');
    }

    public function rejectLoan(int $loanId)
    {
        $loan = Loan::findOrFail($loanId);
        $loan->update(['status' => 'cancelled']);

        $this->dispatch('alert', type: 'success', message: 'Peminjaman telah ditolak.');
    }

    public function returnLoan(int $loanId)
    {
        DB::transaction(function () use ($loanId) {
            $loan = Loan::lockForUpdate()->with('book')->findOrFail($loanId);

            if ($loan->status !== 'active')
                throw new \Exception('Peminjaman tidak aktif.');

            $loan->update([
                'status' => 'returned',
                'return_date' => now(),
            ]);

            $loan->book->increment('available_stock');
        });

        $this->dispatch('alert', type: 'success', message: 'Buku telah diterima kembali.');
    }

    public function render()
    {
        return view('livewire.admin.loans.management');
    }
}