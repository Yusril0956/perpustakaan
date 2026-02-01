<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public function getFineAttribute()
    {
        if ($this->status === 'active' && now()->greaterThan($this->due_date)) {
            $daysOverdue = now()->diffInDays($this->due_date);
            return $daysOverdue * $this->daily_fine_fee;
        }
        return 0;
    }
}
