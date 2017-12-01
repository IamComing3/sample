<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $currentuser, User $user)
    {
      return $currentuser->id === $user->id;
    }

    public function destroy(User $currentuser, User $user)
    {
      return $currentuser->is_admin && $currentuser->id !== $user->id;
    }
}
