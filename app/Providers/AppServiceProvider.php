<?php

namespace App\Providers;

use App\Models\Loan;
use App\Policies\LoanPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Loan::class, LoanPolicy::class);

        Route::macro('livewireResource', function ($name, $pages) {

        Route::prefix($name)
            ->as($name . '.')
            ->group(function () use ($name, $pages) {

                if (isset($pages['index'])) {
                    Route::get('/', $pages['index'])->name('index');
                }

                if (isset($pages['create'])) {
                    Route::get('/create', $pages['create'])->name('create');
                }

                if (isset($pages['edit'])) {
                    Route::get('/{' . str($name)->singular() . '}/edit', $pages['edit'])
                        ->name('edit');
                }

                if (isset($pages['show'])) {
                    Route::get('/{' . str($name)->singular() . '}', $pages['show'])
                        ->name('show');
                }
            });
    });
    }
}
