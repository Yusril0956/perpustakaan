<?php

namespace App\Livewire\Guest;

use App\Models\Book;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class BookExplorer extends Component
{
    use WithPagination;

    public $currentTab = 'all';
    public $selectedCategory = null;

    public function updated($property)
    {
        if (in_array($property, ['currentTab', 'selectedCategory'])) {
            $this->resetPage();
        }
    }

    public function setTab($tab)
    {
        $this->currentTab = $tab;
        $this->selectedCategory = null;
    }

    public function setCategory($id)
    {
        $this->selectedCategory = $id;
        $this->currentTab = 'category';
    }

    public function render()
    {
        return view('livewire.guest.book-explorer', [
            'recommendedBooks' => Book::where('is_recommended', true)->take(3)->get(),
            'popularBooks' => Book::orderBy('view_count', 'desc')->take(6)->get(),
            'categories' => Category::withCount('books')->get(),
            // Data untuk grid utama di bawah
            'allBooks' => Book::latest()->paginate(8),
        ]);
    }
}