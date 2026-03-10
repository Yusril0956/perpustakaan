<?php

namespace App\Livewire\Admin\Books;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('layouts.app')]

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    #[On('delete-book')]
    public function delete($id)
    {
        Book::find($id)->delete();
        session()->flash('success', 'Buku berhasil dihapus dari arsip.');
    }

    public function render()
    {
        return view('livewire.admin.books.index', [
            'books' => Book::with('category')
                ->when($this->search, function ($query) {
                    $query->where(function ($q) {
                        $q->where('title', 'like', '%' . $this->search . '%')
                            ->orWhere('author', 'like', '%' . $this->search . '%');
                    });
                })
                ->latest()
                ->paginate(10)
        ]);
    }
}
