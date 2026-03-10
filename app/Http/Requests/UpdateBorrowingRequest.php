<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBorrowingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|required|exists:users,id',
            'book_id' => 'sometimes|required|exists:books,id',
            'borrowed_at' => 'sometimes|required|date',
            'due_at' => 'sometimes|required|date|after_or_equal:borrowed_at',
            'returned_at' => 'nullable|date',
            'status' => 'sometimes|required|string|in:PENDING,BORROWED,RETURNED,OVERDUE,CANCELLED',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'user_id.required' => 'Peminjam wajib dipilih.',
            'user_id.exists' => 'Pengguna tidak ditemukan.',
            'book_id.required' => 'Buku wajib dipilih.',
            'book_id.exists' => 'Buku tidak ditemukan.',
            'borrowed_at.required' => 'Tanggal peminjaman wajib diisi.',
            'borrowed_at.date' => 'Format tanggal peminjaman tidak valid.',
            'due_at.required' => 'Tanggal jatuh tempo wajib diisi.',
            'due_at.date' => 'Format tanggal jatuh tempo tidak valid.',
            'due_at.after_or_equal' => 'Tanggal jatuh tempo harus sama atau setelah tanggal peminjaman.',
            'returned_at.date' => 'Format tanggal pengembalian tidak valid.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ];
    }
}

