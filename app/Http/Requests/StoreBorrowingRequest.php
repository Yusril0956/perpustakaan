<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBorrowingRequest extends FormRequest
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
        return [
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrowed_at' => 'required|date',
            'due_at' => 'required|date|after_or_equal:borrowed_at',
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
            'user_id.required' => 'Peminjam harus dipilih.',
            'user_id.exists' => 'Peminjam tidak valid.',
            'book_id.required' => 'Buku harus dipilih.',
            'book_id.exists' => 'Buku tidak valid.',
            'borrowed_at.required' => 'Tanggal peminjaman wajib diisi.',
            'borrowed_at.date' => 'Format tanggal peminjaman tidak valid.',
            'due_at.required' => 'Tanggal jatuh tempo wajib diisi.',
            'due_at.date' => 'Format tanggal jatuh tempo tidak valid.',
            'due_at.after_or_equal' => 'Tanggal jatuh tempo harus sama atau setelah tanggal peminjaman.',
        ];
    }
}
