<?php

namespace App\Policies;

use App\Exceptions\AuthorizationException;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function view(User $user, Activity $activity)
    {
        if (!$user->hasPermissionTo('read activities')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function viewAny(User $user)
    {
        if (!$user->hasPermissionTo('read activities')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function create(User $user)
    {
        if (!$user->hasPermissionTo('create activities')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function update(User $user, Activity $activity)
    {
        if (!$user->hasPermissionTo('update activities')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function delete(User $user, Activity $activity)
    {
        if (!$user->hasPermissionTo('delete activities')) {
            throw new AuthorizationException();
        }
        return true;
    }
}
