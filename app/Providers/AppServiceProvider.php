<?php

namespace App\Providers;

use App\DTO\CommentDTO;
use App\DTO\PostDTO;
use App\DTO\User\UserDTO;
use App\DTO\User\UserInfoDTO;
use App\Models\Post;
use App\Models\Story;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(UserDTO::class, function ($app) {
            return new UserDTO([]);
        });

        $this->app->bind(UserInfoDTO::class, function ($app) {
            return new UserInfoDTO([]);
        });

        $this->app->bind(CommentDTO::class, function ($app) {
            return new CommentDTO([]);
        });

        $this->app->bind(PostDTO::class, function ($app) {
            return new PostDTO([]);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Relation::enforceMorphMap([
            "post" => Post::class,
            "story" => Story::class
        ]);
    }
}
