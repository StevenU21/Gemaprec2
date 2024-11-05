<?php

namespace App\Policies;

use App\Models\ActivityType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Exceptions\AuthorizationException;

class ActivityTypePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function view(User $user, ActivityType $activityType)
    {
        if (!$user->hasPermissionTo('read activity_types')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function viewAny(User $user)
    {
        if (!$user->hasPermissionTo('read activity_types')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function create(User $user)
    {
        if (!$user->hasPermissionTo('create activity_types')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function update(User $user, ActivityType $activityType)
    {
        if (!$user->hasPermissionTo('update activity_types')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function delete(User $user, ActivityType $activityType)
    {
        if (!$user->hasPermissionTo('delete activity_types')) {
            throw new AuthorizationException();
        }
        return true;
    }
}
