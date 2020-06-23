<?php

namespace App\Providers;

use App\Post;
use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('toggle-post', function (User $user, Post $post) {
        //     return $post->user->is($user)
        //     ? Response::allow()
        //     : Response::deny('You cannot toggle the Post because its not yours');
        // });
        // Gate::define('view-posts', function (?User $user) {
        //     return true;
        // });

        // Gate::before(function (User $user) {
        //     if ($user->id === 1) {
        //         return false;
        //     }
        // });
        Gate::before(function ($user, $ability) {
            if ($user->abilities()->contains($ability)) {
                return true;
            }
        });

        Gate::define('delete-user', function (User $auth, User $user) {
            return $auth->is($user)
            ? Response::allow()
            : Response::deny('You cannot delete this User because its not yours');
        });
    }
}
