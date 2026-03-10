<?php

namespace App\Livewire\Admin\Books;

use App\Models\Category;
use App\Models\Book;
use App\Livewire\Forms\Admin\Books\BookForm;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class Create extends Component
{
    use WithFileUploads;

    public BookForm $form;

    public function mount(): void
    {
        $this->authorize('create', Book::class);
    }

    public function save()
    {
        $this->form->store();

        session()->flash('success', 'Buku berhasil didaftarkan ke dalam rak.');
        return $this->redirect(route('admin.books.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.books.create', [
            'categories' => Category::all()
        ]);
    }
}
