<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'verified'])
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