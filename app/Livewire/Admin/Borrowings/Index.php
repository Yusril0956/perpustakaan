<?php

namespace App\Livewire\Admin\Borrowings;

use App\Enums\BorrowingStatus;
use App\Models\Borrowing;
use App\Services\BorrowingService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public function mount(): void
    {
        $this->authorize('viewAny', Borrowing::class);
    }

    #[On('return-book')]
    public function returnBook(int $borrowingId): void
    {
        $borrowing = Borrowing::with('book')->findOrFail($borrowingId);
        $this->authorize('return', $borrowing);

        try {
            $borrowingService = app(BorrowingService::class);
            $result = $borrowingService->returnBook($borrowing);

            if ($result['success']) {
                if (isset($result['warning']) && $result['warning']) {
                    session()->flash('warning', $result['message']);
                } else {
                    session()->flash('success', $result['message']);
                }
            } else {
                session()->flash('error', $result['message']);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function render()
    {
        $borrowings = Borrowing::with(['user', 'book'])
            ->whereIn('status', [BorrowingStatus::BORROWED->value, BorrowingStatus::OVERDUE->value])
            ->latest()
            ->paginate(10);

        return view('livewire.admin.borrowings.index', compact('borrowings'));
    }
}
