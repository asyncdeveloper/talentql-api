<?php

namespace App\Policies;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Todo $todo
     * @return mixed
     */
    public function view(User $user, Todo $todo)
    {
        return $todo->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Todo $todo
     * @return mixed
     */
    public function update(User $user, Todo $todo)
    {
        return $todo->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Todo $todo
     * @return mixed
     */
    public function delete(User $user, Todo $todo)
    {
        return $todo->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Todo $todo
     * @return mixed
     */
    public function restore(User $user, Todo $todo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Todo $todo
     * @return mixed
     */
    public function forceDelete(User $user, Todo $todo)
    {
        //
    }
}
