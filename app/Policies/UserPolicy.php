<?php
namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user)
    {
        return !$user->isSuspended();
    }

    public function create(User $user)
    {
        return $user->hasRole('Admin');
    }

    public function update(User $user, User $target)
    {
        return $user->hasRole('Admin') || $user->id === $target->id;
    }

    public function delete(User $user, User $target)
    {
        return $user->hasRole('Admin') && $user->id !== $target->id;
    }

    public function suspend(User $user)
    {
        return $user->hasRole('Admin');
    }
}
