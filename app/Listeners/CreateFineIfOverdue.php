<?php

namespace App\Listeners;

use App\Events\BookReturned;
use App\Models\Fine;
use App\Enums\FineStatus;
use Illuminate\Support\Facades\Log;

class CreateFineIfOverdue
{
    /**
     * Handle the event.
     */
    public function handle(BookReturned $event): void
    {
        if ($event->hasFine && $event->fineAmount > 0) {
            // Fine is already created in the service, this is for additional handling
            // like sending notification, etc.
            Log::info("Fine created for borrowing ID: {$event->borrowing->id}, Amount: {$event->fineAmount}");
        }
    }
}

