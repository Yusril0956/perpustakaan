<?php

namespace App\Models;

use App\Enums\BorrowingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * @property int $user_id
 * @property int $book_id
 * @property Carbon|null $borrowed_at
 * @property Carbon|null $due_at
 * @property Carbon|null $returned_at
 * @property BorrowingStatus $status
 */
class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'due_at',
        'returned_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'borrowed_at' => 'datetime',
            'due_at' => 'datetime',
            'returned_at' => 'datetime',
            'status' => BorrowingStatus::class,
        ];
    }

    /**
     * Get the user that owns the borrowing.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the book that owns the borrowing.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get the fine for the borrowing.
     */
    public function fine(): HasOne
    {
        return $this->hasOne(Fine::class);
    }

    /**
     * Check if borrowing is overdue.
     */
    public function isOverdue(): bool
    {
        return $this->returned_at === null
            && $this->due_at !== null
            && now()->greaterThan($this->due_at);
    }

    /**
     * Check if borrowing is active (not returned).
     */
    public function isActive(): bool
    {
        return $this->returned_at === null;
    }

    /**
     * Get days until due (negative if overdue).
     */
    public function getDaysUntilDueAttribute(): int
    {
        if ($this->returned_at) {
            return 0;
        }

        return (int) now()->startOfDay()->diffInDays($this->due_at->startOfDay(), false);
    }

    /**
     * Get the fine amount if overdue.
     */
    public function calculateFine(): int
    {
        if (!$this->isOverdue()) {
            return 0;
        }

        $daysOverdue = (int) now()->startOfDay()->diffInDays($this->due_at->startOfDay());
        return $daysOverdue * config('library.fine_rate_per_day', 1000);
    }
}
