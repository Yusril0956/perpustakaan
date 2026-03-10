<?php

namespace App\Models;

use App\Enums\FineStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $borrowing_id
 * @property int $amount
 * @property FineStatus $status
 * @property Carbon|null $paid_at
 */
class Fine extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrowing_id',
        'amount',
        'status',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'paid_at' => 'datetime',
            'status' => FineStatus::class,
        ];
    }

    /**
     * Get the borrowing that owns the fine.
     */
    public function borrowing(): BelongsTo
    {
        return $this->belongsTo(Borrowing::class);
    }

    /**
     * Check if fine is paid.
     */
    public function isPaid(): bool
    {
        return $this->status === FineStatus::PAID;
    }

    /**
     * Check if fine is unpaid.
     */
    public function isUnpaid(): bool
    {
        return $this->status === FineStatus::UNPAID;
    }

    /**
     * Mark fine as paid.
     */
    public function markAsPaid(): bool
    {
        return $this->update([
            'status' => FineStatus::PAID,
            'paid_at' => now(),
        ]);
    }

    /**
     * Get formatted amount.
     */
    public function getFormattedAmountAttribute(): string
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }
}
