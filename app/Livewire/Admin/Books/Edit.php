<?php

namespace App\Livewire\Admin\Books;

use App\Models\Book;
use App\Livewire\Forms\Admin\Books\BookForm;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Category;

#[Layout('layouts.app')]

class Edit extends Component
{
    use WithFileUploads;

    public BookForm $form;

    public function mount(Book $book)
    {
        $this->form->setBook($book);
    }

    public function save()
    {
        $this->form->update();

        session()->flash('message', 'Buku berhasil diperbarui.');
        return $this->redirect(route('admin.books.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.books.edit', [
            'categories' => Category::all()
        ]);
    }
}
