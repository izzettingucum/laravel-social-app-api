<?php

namespace App\Providers;

use App\DTO\CommentDTO;
use App\DTO\PostDTO;
use App\DTO\User\UserDTO;
use App\DTO\User\UserInfoDTO;
use App\Models\Post;
use App\Models\Story;
use App\Services\User\UserService;
use App\Strategies\UserProfile\ViewHiddenProfileStrategy;
use App\Strategies\UserProfile\ViewOpenProfileStrategy;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
