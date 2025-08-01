<?php

namespace App\Policies;

use App\Models\Attachment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AttachmentPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param      $ability
     * @return bool|void
     */
    public function before(User $user, $ability)
    {
        if ($user->isSuAdmin() || $user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User       $user
     * @param Attachment $attachment
     * @return bool
     */
    public function view(User $user, Attachment $attachment): bool
    {
        // Check if the user's id matches the attachable's id
        if ($user->id === $attachment->attachable->id) {
            return true;
        }
    
        // Check if the attachable's id matches any of the user's patients' ids
        foreach ($user->patients as $patient) {
            if ($attachment->attachable->id === $patient->id) {
                return true;
            }
        }
    
        // If none of the above conditions are met, return false
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User       $user
     * @param Attachment $attachment
     * @return Response|bool
     */
    public function update(User $user, Attachment $attachment): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User       $user
     * @param Attachment $attachment
     * @return Response|bool
     */
    public function delete(User $user, Attachment $attachment): bool
    {
        return false;
    }
}
