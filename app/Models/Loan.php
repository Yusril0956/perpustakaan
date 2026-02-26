<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'booking_date',
        'loan_date',
        'due_date',
        'return_date',
        'status',
        'daily_fine_fee',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    protected function casts(): array
    {
        return [
            'booking_date' => 'date',
            'loan_date' => 'date',
            'due_date' => 'date',
            'return_date' => 'date',
        ];
    }

    public function getFineAttribute()
    {
        if ($this->status === 'active' && now()->greaterThan($this->due_date)) {
            $daysOverdue = now()->diffInDays($this->due_date);
            return $daysOverdue * $this->daily_fine_fee;
        }
        return 0;
    }
}
