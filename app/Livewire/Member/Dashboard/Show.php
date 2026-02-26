<?php

namespace App\Livewire\Member\Dashboard;

use App\Models\Loan;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Show extends Component
{
    public function render()
    {
        $user = auth()->user();

        // Get active loans
        $activeLoans = $user->loans()
            ->where('status', 'active')
            ->with('book')
            ->get();

        // Get pending requests
        $pendingLoans = $user->loans()
            ->where('status', 'pending')
            ->with('book')
            ->get();

        // Get recently returned
        $returnedLoans = $user->loans()
            ->where('status', 'returned')
            ->with('book')
            ->latest('return_date')
            ->take(5)
            ->get();

        // Calculate overdue loans
        $overdueLoans = $activeLoans->filter(function ($loan) {
            return $loan->due_date && now()->greaterThan($loan->due_date);
        });

        // Calculate total fines
        $totalFines = $overdueLoans->sum(function ($loan) {
            $daysOverdue = now()->diffInDays($loan->due_date);
            return $daysOverdue * $loan->daily_fine_fee;
        });

        return view('livewire.member.dashboard.show', [
            'user' => $user,
            'activeLoans' => $activeLoans,
            'pendingLoans' => $pendingLoans,
            'returnedLoans' => $returnedLoans,
            'overdueLoans' => $overdueLoans,
            'totalFines' => $totalFines,
        ]);
    }
}
