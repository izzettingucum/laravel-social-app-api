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
     * @param Post $post
     * @return Response|bool
     */
    public function checkIfCurrentLoggedInUserIsPostUser(User $user, Post $post): Response|bool
    {
        return $user->id == $post->user_id;
    }
}
