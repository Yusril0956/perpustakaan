<?php

namespace App\Livewire\Member\Loans;

use App\Models\Book;
use App\Models\Loan;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class Index extends Component
{
    public $loans = [];
    public $selectedBook = null;
    public $showDetailModal = false;

    public function mount()
    {
        $this->loadLoans();
    }

    public function loadLoans()
    {
        $this->loans = Loan::where('user_id', Auth::id())
            ->whereIn('status', ['active', 'pending'])
            ->with('book')
            ->orderBy('due_date', 'asc')
            ->get();
    }

    public function showDetail($loanId)
    {
        $loan = Loan::with('book.category')->find($loanId);
        if ($loan && $loan->book) {
            $this->selectedBook = $loan->book;
            $this->showDetailModal = true;
        }
    }

    public function closeDetail()
    {
        $this->showDetailModal = false;
        $this->selectedBook = null;
    }

    public function render()
    {
        return view('livewire.member.loans.index', [
            'loans' => $this->loans
        ]);
    }
}
