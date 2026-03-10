<?php

namespace App\Enums;

enum FineStatus: string
{
    case UNPAID = 'UNPAID';
    case PAID = 'PAID';
    case WAIVED = 'WAIVED';

    /**
     * Get the label for display purposes
     */
    public function label(): string
    {
        return match ($this) {
            self::UNPAID => 'Belum Lunas',
            self::PAID => 'Lunas',
            self::WAIVED => 'Dihapuskan',
        };
    }

    /**
     * Check if the fine is still pending payment
     */
    public function isPending(): bool
    {
        return $this === self::UNPAID;
    }
}

