<?php

use Illuminate\Support\Facades\Route;

// ============================================
// Public Routes (Guest)
// ============================================

Route::view('/', 'welcome')->name('home');
Route::view('about', 'about')->name('about');
Route::view('rules', 'rules')->name('rules');
Route::get('/jelajah', \App\Livewire\Guest\BookExplorer::class)->name('explore');

// ============================================
// Protected Routes (Authenticated)
// ============================================

Route::middleware(['auth', 'verified'])->group(function () {

    // ---- Member Routes ----
    Route::prefix('member')->as('member.')->group(function () {
        Route::get('dashboard', \App\Livewire\Member\Dashboard\Show::class)
            ->name('dashboard');
        Route::get('/my-borrows', \App\Livewire\Member\Borrows\Index::class)->name('borrows.index');
    });

    Route::get('/wishlist', \App\Livewire\Member\Wishlist\Index::class)
        ->name('member.wishlist.index');

    // User Profile
    Route::get('profile', \App\Livewire\Member\Profile\Show::class)
        ->name('profile.show');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
