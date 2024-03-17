<?php

namespace App\Providers;

use App\Repositories\Interfaces\UserInfoRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\User\UserInfoRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        app()->bind(UserRepositoryInterface::class, UserRepository::class);
        app()->bind(UserInfoRepositoryInterface::class, UserInfoRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
