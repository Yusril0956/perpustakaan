<?php

namespace App\Livewire\Member\Dashboard;

use App\Models\User;
use App\Models\Borrowing;
use App\Models\Fine;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Cache;

#[Layout('layouts.app')]
class Show extends Component
{
    public function render(): View
    {
        $user = auth()->user();
        $userId = $user->id;

        // Cache user-specific stats for 2 minutes
        $stats = Cache::remember("member.dashboard.stats.{$userId}", 120, function () use ($user) {
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

            return compact('activeBorrowings', 'overdueBorrowings', 'totalUnpaidFines');
        });

        return view('livewire.member.dashboard.show', [
            'user' => $user,
            'activeBorrowings' => $stats['activeBorrowings'],
            'overdueBorrowings' => $stats['overdueBorrowings'],
            'totalUnpaidFines' => $stats['totalUnpaidFines'],
        ]);
    }
}
