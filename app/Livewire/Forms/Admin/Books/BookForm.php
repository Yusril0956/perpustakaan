<?php

namespace App\Livewire\Forms\Admin\Books;

use App\Models\Book;
use Livewire\Form;
use Livewire\Attributes\Validate;

class BookForm extends Form
{
    #[Validate('required|min:3')]
    public $title = '';

    #[Validate('required')]
    public $author = '';

    #[Validate('required|exists:categories,id')]
    public $category_id = '';

    #[Validate('required|numeric|min:1')]
    public $total_stock = '';

    #[Validate('nullable|image|max:2048')] // Maksimal 2MB
    public $cover_image;

    #[Validate('nullable|min:10')]
    public $description = '';

    public function store()
    {
        $this->validate();

        $data = $this->all();
        $data['available_stock'] = $this->total_stock;

        if ($this->cover_image) {
            $data['cover_image'] = $this->cover_image->store('covers', 'public');
        }

        Book::create($data);
    }
}