<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Show extends Component
{
    public function mount()
    {
        // Check if user is admin
        if (!auth()->user() || !auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }
    }

    public function render()
    {
        // Total Statistics
        $totalUsers = User::role('anggota')->count();
        $totalBooks = Book::count();
        $totalLoans = Loan::count();

        // Active Loans Count
        $activeLoans = Loan::where('status', 'active')->count();
        $pendingLoans = Loan::where('status', 'pending')->count();
        $returnedLoans = Loan::where('status', 'returned')->count();
        $overdueLoans = Loan::where('status', 'active')
            ->whereDate('due_date', '<', now())
            ->count();

        // Book Statistics
        $lowStockBooks = Book::where('available_stock', '<=', 2)
            ->where('available_stock', '>', 0)
            ->count();
        $outOfStockBooks = Book::where('available_stock', '<=', 0)->count();

        // Recent Activities
        $recentLoans = Loan::with(['user', 'book'])
            ->latest()
            ->take(8)
            ->get();

        $recentReturns = Loan::where('status', 'returned')
            ->with(['user', 'book'])
            ->latest('return_date')
            ->take(5)
            ->get();

        // Popular Books (most borrowed)
        $popularBooks = Book::withCount('loans')
            ->orderBy('loans_count', 'desc')
            ->take(5)
            ->get();

        // Pending Tasks (priorities)
        $pendingRequests = Loan::where('status', 'pending')
            ->with(['user', 'book'])
            ->latest()
            ->take(5)
            ->get();

        // Members with most loans
        $activeMembers = User::role('anggota')
            ->withCount([
                'loans' => function ($query) {
                    $query->where('status', 'active');
                }
            ])
            ->get()
            ->filter(function ($user) {
                return $user->loans_count > 0;
            })
            ->sortByDesc('loans_count')
            ->take(5)
            ->values();

        // Total fines from overdue loans
        $totalPendingFines = Loan::where('status', 'active')
            ->whereDate('due_date', '<', now())
            ->get()
            ->sum(function ($loan) {
                $daysOverdue = now()->diffInDays($loan->due_date);
                return $daysOverdue * $loan->daily_fine_fee;
            }) ?? 0;

        return view('livewire.admin.dashboard.show', [
            'totalUsers' => $totalUsers,
            'totalBooks' => $totalBooks,
            'totalLoans' => $totalLoans,
            'activeLoans' => $activeLoans,
            'pendingLoans' => $pendingLoans,
            'returnedLoans' => $returnedLoans,
            'overdueLoans' => $overdueLoans,
            'lowStockBooks' => $lowStockBooks,
            'outOfStockBooks' => $outOfStockBooks,
            'recentLoans' => $recentLoans,
            'recentReturns' => $recentReturns,
            'popularBooks' => $popularBooks,
            'pendingRequests' => $pendingRequests,
            'activeMembers' => $activeMembers,
            'totalPendingFines' => $totalPendingFines,
        ]);
    }
}
