<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'author',
        'isbn',
        'description',
        'cover_image',
        'total_stock',
        'available_stock',
        'is_available',
    ];

    protected function casts(): array
    {
        return [
            'is_available' => 'boolean',
        ];
    }

    /**
     * Get the category that owns the book.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all borrowings for the book.
     */
    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }

    /**
     * Safe URL for the book cover.
     *
     * Usage: $book->cover_url
     */
    public function getCoverUrlAttribute(): string
    {
        // No cover stored → placeholder
        if (empty($this->cover_image)) {
            return asset('images/book-placeholder.svg');
        }

        // Already an absolute URL
        if (Str::startsWith($this->cover_image, ['http://', 'https://'])) {
            return $this->cover_image;
        }

        // Stored on the public disk (recommended)
        if (Storage::disk('public')->exists($this->cover_image)) {
            return Storage::url($this->cover_image);
        }

        // Stored directly in public/ (e.g. 'uploads/covers/..')
        if (file_exists(public_path($this->cover_image))) {
            return asset($this->cover_image);
        }

        // Fallback
        return asset('images/book-placeholder.svg');
    }

    /**
     * Check if book is available for borrowing.
     */
    public function isAvailable(): bool
    {
        return $this->is_available && $this->available_stock > 0;
    }

    /**
     * Check if book is low on stock.
     */
    public function isLowStock(int $threshold = 2): bool
    {
        return $this->available_stock > 0 && $this->available_stock <= $threshold;
    }

    /**
     * Check if book is out of stock.
     */
    public function isOutOfStock(): bool
    {
        return $this->available_stock <= 0;
    }
}
