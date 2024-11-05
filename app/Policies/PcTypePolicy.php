<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PcType;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Exceptions\AuthorizationException;

class PcTypePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function view(User $user, PcType $pcType)
    {
        if (!$user->hasPermissionTo('read pc_types')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function viewAny(User $user)
    {
        if (!$user->hasPermissionTo('read pc_types')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function create(User $user)
    {
        if (!$user->hasPermissionTo('create pc_types')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function update(User $user, PcType $pcType)
    {
        if (!$user->hasPermissionTo('update pc_types')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function delete(User $user, PcType $pcType)
    {
        if (!$user->hasPermissionTo('delete pctypes')) {
            throw new AuthorizationException();
        }
        return true;
    }
}
