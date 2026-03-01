<?php

namespace App\Livewire\Guest;

use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('layouts.guest')]
class BookExplorer extends Component
{
    use WithPagination;

    // Menyimpan state di URL agar user bisa membagikan link hasil pencariannya
    #[Url]
    public $currentTab = 'all';

    #[Url]
    public $selectedCategory = null;

    #[Url(history: true)]
    public $search = '';

    public $selectedBook = null;

    // Reset halaman otomatis saat properti ini berubah
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
        $this->resetPage();
    }

    public function setCategory($id)
    {
        $this->selectedCategory = $id;
        $this->currentTab = 'category';
        $this->resetPage();
    }

    // Mengambil data buku, lalu menyuruh Alpine.js membuka modal
    public function loadBookDetail($bookId)
    {
        $this->selectedBook = Book::with('category')->find($bookId);
        $this->dispatch('open-book-modal'); // Trigger Alpine.js
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

        // Cek apakah user sudah memiliki pinjaman aktif untuk buku ini
        $existingLoan = Loan::where('user_id', auth()->id())
            ->where('book_id', $bookId)
            ->whereIn('status', ['borrowed', 'active', 'pending'])
            ->first();

        if ($existingLoan) {
            session()->flash('error', 'Anda sudah memiliki permintaan pinjam untuk buku ini.');
            return;
        }

        Loan::create([
            'user_id' => auth()->id(),
            'book_id' => $bookId,
            'booking_date' => now()->toDateString(),
            'status' => 'pending',
            'daily_fine_fee' => 5000,
        ]);

        $this->dispatch('close-book-modal'); // Tutup modal instan via Alpine
        session()->flash('success', 'Permintaan pinjam berhasil dikirim! Tunggu persetujuan admin.');

        return redirect()->route('member.dashboard');
    }

    public function render()
    {
        $query = Book::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('author', 'like', '%' . $this->search . '%');
            });
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