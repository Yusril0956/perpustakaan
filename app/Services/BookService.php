<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookService
{
    /**
     * Get book by ID with caching
     */
    public function getBookById(int $bookId): ?Book
    {
        return Cache::remember("book.{$bookId}", 300, function () use ($bookId) {
            return Book::with('category')->find($bookId);
        });
    }

    /**
     * Check if book is available for borrowing
     */
    public function isAvailable(Book $book): bool
    {
        return $book->is_available && $book->available_stock > 0;
    }

    /**
     * Get available stock
     */
    public function getAvailableStock(Book $book): int
    {
        return $book->available_stock;
    }

    /**
     * Update book stock after borrowing
     */
    public function decrementStock(Book $book): bool
    {
        try {
            DB::transaction(function () use ($book) {
                $book->decrement('available_stock');

                if ($book->available_stock <= 0) {
                    $book->update(['is_available' => false]);
                }
            });

            $this->clearBookCache($book->id);
            return true;
        } catch (\Exception $e) {
            Log::error('Decrement stock failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Update book stock after returning
     */
    public function incrementStock(Book $book): bool
    {
        try {
            DB::transaction(function () use ($book) {
                $book->increment('available_stock');

                if ($book->available_stock > 0) {
                    $book->update(['is_available' => true]);
                }
            });

            $this->clearBookCache($book->id);
            return true;
        } catch (\Exception $e) {
            Log::error('Increment stock failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get low stock books
     */
    public function getLowStockBooks(int $threshold = null): \Illuminate\Database\Eloquent\Collection
    {
        $threshold = $threshold ?? config('library.low_stock_threshold', 2);

        return Book::where('available_stock', '<=', $threshold)
            ->where('available_stock', '>', 0)
            ->get();
    }

    /**
     * Get out of stock books
     */
    public function getOutOfStockBooks(): \Illuminate\Database\Eloquent\Collection
    {
        return Book::where('available_stock', '<=', 0)->get();
    }

    /**
     * Clear book cache
     */
    public function clearBookCache(int $bookId): void
    {
        Cache::forget("book.{$bookId}");
    }

    /**
     * Clear all book caches
     */
    public function clearAllBookCache(): void
    {
        Cache::forget('dashboard.stats');
        Cache::forget('dashboard.popular_books');
    }

    /**
     * Search books with filters
     */
    public function searchBooks(array $filters = []): \Illuminate\Database\Eloquent\Builder
    {
        $query = Book::with('category');

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('author', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (!empty($filters['is_available'])) {
            $query->where('is_available', $filters['is_available']);
        }

        return $query;
    }
}

