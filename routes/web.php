<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Books\Index as BookIndex;
use App\Livewire\Admin\Books\Create as BookCreate;
use App\Livewire\Admin\Users\Index as UsersIndex;
use App\Livewire\Guest\BookExplorer;
use App\Livewire\Member\ShowProfile;


Route::view('/', 'welcome');
Route::view('about', 'about')->name('about');
Route::get('/jelajah', BookExplorer::class)->name('explore');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('profile', ShowProfile::class)
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/books', BookIndex::class)->name('admin.books.index');
    Route::get('/admin/books/create', BookCreate::class)->name('admin.books.create');

    Route::get('/admin/users', UsersIndex::class)->name('admin.users.index');
});

Route::middleware(['auth'])->group(function () {

    Route::middleware('can:manage books')->group(function () {
        Route::get('/admin/books', BookIndex::class)->name('admin.books.index');
        Route::get('/admin/books/create', BookCreate::class)->name('admin.books.create');
    });

    Route::middleware('can:manage transactions')->group(function () {
        // Route::resource('transactions', TransactionController::class);
    });
});


require __DIR__ . '/auth.php';
