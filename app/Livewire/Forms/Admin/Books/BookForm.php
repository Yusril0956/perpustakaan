<?php

namespace App\Livewire\Forms\Admin\Books;

use App\Models\Book;
use Livewire\Form;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rule;

class BookForm extends Form
{
    public ?Book $book = null;

    #[Validate('required|min:3')]
    public $title = '';

    #[Validate('required')]
    public $author = '';

    #[Validate('nullable|unique:books,isbn')]
    public $isbn = '';

    #[Validate('required|exists:categories,id')]
    public $category_id = '';

    #[Validate('required|numeric|min:1')]
    public $total_stock = '';

    #[Validate('nullable|image|max:2048')] // Maksimal 2MB
    public $cover_image;

    #[Validate('nullable|min:10')]
    public $description = '';

    public function setBook(?Book $book = null)
    {
        $this->book = $book;

        if ($book) {
            $this->title = $book->title;
            $this->author = $book->author;
            $this->isbn = $book->isbn ?? '';
            $this->category_id = $book->category_id;
            $this->total_stock = $book->total_stock;
            $this->description = $book->description ?? '';
            $this->cover_image = null;
        }
    }

    public function store()
    {
        $this->validate($this->rules());

        $data = $this->all();
        $data['available_stock'] = $this->total_stock;

        if ($this->cover_image) {
            $data['cover_image'] = $this->cover_image->store('covers', 'public');
        }

        Book::create($data);
    }

    public function update()
    {
        $this->validate($this->rules());

        $data = $this->except(['book', 'cover_image']);

        if ($this->cover_image) {
            $data['cover_image'] = $this->cover_image->store('covers', 'public');
        }

        $this->book->update($data);
    }

    protected function rules()
    {
        $rules = [
            'title' => 'required|min:3',
            'author' => 'required',
            'category_id' => 'required|exists:categories,id',
            'total_stock' => 'required|numeric|min:1',
            'description' => 'nullable|min:10',
            'cover_image' => 'nullable|image|max:2048',
        ];

        // If editing, make ISBN validation unique excluding current book
        if ($this->book) {
            $rules['isbn'] = ['nullable', Rule::unique('books', 'isbn')->ignore($this->book->id)];
        } else {
            $rules['isbn'] = 'nullable|unique:books,isbn';
        }

        return $rules;
    }
}