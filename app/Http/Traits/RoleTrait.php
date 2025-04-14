<?php

namespace App\Http\Traits;

trait RoleTrait
{
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function isSuspended()
    {
        return $this->is_suspended;
    }
}
