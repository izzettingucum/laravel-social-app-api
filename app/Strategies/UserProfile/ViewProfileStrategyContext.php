<?php

namespace App\Strategies\UserProfile;

use App\Services\User\UserService;
use App\Strategies\Interfaces\ViewProfileStrategyInterface;
use http\Exception\InvalidArgumentException;

class ViewProfileStrategyContext
{
    private ViewProfileStrategyInterface $strategy;

    /**
     * @param string $viewMethod
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct(string $viewMethod)
    {
        $this->strategy = match($viewMethod) {
            "openProfile" => new ViewOpenProfileStrategy(app()->make(UserService::class)),
            "hiddenProfile" => new ViewHiddenProfileStrategy(app()->make(UserService::class)),
            default => throw new InvalidArgumentException("you must pass in either openProfile or hiddenProfile as the view method.")
        };
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function viewProfile(string $slug): mixed
    {
        return $this->strategy->viewProfile($slug);
    }
}
