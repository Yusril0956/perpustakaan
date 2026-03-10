<?php

namespace App\Policies;

use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BorrowingPolicy
{
    /**
     * Determine whether the user can view any models.
     * Admin can view all, members can view their own.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin') || $user->hasRole('anggota');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Borrowing $borrowing): bool
    {
        // Admin can view all, members can only view their own
        return $user->hasRole('admin') || $borrowing->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     * Admin can create borrowings for users.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Borrowing $borrowing): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Borrowing $borrowing): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can return the book (custom action).
     */
    public function return(User $user, Borrowing $borrowing): bool
    {
        return $user->hasRole('admin') || $borrowing->user_id === $user->id;
    }

    /**
     * Determine whether the user can borrow books (member action).
     */
    public function borrow(User $user): bool
    {
        return $user->hasRole('anggota') && $user->hasPermissionTo('borrow books');
    }
}
