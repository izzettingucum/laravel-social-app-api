<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @param int $user_id
     * @return Response|bool
     */
    public function create(User $user, int $user_id): Response|bool
    {
        return $user->id == $user_id;
    }
}
