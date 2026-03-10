<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Authorization is handled by Livewire component or policy
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $bookId = $this->route('book');

        return [
            'title' => 'required|min:3|max:255',
            'author' => 'required|max:255',
            'isbn' => ['nullable', Rule::unique('books', 'isbn')->ignore($bookId)],
            'category_id' => 'required|exists:categories,id',
            'total_stock' => 'required|numeric|min:1',
            'description' => 'nullable|min:10',
            'cover_image' => 'nullable|image|max:2048',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Judul buku wajib diisi.',
            'title.min' => 'Judul buku minimal 3 karakter.',
            'title.max' => 'Judul buku maksimal 255 karakter.',
            'author.required' => 'Penulis wajib diisi.',
            'author.max' => 'Nama penulis maksimal 255 karakter.',
            'isbn.unique' => 'ISBN sudah terdaftar.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori tidak valid.',
            'total_stock.required' => 'Stok total wajib diisi.',
            'total_stock.numeric' => 'Stok harus berupa angka.',
            'total_stock.min' => 'Stok minimal 1.',
            'description.min' => 'Deskripsi minimal 10 karakter.',
            'cover_image.image' => 'File cover harus berupa gambar.',
            'cover_image.max' => 'Ukuran cover maksimal 2MB.',
        ];
    }
}
