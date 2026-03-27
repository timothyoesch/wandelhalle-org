<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Council;
use Illuminate\Auth\Access\HandlesAuthorization;

class CouncilPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Council');
    }

    public function view(AuthUser $authUser, Council $council): bool
    {
        return $authUser->can('View:Council');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Council');
    }

    public function update(AuthUser $authUser, Council $council): bool
    {
        return $authUser->can('Update:Council');
    }

    public function delete(AuthUser $authUser, Council $council): bool
    {
        return $authUser->can('Delete:Council');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Council');
    }

    public function restore(AuthUser $authUser, Council $council): bool
    {
        return $authUser->can('Restore:Council');
    }

    public function forceDelete(AuthUser $authUser, Council $council): bool
    {
        return $authUser->can('ForceDelete:Council');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Council');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Council');
    }

    public function replicate(AuthUser $authUser, Council $council): bool
    {
        return $authUser->can('Replicate:Council');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Council');
    }

}