<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Brand;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Exceptions\AuthorizationException;

class BrandPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function view(User $user, Brand $brand)
    {
        if (!$user->hasPermissionTo('read brands')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function viewAny(User $user)
    {
        if (!$user->hasPermissionTo('read brands')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function create(User $user)
    {
        if (!$user->hasPermissionTo('create brands')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function update(User $user, Brand $brand)
    {
        if (!$user->hasPermissionTo('update brands')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function delete(User $user, Brand $brand)
    {
        if (!$user->hasPermissionTo('delete brands')) {
            throw new AuthorizationException();
        }
        return true;
    }
}
