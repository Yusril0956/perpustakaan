<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     * Only admin can view all users.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     * Users can view their own profile, admin can view all.
     */
    public function view(User $user, User $model): bool
    {
        return $user->hasRole('admin') || $user->id === $model->id;
    }

    /**
     * Determine whether the user can create models.
     * Only admin can create users.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     * Users can update their own profile, admin can update all.
     */
    public function update(User $user, User $model): bool
    {
        return $user->hasRole('admin') || $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     * Only admin can delete users.
     */
    public function delete(User $user, User $model): bool
    {
        // Prevent admin from deleting themselves
        return $user->hasRole('admin') && $user->id !== $model->id;
    }

    /**
     * Determine whether the user can restore the model.
     * Only admin can restore users.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     * Only admin can permanently delete users.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->hasRole('admin') && $user->id !== $model->id;
    }

    /**
     * Determine whether user can manage roles/permissions.
     * Only admin can manage roles.
     */
    public function manageRoles(User $user): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * Determine whether user can view other members.
     * Admin can view all members.
     */
    public function viewMembers(User $user): bool
    {
        return $user->hasRole('admin');
    }
}
