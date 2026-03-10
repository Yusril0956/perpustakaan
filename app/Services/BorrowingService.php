<?php

namespace App\Services;

use App\Events\BookBorrowed;
use App\Events\BookReturned;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Fine;
use App\Enums\BorrowingStatus;
use App\Enums\FineStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BorrowingService
{
    /**
     * Borrow a book for a user
     * Uses DB locking to prevent race conditions
     */
    public function borrowBook(Book $book, int $userId): array
    {
        // Validate book availability
        if (!$book->is_available || $book->available_stock <= 0) {
            return [
                'success' => false,
                'message' => 'Buku tidak tersedia untuk dipinjam.',
            ];
        }

        // Check if user already has this book
        $existingBorrowing = Borrowing::where('user_id', $userId)
            ->where('book_id', $book->id)
            ->whereNull('returned_at')
            ->exists();

        if ($existingBorrowing) {
            return [
                'success' => false,
                'message' => 'Anda sudah meminjam buku ini.',
            ];
        }

        try {
            $borrowing = null;

            DB::transaction(function () use ($book, $userId, &$borrowing) {
                // Lock the book row for update to prevent concurrent modifications
                $book = Book::lockForUpdate()->find($book->id);

                // Double-check availability after locking
                if (!$book->is_available || $book->available_stock <= 0) {
                    throw new \Exception('Buku tidak tersedia untuk dipinjam.');
                }

                // Create borrowing record
                $borrowing = Borrowing::create([
                    'user_id' => $userId,
                    'book_id' => $book->id,
                    'borrowed_at' => now(),
                    'due_at' => now()->addDays(config('library.borrow_duration_days', 7)),
                    'status' => BorrowingStatus::BORROWED->value,
                ]);

                // Update book stock
                $book->decrement('available_stock');

                if ($book->available_stock <= 0) {
                    $book->update(['is_available' => false]);
                }
            });

            // Dispatch event after successful transaction
            if ($borrowing) {
                event(new BookBorrowed($borrowing));
            }

            return [
                'success' => true,
                'message' => 'Buku berhasil dipinjam! Silakan ambil di perpustakaan.',
            ];
        } catch (\Exception $e) {
            Log::error('Borrow book failed: ' . $e->getMessage());

            return [
                'success' => false,
                'message' => $e->getMessage() ?: 'Terjadi kesalahan. Silakan coba lagi.',
            ];
        }
    }

    /**
     * Return a borrowed book
     * Uses DB locking to prevent race conditions
     */
    public function returnBook(Borrowing $borrowing): array
    {
        if ($borrowing->returned_at) {
            return [
                'success' => false,
                'message' => 'Buku sudah dikembalikan.',
            ];
        }

        $hasFine = false;
        $fineMessage = '';
        $returnedBorrowing = null;

        try {
            DB::transaction(function () use ($borrowing, &$hasFine, &$fineMessage, &$returnedBorrowing) {
                $now = now();
                $dueAt = \Carbon\Carbon::parse($borrowing->due_at);

                // Lock the book row for update
                $book = Book::lockForUpdate()->find($borrowing->book_id);

                // Mark as returned
                $borrowing->update([
                    'returned_at' => $now,
                    'status' => BorrowingStatus::RETURNED->value,
                ]);

                $returnedBorrowing = $borrowing->fresh();

                // Restore book availability
                $book->increment('available_stock');
                if ($book->available_stock > 0) {
                    $book->update(['is_available' => true]);
                }

                // Create fine if overdue (check after locking)
                if ($now->greaterThan($dueAt)) {
                    $daysOverdue = (int) $now->startOfDay()->diffInDays($dueAt->startOfDay());
                    $fineAmount = $daysOverdue * config('library.fine_rate_per_day', 1000);

                    Fine::create([
                        'borrowing_id' => $borrowing->id,
                        'amount' => $fineAmount,
                        'status' => FineStatus::UNPAID->value,
                    ]);

                    $hasFine = true;
                    $fineMessage = "Buku dikembalikan terlambat {$daysOverdue} hari. Denda Rp " . number_format($fineAmount, 0, ',', '.') . " telah dicatat.";
                }
            });

            // Dispatch event after successful transaction
            if ($returnedBorrowing) {
                event(new BookReturned($returnedBorrowing));
            }

            // Return response AFTER transaction completes
            if ($hasFine) {
                return [
                    'success' => true,
                    'warning' => true,
                    'message' => $fineMessage,
                ];
            }

            return [
                'success' => true,
                'message' => 'Buku berhasil dikembalikan. Tidak ada denda.',
            ];
        } catch (\Exception $e) {
            Log::error('Return book failed: ' . $e->getMessage());

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan. Silakan coba lagi.',
            ];
        }
    }

    /**
     * Check if user can borrow more books
     */
    public function canUserBorrow(int $userId): bool
    {
        $maxBorrow = config('library.max_borrow_limit', 3);
        $currentBorrows = Borrowing::where('user_id', $userId)
            ->whereNull('returned_at')
            ->count();

        return $currentBorrows < $maxBorrow;
    }

    /**
     * Get user's active borrowings count
     */
    public function getActiveBorrowingsCount(int $userId): int
    {
        return Borrowing::where('user_id', $userId)
            ->whereNull('returned_at')
            ->count();
    }
}

