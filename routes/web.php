<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Books\Index as BookIndex;
use App\Livewire\Admin\Books\Create as BookCreate;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/books', BookIndex::class)->name('admin.books.index');
    Route::get('/admin/books/create', BookCreate::class)->name('admin.books.create');
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
