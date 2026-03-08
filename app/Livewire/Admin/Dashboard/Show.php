<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Fine;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;

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

        // Book Statistics
        $lowStockBooks = Book::where('available_stock', '<=', 2)
            ->where('available_stock', '>', 0)
            ->count();
        $outOfStockBooks = Book::where('available_stock', '<=', 0)->count();

        // Borrowing Statistics
        $activeBorrowings = Borrowing::where('status', 'BORROWED')->count();
        $overdueBorrowings = Borrowing::where('status', 'OVERDUE')->count();

        // Fine Statistics
        $unpaidFines = Fine::where('status', 'UNPAID')->sum('amount');

        // Most Popular Books (by borrowing count)
        $popularBooks = Book::select('books.id', 'books.title', 'books.author', DB::raw('COUNT(borrowings.id) as borrow_count'))
            ->leftJoin('borrowings', 'books.id', '=', 'borrowings.book_id')
            ->groupBy('books.id', 'books.title', 'books.author')
            ->orderByDesc('borrow_count')
            ->limit(5)
            ->get();

        // Most Active Borrowers
        $activeBorrowers = User::select('users.id', 'users.name', 'users.email', DB::raw('COUNT(borrowings.id) as borrow_count'))
            ->leftJoin('borrowings', 'users.id', '=', 'borrowings.user_id')
            ->where('users.id', '>', 0)
            ->groupBy('users.id', 'users.name', 'users.email')
            ->orderByDesc('borrow_count')
            ->limit(5)
            ->get();

        // Recent Activity Logs (last 10 borrowings and returns)
        $recentActivities = Borrowing::with(['user', 'book'])
            ->orderByDesc('borrowed_at')
            ->limit(10)
            ->get();

        // Pending/Overdue Requests (borrowed but overdue or pending)
        $pendingRequests = Borrowing::with(['user', 'book'])
            ->whereIn('status', ['BORROWED', 'OVERDUE'])
            ->orderBy('due_at', 'asc')
            ->limit(3)
            ->get();

        return view('livewire.admin.dashboard.show', [
            'totalUsers' => $totalUsers,
            'totalBooks' => $totalBooks,
            'lowStockBooks' => $lowStockBooks,
            'outOfStockBooks' => $outOfStockBooks,
            'activeBorrowings' => $activeBorrowings,
            'overdueBorrowings' => $overdueBorrowings,
            'unpaidFines' => $unpaidFines,
            'popularBooks' => $popularBooks,
            'activeBorrowers' => $activeBorrowers,
            'recentActivities' => $recentActivities,
            'pendingRequests' => $pendingRequests,
        ]);
    }
}
