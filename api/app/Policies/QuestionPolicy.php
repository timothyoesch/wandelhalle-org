<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Question;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Question');
    }

    public function view(AuthUser $authUser, Question $question): bool
    {
        return $authUser->can('View:Question');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Question');
    }

    public function update(AuthUser $authUser, Question $question): bool
    {
        // Superadmins can update any question, but regular users can only update their own questions
        if ($authUser->hasRole('super_admin')) {
            return true;
        }
        return $authUser->id === $question->user_id;
    }

    public function delete(AuthUser $authUser, Question $question): bool
    {
        // Superadmins can delete any question, but regular users can only delete their own questions
        if ($authUser->hasRole('super_admin')) {
            return true;
        }
        return $authUser->id === $question->user_id;
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Question');
    }

    public function restore(AuthUser $authUser, Question $question): bool
    {
        return $authUser->can('Restore:Question');
    }

    public function forceDelete(AuthUser $authUser, Question $question): bool
    {
        return $authUser->can('ForceDelete:Question');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Question');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Question');
    }

    public function replicate(AuthUser $authUser, Question $question): bool
    {
        return $authUser->can('Replicate:Question');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Question');
    }

}
