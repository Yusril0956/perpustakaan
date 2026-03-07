<?php

namespace App\Livewire\Guest;

use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('layouts.guest')]
class BookExplorer extends Component
{
    use WithPagination;

    #[Url]
    public string $currentTab = 'all';

    #[Url]
    public ?int $selectedCategory = null;

    #[Url(history: true)]
    public string $search = '';

    public ?Book $selectedBook = null;

    public function updated(string $property): void
    {
        if (in_array($property, ['currentTab', 'selectedCategory', 'search'])) {
            $this->resetPage();
        }
    }

    public function setTab(string $tab): void
    {
        $this->currentTab = $tab;
        $this->selectedCategory = null;
        $this->search = '';
        $this->resetPage();
    }

    public function setCategory(int $id): void
    {
        $this->selectedCategory = $id;
        $this->currentTab = 'category';
        $this->resetPage();
    }

    public function loadBookDetail(int $bookId): void
    {
        $this->selectedBook = Book::with('category')->find($bookId);
        $this->dispatch('open-book-modal');
    }

    public function requestLoan(int $bookId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $book = Book::find($bookId);

        if (!$book) {
            session()->flash('error', 'Buku tidak ditemukan.');
            return;
        }

        // Gunakan exists() karena lebih ringan dibanding first() jika hanya butuh boolean
        $hasActiveLoan = Loan::where('user_id', Auth::id())
            ->where('book_id', $bookId)
            ->whereIn('status', ['borrowed', 'active', 'pending'])
            ->exists();

        if ($hasActiveLoan) {
            session()->flash('error', 'Anda sudah memiliki permintaan pinjam untuk buku ini.');
            return;
        }

        Loan::create([
            'user_id' => Auth::id(),
            'book_id' => $bookId,
            'booking_date' => now()->toDateString(),
            'status' => 'pending',
            'daily_fine_fee' => config('library.fines.daily', 5000), // Best practice: Hindari magic number
        ]);

        $this->dispatch('close-book-modal');
        session()->flash('success', 'Permintaan pinjam berhasil dikirim! Tunggu persetujuan admin.');

        return redirect()->route('member.dashboard');
    }

    public function render(): View
    {
        return view('livewire.guest.book-explorer', [
            'recommendedBooks' => $this->getRecommendedBooks(),
            'popularBooks' => $this->getPopularBooks(),
            'categories' => $this->getCategories(),
            'allBooks' => $this->getAllBooks(),
        ]);
    }

    /** --- Private Methods untuk Clean Code (Query Extract) --- */

    private function getRecommendedBooks()
    {
        return Book::take(3)->get();
    }

    private function getPopularBooks()
    {
        return Book::orderBy('available_stock', 'asc')->take(6)->get();
    }

    private function getCategories()
    {
        return Category::withCount('books')->get();
    }

    private function getAllBooks()
    {
        return Book::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('author', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->selectedCategory, function ($query) {
                $query->where('category_id', $this->selectedCategory);
            })
            ->latest()
            ->paginate(12);
    }
}