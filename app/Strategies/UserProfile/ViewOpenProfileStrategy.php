<?php

namespace App\Strategies\UserProfile;

use App\Services\User\UserService;
use App\Strategies\Interfaces\ViewProfileStrategyInterface;

class ViewOpenProfileStrategy implements ViewProfileStrategyInterface
{
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @inheritDoc
     */
    public function viewProfile(string $slug): mixed
    {
        return $this->userService->getWholeUserProfileBySlug($slug);
    }
}
