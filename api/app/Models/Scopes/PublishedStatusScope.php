<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PublishedStatusScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        // If the user is authed through aut() or auth("sanctum") and has role moderator or super_admin, do not apply the scope
        $user = auth()->user() ?? auth("sanctum")->user();
        if ($user && ($user->hasRole('moderator') || $user->hasRole('super_admin'))) {
            return;
        }
        $builder->where('status', 'published');
    }
}
