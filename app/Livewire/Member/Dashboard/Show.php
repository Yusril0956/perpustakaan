<?php

namespace App\Livewire\Member\Dashboard;

use App\Models\User;
use App\Models\Borrowing;
use App\Models\Fine;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Show extends Component
{
    public function render()
    {
        $user = auth()->user();

        $activeBorrowings = Borrowing::where('user_id', $user->id)
            ->whereNull('returned_at')
            ->count();

        $overdueBorrowings = Borrowing::where('user_id', $user->id)
            ->whereNull('returned_at')
            ->where('due_at', '<', now())
            ->count();

        $totalUnpaidFines = Fine::whereHas('borrowing', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->where('status', 'UNPAID')
            ->sum('amount');

        return view('livewire.member.dashboard.show', [
            'user' => $user,
            'activeBorrowings' => $activeBorrowings,
            'overdueBorrowings' => $overdueBorrowings,
            'totalUnpaidFines' => $totalUnpaidFines,
        ]);
    }
}
