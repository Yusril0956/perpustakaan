<?php

namespace App\Providers;

use App\Events\BookBorrowed;
use App\Events\BookReturned;
use App\Listeners\CreateFineIfOverdue;
use App\Listeners\UpdateBookStock;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        BookBorrowed::class => [
            UpdateBookStock::class,
        ],
        BookReturned::class => [
            UpdateBookStock::class,
            CreateFineIfOverdue::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}

