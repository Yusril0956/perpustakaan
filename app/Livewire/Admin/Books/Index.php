<?php

namespace App\Livewire\Admin\Books;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        Book::find($id)->delete();
        session()->flash('success', 'Buku berhasil dihapus dari arsip.');
    }

    public function render()
    {
        return view('livewire.admin.books.index', [
            'books' => Book::with('category')
                ->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('author', 'like', '%' . $this->search . '%')
                ->latest()
                ->paginate(10)
        ]);
    }
}