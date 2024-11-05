<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait VisibleToUser
{
    public function scopeVisibleToUser(Builder $query): Builder
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return $query->with('user');
        } elseif ($user->hasRole('employee')) {
            return $query->with('user')->where('created_by', $user->id);
        } elseif ($user->hasRole('client')) {
            return $query->with('user')->where('user_id', $user->id);
        }

        abort(403, 'Unauthorized action.');
    }
}
