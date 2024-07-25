<?php

namespace App\Policies;

use App\Models\Recruiter;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RecruiterPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Recruiter $recruiter)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */

    public function update(Recruiter $recruiter, Recruiter $profile): bool | Response
    {
        return $recruiter->id  == $profile->id ? true : Response::deny();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Recruiter $recruiter, Recruiter $model)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Recruiter $recruiter, Recruiter $model)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Recruiter $recruiter, Recruiter $model)
    {
        return true;
    }
}
