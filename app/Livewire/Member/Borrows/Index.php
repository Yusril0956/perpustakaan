<?php

namespace App\Livewire\Member\Borrows;

use App\Models\Borrowing;
use Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Http\Request;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $status = '';

    public function mount()
    {
        // Get status from query string
        $this->status = request()->query('status', '');
    }

    public function render()
    {
        $query = Borrowing::with(['book'])
            ->where('user_id', Auth::id());

        // Apply filters
        if ($this->status === 'active') {
            $query->whereNull('returned_at');
        } elseif ($this->status === 'returned') {
            $query->whereNotNull('returned_at');
        } elseif ($this->status === 'overdue') {
            $query->whereNull('returned_at')
                ->where('due_at', '<', now());
        }

        $borrowings = $query->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('livewire.member.borrows.index', [
            'borrowings' => $borrowings,
        ]);
    }
}
