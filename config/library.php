<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Library Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration settings for the library management
    | system. These values can be overridden by environment variables.
    |
    */

    // Borrowing settings
    'borrow_duration_days' => env('LIBRARY_BORROW_DAYS', 7),
    'max_borrow_limit' => env('LIBRARY_MAX_BORROW', 3),

    // Fine settings
    'fine_rate_per_day' => env('LIBRARY_FINE_RATE', 1000),
    'fine_grace_days' => env('LIBRARY_FINE_GRACE_DAYS', 0),

    // Stock settings
    'low_stock_threshold' => env('LIBRARY_LOW_STOCK', 2),

    // Book settings
    'default_cover' => 'images/book-placeholder.svg',

    // Pagination
    'per_page' => [
        'books' => 12,
        'borrowings' => 10,
        'users' => 10,
    ],
];

