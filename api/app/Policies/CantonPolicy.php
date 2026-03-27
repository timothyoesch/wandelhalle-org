<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Canton;
use Illuminate\Auth\Access\HandlesAuthorization;

class CantonPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Canton');
    }

    public function view(AuthUser $authUser, Canton $canton): bool
    {
        return $authUser->can('View:Canton');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Canton');
    }

    public function update(AuthUser $authUser, Canton $canton): bool
    {
        return $authUser->can('Update:Canton');
    }

    public function delete(AuthUser $authUser, Canton $canton): bool
    {
        return $authUser->can('Delete:Canton');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Canton');
    }

    public function restore(AuthUser $authUser, Canton $canton): bool
    {
        return $authUser->can('Restore:Canton');
    }

    public function forceDelete(AuthUser $authUser, Canton $canton): bool
    {
        return $authUser->can('ForceDelete:Canton');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Canton');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Canton');
    }

    public function replicate(AuthUser $authUser, Canton $canton): bool
    {
        return $authUser->can('Replicate:Canton');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Canton');
    }

}