<?php

namespace App\Policies;

use App\Models\Maintenance;
use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Exceptions\AuthorizationException;
class MaintenancePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function view(User $user, Maintenance $maintenance)
    {
        if (!$user->hasPermissionTo('read maintenances')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function viewAny(User $user)
    {
        if (!$user->hasPermissionTo('read maintenances')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function create(User $user)
    {
        if (!$user->hasPermissionTo('create maintenances')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function update(User $user, Maintenance $maintenance)
    {
        if (!$user->hasPermissionTo('update maintenances')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function delete(User $user, Maintenance $maintenance)
    {
        if (!$user->hasPermissionTo('delete maintenances')) {
            throw new AuthorizationException();
        }
        return true;
    }
}
