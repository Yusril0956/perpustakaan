<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Fine;
use App\Models\User;
use Illuminate\Database\Seeder;

class BorrowingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have members
        $members = User::role('anggota')->get();

        if ($members->isEmpty()) {
            $this->command->info('Tidak ada anggota. Silakan seed user terlebih dahulu.');
            return;
        }

        // Get available books
        $books = Book::where('is_available', true)->get();

        if ($books->isEmpty()) {
            $this->command->info('Tidak ada buku tersedia. Silakan seed buku terlebih dahulu.');
            return;
        }

        // Create various borrowing scenarios

        // 1. Active borrowings (currently borrowed, not overdue)
        Borrowing::factory()
            ->count(5)
            ->active()
            ->create();

        // 2. Active borrowings that are overdue
        Borrowing::factory()
            ->count(3)
            ->overdue()
            ->create();

        // 3. Returned borrowings (some on time, some late)
        Borrowing::factory()
            ->count(8)
            ->returned()
            ->create();

        // 4. Create some fines for overdue returns
        // Get borrowings that are returned but were overdue
        $overdueBorrowings = Borrowing::where('status', 'RETURNED')
            ->get()
            ->filter(function ($borrowing) {
                $returnedAt = \Carbon\Carbon::parse($borrowing->returned_at);
                $dueAt = \Carbon\Carbon::parse($borrowing->due_at);
                return $borrowing->returned_at &&
                    $returnedAt->greaterThan($dueAt);
            });

        // Create fines for 50% of overdue returns
        $fineCount = (int) ($overdueBorrowings->count() * 0.5);

        // Get random returned borrowings to create fines for
        $returnedBorrowings = Borrowing::where('status', 'RETURNED')
            ->inRandomOrder()
            ->take($fineCount)
            ->get();

        foreach ($returnedBorrowings as $borrowing) {
            $borrowedAt = \Carbon\Carbon::parse($borrowing->borrowed_at);
            $dueAt = \Carbon\Carbon::parse($borrowing->due_at);
            $daysOverdue = $borrowedAt->diffInDays($dueAt);
            $amount = $daysOverdue * 1000;

            Fine::create([
                'borrowing_id' => $borrowing->id,
                'amount' => $amount,
                'status' => rand(0, 1) ? 'PAID' : 'UNPAID',
                'paid_at' => rand(0, 1) ? now()->subDays(rand(1, 10)) : null,
            ]);
        }

        // Create some standalone unpaid fines
        Fine::factory()
            ->count(3)
            ->unpaid()
            ->create();

        Fine::factory()
            ->count(5)
            ->paid()
            ->create();

        $this->command->info('Seeder peminjaman dan denda berhasil dibuat!');
        $this->command->info('Total peminjaman: ' . Borrowing::count());
        $this->command->info('Total denda: ' . Fine::count());
    }
}
