<?php

namespace App\Policies;

use App\Exceptions\AuthorizationException;
use App\Models\User;
use App\Models\Computer;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComputerPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function view(User $user, Computer $computer)
    {
        if (!$user->hasPermissionTo('read computers')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function viewAny(User $user)
    {
        if (!$user->hasPermissionTo('read computers')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function create(User $user)
    {
        if (!$user->hasPermissionTo('create computers')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function update(User $user, Computer $computer)
    {
        if (!$user->hasPermissionTo('update computers')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function delete(User $user, Computer $computer)
    {
        if (!$user->hasPermissionTo('delete computers')) {
            throw new AuthorizationException();
        }
        return true;
    }
}
