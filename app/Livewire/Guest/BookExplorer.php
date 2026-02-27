<?php

namespace App\Livewire\Guest;

use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class BookExplorer extends Component
{
    use WithPagination;

    public $currentTab = 'all';
    public $selectedCategory = null;
    public $selectedBook = null;
    public $search = '';
    public $showDetailModal = false;

    public function updated($property)
    {
        if (in_array($property, ['currentTab', 'selectedCategory', 'search'])) {
            $this->resetPage();
        }
    }

    public function setTab($tab)
    {
        $this->currentTab = $tab;
        $this->selectedCategory = null;
        $this->search = '';
    }

    public function setCategory($id)
    {
        $this->selectedCategory = $id;
        $this->currentTab = 'category';
    }

    public function showDetail($bookId)
    {
        $this->selectedBook = Book::with('category')->find($bookId);
        $this->showDetailModal = true;
    }

    public function closeDetail()
    {
        $this->showDetailModal = false;
        $this->selectedBook = null;
    }

    public function requestLoan($bookId)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $book = Book::find($bookId);

        if (!$book) {
            session()->flash('error', 'Buku tidak ditemukan.');
            return;
        }

        // Check if user already has active/pending loan of this book
        $existingLoan = Loan::where('user_id', auth()->id())
            ->where('book_id', $bookId)
            ->whereIn('status', ['borrowed', 'active', 'pending'])
            ->first();

        if ($existingLoan) {
            session()->flash('error', 'Anda sudah memiliki permintaan pinjam untuk buku ini.');
            return;
        }

        // Create new loan with pending status
        Loan::create([
            'user_id' => auth()->id(),
            'book_id' => $bookId,
            'booking_date' => now()->toDateString(),
            'status' => 'pending',
            'daily_fine_fee' => 5000,
        ]);

        $this->closeDetail();
        session()->flash('success', 'Permintaan pinjam berhasil dikirim! Tunggu persetujuan admin.');
        return redirect()->route('member.dashboard');
    }

    public function render()
    {
        $query = Book::query();

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('author', 'like', '%' . $this->search . '%');
        }

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        return view('livewire.guest.book-explorer', [
            'recommendedBooks' => Book::take(3)->get(),
            'popularBooks' => Book::orderBy('available_stock', 'asc')->take(6)->get(),
            'categories' => Category::withCount('books')->get(),
            'allBooks' => $query->latest()->paginate(12),
        ]);
    }
}