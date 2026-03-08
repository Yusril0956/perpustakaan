<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrowing>
 */
class BorrowingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::role('anggota')->inRandomOrder()->first() ?? User::factory();
        $book = Book::where('is_available', true)->inRandomOrder()->first() ?? Book::factory();

        $borrowedAt = fake()->dateTimeBetween('-2 months', 'now');
        $dueAt = (clone $borrowedAt)->modify('+7 days');

        // 30% chance of being returned
        $isReturned = fake()->boolean(30);
        $returnedAt = $isReturned ? fake()->dateTimeBetween($borrowedAt, $dueAt->modify('+1 day')) : null;

        // If returned after due date, it's overdue
        $status = $isReturned ? 'RETURNED' : (
            now()->greaterThan($dueAt) ? 'OVERDUE' : 'BORROWED'
        );

        return [
            'user_id' => $user->id,
            'book_id' => $book->id,
            'borrowed_at' => $borrowedAt,
            'due_at' => $dueAt,
            'returned_at' => $returnedAt,
            'status' => $status,
        ];
    }

    /**
     * Indicate that the borrowing is returned.
     */
    public function returned(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'RETURNED',
            'returned_at' => now(),
        ]);
    }

    /**
     * Indicate that the borrowing is overdue.
     */
    public function overdue(): static
    {
        return $this->state(fn(array $attributes) => [
            'borrowed_at' => now()->subDays(10),
            'due_at' => now()->subDays(3),
            'returned_at' => null,
            'status' => 'OVERDUE',
        ]);
    }

    /**
     * Indicate that the borrowing is currently borrowed (not returned).
     */
    public function active(): static
    {
        return $this->state(fn(array $attributes) => [
            'borrowed_at' => now()->subDays(rand(1, 5)),
            'due_at' => now()->addDays(rand(1, 7)),
            'returned_at' => null,
            'status' => 'BORROWED',
        ]);
    }
}
