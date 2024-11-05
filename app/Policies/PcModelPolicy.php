<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PcModel;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Exceptions\AuthorizationException;

class PcModelPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function view(User $user, PcModel $pcModel)
    {
        if (!$user->hasPermissionTo('read pc_models')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function viewAny(User $user)
    {
        if (!$user->hasPermissionTo('read pc_models')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function create(User $user)
    {
        if (!$user->hasPermissionTo('create pc_models')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function update(User $user, PcModel $pcModel)
    {
        if (!$user->hasPermissionTo('update pc_models')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function delete(User $user, PcModel $pcModel)
    {
        if (!$user->hasPermissionTo('delete pc_models')) {
            throw new AuthorizationException();
        }
        return true;
    }
}
