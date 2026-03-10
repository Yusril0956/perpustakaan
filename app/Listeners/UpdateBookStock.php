<?php

namespace App\Listeners;

use App\Events\BookBorrowed;
use App\Events\BookReturned;
use Illuminate\Support\Facades\Log;

class UpdateBookStock
{
    /**
     * Handle the event.
     */
    public function handle(BookBorrowed|BookReturned $event): void
    {
        $book = $event->borrowing->book;

        if ($event instanceof BookBorrowed) {
            // Book was borrowed - decrement stock handled in service
            Log::info("Book borrowed: {$book->title} (ID: {$book->id})");
        } elseif ($event instanceof BookReturned) {
            // Book was returned - stock increment handled in service
            Log::info("Book returned: {$book->title} (ID: {$book->id})");
        }

        // Clear dashboard cache after stock change
        cache()->forget('dashboard.stats');
        cache()->forget('dashboard.popular_books');
    }
}

