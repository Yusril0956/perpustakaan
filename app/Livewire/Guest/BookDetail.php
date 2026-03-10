<?php

namespace App\Livewire\Guest;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
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
            return;
        }

        // Check if user has 'anggota' role
        if (!$user->hasRole('anggota')) {
            $this->canBorrow = false;
            return;
        }

        // Check if book is available
        if (!$this->book || !$this->book->is_available || $this->book->total_stock <= 0) {
            $this->canBorrow = false;
            return;
        }

        // Check if user already has this book borrowed
        $existingBorrowing = Borrowing::where('user_id', $user->id)
            ->where('book_id', $this->book->id)
            ->whereNull('returned_at')
            ->exists();

        if ($existingBorrowing) {
            $this->canBorrow = false;
            return;
        }

        // Check if user has 'borrow books' permission
        if (!$user->hasPermissionTo('borrow books')) {
            $this->canBorrow = false;
            return;
        }

        $this->canBorrow = true;
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

        // Check book availability
        if (!$this->book || !$this->book->is_available || $this->book->total_stock <= 0) {
            session()->flash('error', 'Buku tidak tersedia untuk dipinjam.');
            return;
        }

        // Check if already borrowed
        $existingBorrowing = Borrowing::where('user_id', $user->id)
            ->where('book_id', $this->book->id)
            ->whereNull('returned_at')
            ->exists();

        if ($existingBorrowing) {
            session()->flash('error', 'Anda sudah meminjam buku ini.');
            return;
        }

        // Check permission
        if (!$user->hasPermissionTo('borrow books')) {
            session()->flash('error', 'Anda tidak memiliki izin untuk meminjam buku.');
            return;
        }

        // Create borrowing record
        Borrowing::create([
            'user_id' => $user->id,
            'book_id' => $this->book->id,
            'borrowed_at' => now(),
            'due_at' => now()->addDays(7),
            'status' => 'BORROWED',
        ]);

        // Update book availability
        $this->book->decrement('total_stock');
        if ($this->book->total_stock <= 0) {
            $this->book->update(['is_available' => false]);
        }

        // Refresh data
        $this->loadBook();
        $this->checkBorrowStatus();

        session()->flash('success', 'Buku berhasil dipinjam! Silakan ambil di perpustakaan.');
    }

    public function render(): View
    {
        return view('livewire.guest.book-detail');
    }
}

