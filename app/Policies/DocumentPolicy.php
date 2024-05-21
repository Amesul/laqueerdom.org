<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any documents.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->canAny(['administrate', 'edit']);
    }

    /**
     * Determine whether the user can view the document.
     *
     * @param User $user
     * @param Document $document
     * @return bool
     */
    public function view(User $user): bool
    {
        return $user->canAny(['administrate', 'edit']);
    }

    /**
     * Determine whether the user can create documents.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->canAny(['administrate', 'edit']);
    }

    /**
     * Determine whether the user can update the document.
     *
     * @param User $user
     * @param Document $document
     * @return bool
     */
    public function update(User $user, Document $document): bool
    {
        return $document->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the document.
     *
     * @param User $user
     * @param Document $document
     * @return bool
     */
    public function delete(User $user, Document $document): bool
    {
        return $document->user === $user || $user->can('administrate');
    }

    /**
     * Determine whether the user can restore the document.
     *
     * @param User $user
     * @param Document $document
     * @return bool
     */
    public function restore(User $user, Document $document): bool
    {
        return $document->user === $user || $user->can('administrate');
    }

    /**
     * Determine whether the user can permanently delete the document.
     *
     * @param User $user
     * @param Document $document
     * @return bool
     */
    public function forceDelete(User $user): bool
    {
        return $user->can('administrate');
    }
}
