<?php

namespace App\Enums;

enum BorrowingStatus: string
{
    case BORROWED = 'BORROWED';
    case RETURNED = 'RETURNED';
    case OVERDUE = 'OVERDUE';

    /**
     * Get the label for display purposes
     */
    public function label(): string
    {
        return match ($this) {
            self::BORROWED => 'Dipinjam',
            self::RETURNED => 'Dikembalikan',
            self::OVERDUE => 'Terlambat',
        };
    }

    /**
     * Check if the status indicates the book is still borrowed
     */
    public function isActive(): bool
    {
        return $this === self::BORROWED || $this === self::OVERDUE;
    }
}

