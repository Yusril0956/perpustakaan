<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'author', 'isbn', 'description', 'cover_image', 'total_stock', 'available_stock'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Get number of books still available for borrowing
     * Calculated: total_stock - (active + pending loans)
     */
    public function getCanBorrowAttribute()
    {
        $reserved = $this->loans()
            ->whereIn('status', ['active', 'pending'])
            ->count();

        return max(0, $this->total_stock - $reserved);
    }

    /**
     * Safe URL for the book cover.
     *
     * Usage: $book->cover_url
     */
    public function getCoverUrlAttribute()
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
}
