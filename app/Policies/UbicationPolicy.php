<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ubication;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Exceptions\AuthorizationException;

class UbicationPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function view(User $user, Ubication $ubication)
    {
        if (!$user->hasPermissionTo('read ubications')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function viewAny(User $user)
    {
        if (!$user->hasPermissionTo('read ubications')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function create(User $user)
    {
        if (!$user->hasPermissionTo('create ubications')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function update(User $user, Ubication $ubication)
    {
        if (!$user->hasPermissionTo('update ubications')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function delete(User $user, Ubication $ubication)
    {
        if (!$user->hasPermissionTo('delete ubications')) {
            throw new AuthorizationException();
        }
        return true;
    }
}
