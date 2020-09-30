<?php

namespace App\Policies;

use App\Diary;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiaryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Diary  $diary
     * @return mixed
     */
    public function view(User $user, Diary $diary)
    {
        return $diary->users->contains($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Diary  $diary
     * @return mixed
     */
    public function update(User $user, Diary $diary)
    {
        return $diary->users->contains($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Diary  $diary
     * @return mixed
     */
    public function delete(User $user, Diary $diary)
    {
        return $diary->users->contains($user);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Diary  $diary
     * @return mixed
     */
    public function restore(User $user, Diary $diary)
    {
        return $diary->users->contains($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Diary  $diary
     * @return mixed
     */
    public function forceDelete(User $user, Diary $diary)
    {
        return $diary->users->contains($user);
    }
}
