<?php

namespace Database\Factories;

use App\Models\Borrowing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fine>
 */
class FineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $borrowing = Borrowing::inRandomOrder()->first() ?? Borrowing::factory();

        // Fine amount based on days overdue
        $daysOverdue = rand(1, 30);
        $amount = $daysOverdue * 1000; // Rp 1,000 per day

        // 60% chance of being paid
        $isPaid = fake()->boolean(60);
        $paidAt = $isPaid ? fake()->dateTimeBetween('-1 month', 'now') : null;

        $status = $isPaid ? 'PAID' : 'UNPAID';

        return [
            'borrowing_id' => $borrowing->id,
            'amount' => $amount,
            'status' => $status,
            'paid_at' => $paidAt,
        ];
    }

    /**
     * Indicate that the fine is unpaid.
     */
    public function unpaid(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'UNPAID',
            'paid_at' => null,
        ]);
    }

    /**
     * Indicate that the fine is paid.
     */
    public function paid(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => 'PAID',
            'paid_at' => now(),
        ]);
    }
}
