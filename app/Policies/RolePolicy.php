<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    public function adminOrLandlord(User $user)
    {
        return in_array($user->role, ['admin', 'landlord']);
    }

    public function exceptVisitor(User $user)
    {
        return in_array($user->role, ['admin', 'landlord', 'tenant']);
    }
}
