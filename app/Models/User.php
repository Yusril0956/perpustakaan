<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'profile_photo_path',
        'verify',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'verify' => 'boolean',
            'password' => 'hashed',
            'email_verified_at' => 'datetime',
        ];
    }

    /**
     * Get all borrowings for the user.
     */
    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }

    /**
     * Get the profile photo URL.
     */
    public function getProfilePhotoUrlAttribute(): string
    {
        if ($this->profile_photo_path) {
            if (\Storage::disk('public')->exists($this->profile_photo_path)) {
                return \Storage::url($this->profile_photo_path);
            }
            if (file_exists(public_path($this->profile_photo_path))) {
                return asset($this->profile_photo_path);
            }
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=f4ecd8&color=6f4e37&size=400&bold=true';
    }

    /**
     * Check if user is verified.
     */
    public function isVerified(): bool
    {
        return $this->verify === true;
    }

    /**
     * Check if user has any active borrowings.
     */
    public function hasActiveBorrowings(): bool
    {
        return $this->borrowings()->whereNull('returned_at')->exists();
    }

    /**
     * Get the count of active borrowings.
     */
    public function activeBorrowingsCount(): int
    {
        return $this->borrowings()->whereNull('returned_at')->count();
    }

    /**
     * Check if user is a member (anggota).
     */
    public function isMember(): bool
    {
        return $this->hasRole('anggota');
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }
}
