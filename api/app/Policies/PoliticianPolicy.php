<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Politician;
use Illuminate\Auth\Access\HandlesAuthorization;

class PoliticianPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Politician');
    }

    public function view(AuthUser $authUser, Politician $politician): bool
    {
        return $authUser->can('View:Politician');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Politician');
    }

    public function update(AuthUser $authUser, Politician $politician): bool
    {
        return $authUser->can('Update:Politician');
    }

    public function delete(AuthUser $authUser, Politician $politician): bool
    {
        return $authUser->can('Delete:Politician');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Politician');
    }

    public function restore(AuthUser $authUser, Politician $politician): bool
    {
        return $authUser->can('Restore:Politician');
    }

    public function forceDelete(AuthUser $authUser, Politician $politician): bool
    {
        return $authUser->can('ForceDelete:Politician');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Politician');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Politician');
    }

    public function replicate(AuthUser $authUser, Politician $politician): bool
    {
        return $authUser->can('Replicate:Politician');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Politician');
    }

}