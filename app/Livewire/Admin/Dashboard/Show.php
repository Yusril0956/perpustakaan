<?php

namespace App\Livewire\Admin\Dashboard;

use App\Enums\BorrowingStatus;
use App\Enums\FineStatus;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Fine;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.app')]
class Show extends Component
{
    public function mount(): void
    {
        // Check if user is admin
        if (!auth()->user() || !auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }
    }

    public function render(): View
    {
        // Cache statistics for 5 minutes to improve performance
        $stats = Cache::remember('dashboard.stats', 300, function () {
            // Total Statistics
            $totalUsers = User::role('anggota')->count();
            $totalBooks = Book::count();

            // Book Statistics
            $lowStockBooks = Book::where('available_stock', '<=', config('library.low_stock_threshold', 2))
                ->where('available_stock', '>', 0)
                ->count();
            $outOfStockBooks = Book::where('available_stock', '<=', 0)->count();

            // Borrowing Statistics
            $activeBorrowings = Borrowing::where('status', BorrowingStatus::BORROWED->value)->count();
            $overdueBorrowings = Borrowing::where('status', BorrowingStatus::OVERDUE->value)->count();

            // Fine Statistics
            $unpaidFines = Fine::where('status', FineStatus::UNPAID->value)->sum('amount');

            return compact(
                'totalUsers',
                'totalBooks',
                'lowStockBooks',
                'outOfStockBooks',
                'activeBorrowings',
                'overdueBorrowings',
                'unpaidFines'
            );
        });

        // Most Popular Books (by borrowing count) - cache for 10 minutes
        $popularBooks = Cache::remember('dashboard.popular_books', 600, function () {
            return Book::select('books.id', 'books.title', 'books.author', DB::raw('COUNT(borrowings.id) as borrow_count'))
                ->leftJoin('borrowings', 'books.id', '=', 'borrowings.book_id')
                ->groupBy('books.id', 'books.title', 'books.author')
                ->orderByDesc('borrow_count')
                ->limit(5)
                ->get();
        });

        // Most Active Borrowers - cache for 10 minutes
        $activeBorrowers = Cache::remember('dashboard.active_borrowers', 600, function () {
            return User::select('users.id', 'users.name', 'users.email', DB::raw('COUNT(borrowings.id) as borrow_count'))
                ->leftJoin('borrowings', 'users.id', '=', 'borrowings.user_id')
                ->where('users.id', '>', 0)
                ->groupBy('users.id', 'users.name', 'users.email')
                ->orderByDesc('borrow_count')
                ->limit(5)
                ->get();
        });

        // Recent Activity Logs (last 10 borrowings and returns) - no cache, needs real-time
        $recentActivities = Borrowing::with(['user', 'book'])
            ->orderByDesc('borrowed_at')
            ->limit(10)
            ->get();

        // Pending/Overdue Requests - no cache, needs real-time
        $pendingRequests = Borrowing::with(['user', 'book'])
            ->whereIn('status', [BorrowingStatus::BORROWED->value, BorrowingStatus::OVERDUE->value])
            ->orderBy('due_at', 'asc')
            ->limit(3)
            ->get();

        return view('livewire.admin.dashboard.show', array_merge($stats, compact(
            'popularBooks',
            'activeBorrowers',
            'recentActivities',
            'pendingRequests'
        )));
    }
}
