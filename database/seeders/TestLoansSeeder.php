<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestLoansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create multiple test users
        $users = User::factory()->count(5)->create();

        // Create multiple books if they don't exist
        $books = Book::all();
        if ($books->count() < 10) {
            $books = Book::factory()->count(10)->create();
        }

        foreach ($users as $user) {
            // Active loan (approved, currently borrowed)
            Loan::create([
                'user_id' => $user->id,
                'book_id' => $books->random()->id,
                'booking_date' => now()->subDays(5),
                'loan_date' => now()->subDays(3),
                'due_date' => now()->addDays(4), // 7 days from loan_date
                'status' => 'active',
                'daily_fine_fee' => 5000,
            ]);

            // Pending loan (waiting for approval)
            Loan::create([
                'user_id' => $user->id,
                'book_id' => $books->random()->id,
                'booking_date' => now()->subHours(12),
                'status' => 'pending',
                'daily_fine_fee' => 5000,
            ]);

            // Returned loan (already returned)
            Loan::create([
                'user_id' => $user->id,
                'book_id' => $books->random()->id,
                'booking_date' => now()->subDays(20),
                'loan_date' => now()->subDays(15),
                'due_date' => now()->subDays(8),
                'return_date' => now()->subDays(7),
                'status' => 'returned',
                'daily_fine_fee' => 5000,
            ]);

            // Overdue loan (if it exists, past due date)
            if (rand(0, 1)) {
                Loan::create([
                    'user_id' => $user->id,
                    'book_id' => $books->random()->id,
                    'booking_date' => now()->subDays(15),
                    'loan_date' => now()->subDays(12),
                    'due_date' => now()->subDays(2), // Already past due
                    'status' => 'active',
                    'daily_fine_fee' => 5000,
                ]);
            }
        }
    }
}
