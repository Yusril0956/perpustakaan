<?php

namespace App\Console\Commands;

use App\Enums\BorrowingStatus;
use App\Models\Borrowing;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckOverdueBorrowings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'borrowings:check-overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and update overdue borrowings status';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Checking for overdue borrowings...');

        // Find borrowings that are past due date and still marked as BORROWED
        $overdueBorrowings = Borrowing::where('status', BorrowingStatus::BORROWED->value)
            ->where('due_at', '<', now())
            ->get();

        if ($overdueBorrowings->isEmpty()) {
            $this->info('No overdue borrowings found.');
            return Command::SUCCESS;
        }

        $this->info("Found {$overdueBorrowings->count()} overdue borrowings.");

        // Update each borrowing to OVERDUE status
        $count = 0;
        foreach ($overdueBorrowings as $borrowing) {
            $borrowing->update([
                'status' => BorrowingStatus::OVERDUE->value,
            ]);
            $count++;

            Log::info("Borrowing ID {$borrowing->id} marked as OVERDUE", [
                'user_id' => $borrowing->user_id,
                'book_id' => $borrowing->book_id,
                'due_at' => $borrowing->due_at,
            ]);
        }

        $this->info("Updated {$count} borrowings to OVERDUE status.");

        return Command::SUCCESS;
    }
}

