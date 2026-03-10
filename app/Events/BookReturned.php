<?php

namespace App\Events;

use App\Models\Borrowing;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookReturned
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Borrowing $borrowing,
        public bool $hasFine = false,
        public ?int $fineAmount = null
    ) {
    }
}

