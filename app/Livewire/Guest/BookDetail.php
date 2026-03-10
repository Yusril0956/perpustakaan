<?php

namespace App\Livewire\Guest;

use App\Enums\BorrowingStatus;
use App\Models\Book;
use App\Models\Borrowing;
use App\Services\BorrowingService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('layouts.guest')]
class BookDetail extends Component
{
    #[Url]
    public int $bookId = 0;

    public ?Book $book = null;

    public bool $canBorrow = false;

    public bool $hasBorrowed = false;

    public function mount(int $bookId): void
    {
        $this->bookId = $bookId;
        $this->loadBook();
        $this->checkBorrowStatus();
    }

    public function loadBook(): void
    {
        $this->book = Book::with('category')->find($this->bookId);

        if (!$this->book) {
            abort(404, 'Buku tidak ditemukan');
        }
    }

    public function checkBorrowStatus(): void
    {
        $user = Auth::user();

        if (!$user) {
            $this->canBorrow = false;
            $this->hasBorrowed = false;
            return;
        }

        // Check if user has 'anggota' role
        if (!$user->hasRole('anggota')) {
            $this->canBorrow = false;
            $this->hasBorrowed = false;
            return;
        }

        // Check if book is available
        if (!$this->book || !$this->book->is_available || $this->book->total_stock <= 0) {
            $this->canBorrow = false;
            $this->hasBorrowed = false;
            return;
        }

        // Check if user already has this book borrowed
        $existingBorrowing = Borrowing::where('user_id', $user->id)
            ->where('book_id', $this->book->id)
            ->whereNull('returned_at')
            ->exists();

        if ($existingBorrowing) {
            $this->canBorrow = false;
            $this->hasBorrowed = true;
            return;
        }

        // Check if user has 'borrow books' permission
        if (!$user->hasPermissionTo('borrow books')) {
            $this->canBorrow = false;
            $this->hasBorrowed = false;
            return;
        }

        $this->canBorrow = true;
        $this->hasBorrowed = false;
    }

    public function borrowBook(): void
    {
        $user = Auth::user();

        // Check authentication
        if (!$user) {
            session()->flash('error', 'Silakan login terlebih dahulu untuk meminjam buku.');
            $this->redirect(route('login'));
            return;
        }

        // Check role
        if (!$user->hasRole('anggota')) {
            session()->flash('error', 'Hanya anggota yang dapat meminjam buku.');
            return;
        }

        // Use BorrowingService to avoid code duplication and ensure proper locking
        try {
            $borrowingService = app(BorrowingService::class);
            $result = $borrowingService->borrowBook($this->book, $user->id);

            // Refresh data
            $this->book->refresh();
            $this->checkBorrowStatus();

            if ($result['success']) {
                session()->flash('success', $result['message']);
            } else {
                session()->flash('error', $result['message']);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function render(): View
    {
        return view('livewire.guest.book-detail');
    }
}

