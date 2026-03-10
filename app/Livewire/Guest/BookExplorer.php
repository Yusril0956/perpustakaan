<?php

namespace App\Livewire\Guest;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
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
        $this->redirect(route('book.detail', $bookId));
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

    /** --- Private Methods dengan Caching untuk Performance --- */

    private function getRecommendedBooks(): Collection
    {
        // Cache recommended books for 10 minutes
        return Cache::remember('books.recommended', 600, function () {
            return Book::with('category')->take(3)->get();
        });
    }

    private function getPopularBooks(): Collection
    {
        // Cache popular books for 10 minutes - order by borrow count via relationship
        return Cache::remember('books.popular', 600, function () {
            return Book::with('category')
                ->withCount('borrowings')
                ->orderByDesc('borrowings_count')
                ->take(6)
                ->get();
        });
    }

    private function getCategories(): Collection
    {
        // Cache categories for 30 minutes
        return Cache::remember('categories.all', 1800, function () {
            return Category::withCount('books')->get();
        });
    }

    private function getAllBooks()
    {
        return Book::query()
            ->with('category')
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
