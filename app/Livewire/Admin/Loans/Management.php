<?php

namespace App\Livewire\Admin\Loans;

use App\Models\Loan;
use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Management extends Component
{
    use WithPagination;

    public $filter = 'pending';
    public $search = '';

    public function updatingFilter()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function approveLoan($loanId)
    {
        $loan = Loan::with('book', 'user')->find($loanId);

        if (!$loan || $loan->status !== 'pending') {
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Permintaan tidak valid.']);
            return;
        }

        $book = $loan->book;
        if ($book->available_stock <= 0) {
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Stok buku tidak tersedia.']);
            return;
        }

        // Update loan
        $loan->update([
            'status' => 'active',
            'loan_date' => now()->toDateString(),
            'due_date' => now()->addDays(7)->toDateString(),
        ]);

        // Decrease available stock
        $book->decrement('available_stock');

        $this->dispatch('alert', ['type' => 'success', 'message' => "Peminjaman dari {$loan->user->name} disetujui."]);
    }

    public function rejectLoan($loanId)
    {
        $loan = Loan::with('user')->find($loanId);

        if (!$loan || $loan->status !== 'pending') {
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Permintaan tidak valid.']);
            return;
        }

        $loan->update(['status' => 'cancelled']);

        $this->dispatch('alert', ['type' => 'success', 'message' => "Peminjaman dari {$loan->user->name} ditolak."]);
    }

    public function returnLoan($loanId)
    {
        $loan = Loan::with('book', 'user')->find($loanId);

        if (!$loan || $loan->status !== 'active') {
            $this->dispatch('alert', ['type' => 'error', 'message' => 'Loan tidak aktif.']);
            return;
        }

        // Update loan
        $loan->update([
            'status' => 'returned',
            'return_date' => now()->toDateString(),
        ]);

        // Increase available stock
        $loan->book->increment('available_stock');

        $this->dispatch('alert', ['type' => 'success', 'message' => "Buku dari {$loan->user->name} berhasil dikembalikan."]);
    }

    public function render()
    {
        $query = Loan::with(['user', 'book'])->where('status', $this->filter);

        if ($this->search) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })->orWhereHas('book', function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.admin.loans.management', [
            'loans' => $query->latest()->paginate(15),
        ]);
    }
}
