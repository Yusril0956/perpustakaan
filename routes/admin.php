<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['admin', 'verified'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        // Dashboard & Overview
        Route::get('dashboard', \App\Livewire\Admin\Dashboard\Show::class)
            ->name('dashboard');

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

        // Borrowing Management
        Route::get('/borrowings', \App\Livewire\Admin\Borrowings\Index::class)->name('borrowings.index');
        Route::get('/borrowings/create', \App\Livewire\Admin\Borrowings\Create::class)->name('borrowings.create');
        Route::get('/fines', \App\Livewire\Admin\Fines\Index::class)->name('fines.index');
    });