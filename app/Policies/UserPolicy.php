<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy {

    use HandlesAuthorization;

    /**
     * Determine whether the user can update the user.
     *
     * @param \App\User $current
     * @param \App\User $target
     * @return mixed
     */
    public function update(User $current, User $target) {
        return $current->id == $target->id;
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param \App\User $current
     * @param \App\User $target
     * @return mixed
     */
    public function delete(User $current, User $target) {
        return $current->id == $target->id;
    }
}
