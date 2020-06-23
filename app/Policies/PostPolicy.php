<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    public function togglePost(User $user, Post $post)
    {
        return $post->user->is($user)
        ? Response::allow()
        : Response::deny('You cannot toggle the Post because its not yours');
    }
}
