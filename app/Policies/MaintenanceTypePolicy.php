<?php

namespace App\Policies;

use App\Models\MaintenanceType;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Exceptions\AuthorizationException;

class MaintenanceTypePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function view(User $user, MaintenanceType $maintenanceType)
    {
        if (!$user->hasPermissionTo('read maintenance_types')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function viewAny(User $user)
    {
        if (!$user->hasPermissionTo('read maintenance_types')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function create(User $user)
    {
        if (!$user->hasPermissionTo('create maintenance_types')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function update(User $user, MaintenanceType $maintenanceType)
    {
        if (!$user->hasPermissionTo('update maintenance_types')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function delete(User $user, MaintenanceType $maintenanceType)
    {
        if (!$user->hasPermissionTo('delete maintenance_types')) {
            throw new AuthorizationException();
        }
        return true;
    }
}
