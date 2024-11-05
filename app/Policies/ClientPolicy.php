<?php

namespace App\Policies;

use App\Exceptions\AuthorizationException;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\Client;

class ClientPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function view(User $user, Client $client)
    {
        if (!$user->hasPermissionTo('read clients')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function viewAny(User $user)
    {
        if (!$user->hasPermissionTo('read clients')) {
            throw new AuthorizationException();
        }

        return true;
    }

    public function create(User $user)
    {
        if (!$user->hasPermissionTo('create clients')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function update(User $user, Client $client)
    {
        if (!$user->hasPermissionTo('update clients')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function delete(User $user, Client $client)
    {
        if (!$user->hasPermissionTo('delete clients')) {
            throw new AuthorizationException();
        }
        return true;
    }
}
