<?php

namespace App\Livewire\Admin\Borrowings;

use App\Enums\BorrowingStatus;
use App\Models\Borrowing;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Create extends Component
{
    public $user_id;
    public $book_id;
    public $borrowed_at;
    public $due_at;

    public function mount(): void
    {
        $this->authorize('create', Borrowing::class);
        $this->borrowed_at = now()->format('Y-m-d');
        $this->due_at = now()->addDays(7)->format('Y-m-d');
    }

    public function save()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrowed_at' => 'required|date',
            'due_at' => 'required|date|after_or_equal:borrowed_at',
        ]);

        try {
            DB::transaction(function () {
                $book = Book::lockForUpdate()->find($this->book_id);

                // check buku tersedia atau tidak
                if (!$book->is_available || $book->available_stock <= 0) {
                    throw new \Exception('Buku tidak tersedia untuk dipinjam.');
                }

                // membuat record peminjaman
                Borrowing::create([
                    'user_id' => $this->user_id,
                    'book_id' => $this->book_id,
                    'borrowed_at' => $this->borrowed_at,
                    'due_at' => $this->due_at,
                    'status' => BorrowingStatus::BORROWED->value,
                ]);

                // Update book availability
                $book->decrement('available_stock');
                if ($book->available_stock <= 0) {
                    $book->update(['is_available' => false]);
                }
            });

            session()->flash('success', 'Peminjaman berhasil dicatat.');
            return $this->redirect(route('admin.borrowings.index'), navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage() ?: 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function render()
    {
        $users = User::role('anggota')->orderBy('name')->get();
        $books = Book::where('is_available', true)->orderBy('title')->get();

        return view('livewire.admin.borrowings.create', [
            'users' => $users,
            'books' => $books,
        ]);
    }
}
