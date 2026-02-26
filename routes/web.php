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
    });

    Route::get('/pinjaman-saya', \App\Livewire\Member\Loans\Index::class)
        ->name('member.loans.index');

    Route::get('/wishlist', \App\Livewire\Member\Wishlist\Index::class)
        ->name('member.wishlist.index');

    Route::get('/rak', \App\Livewire\Member\Categories\Index::class)
        ->name('member.categories.index');

    // User Profile
    Route::get('profile', \App\Livewire\Member\Profile\Show::class)
        ->name('profile.show');
});

// ============================================
// Admin Routes
// ============================================

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        // Dashboard & Overview
        Route::get('dashboard', \App\Livewire\Admin\Dashboard\Show::class)
            ->name('dashboard');

        // Loan Management
        Route::get('loans/management', \App\Livewire\Admin\Loans\Management::class)
            ->name('loans.management');

        Route::get('loans/validation', \App\Livewire\Admin\Loans\Validation::class)
            ->middleware('can:manage transactions')
            ->name('loans.validation');

        // User Management
        Route::livewireResource('users', [
            'index' => \App\Livewire\Admin\Users\Index::class,
            'create' => \App\Livewire\Admin\Users\Create::class,
            'edit' => \App\Livewire\Admin\Users\Edit::class,
        ]);

        // Book Management
        Route::livewireResource('books', [
            'index' => \App\Livewire\Admin\Books\Index::class,
            'create' => \App\Livewire\Admin\Books\Create::class,
            'edit' => \App\Livewire\Admin\Books\Edit::class,
        ]);
    });

// ============================================
// Authentication Routes
// ============================================

require __DIR__ . '/auth.php';
