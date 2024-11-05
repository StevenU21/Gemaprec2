<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Exceptions\AuthorizationException;

class ReportPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function view(User $user, Report $report)
    {
        if (!$user->hasPermissionTo('read reports')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function viewAny(User $user)
    {
        if (!$user->hasPermissionTo('read reports')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function create(User $user)
    {
        if (!$user->hasPermissionTo('create reports')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function update(User $user, Report $Report)
    {
        if (!$user->hasPermissionTo('update reports')) {
            throw new AuthorizationException();
        }
        return true;
    }

    public function delete(User $user, Report $Report)
    {
        if (!$user->hasPermissionTo('delete reports')) {
            throw new AuthorizationException();
        }
        return true;
    }
}
