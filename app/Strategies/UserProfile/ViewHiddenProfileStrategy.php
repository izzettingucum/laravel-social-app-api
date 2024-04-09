<?php

namespace App\Strategies\UserProfile;

use App\Services\User\UserService;
use App\Strategies\Interfaces\ViewProfileStrategyInterface;

class ViewHiddenProfileStrategy implements ViewProfileStrategyInterface
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
        $userId = $this->userService->getUserIdBySlug($slug);
        $isFollowing = false;

        if (auth()->check()) {
            $currentLoggedInUser = auth()->user();

            $isFollowing = $this->userService->checkUserFollowingStatusById($currentLoggedInUser, $userId);
        }

        if ($isFollowing) {
            return $this->userService->getWholeUserProfileBySlug($slug);
        }

        return $this->userService->getHiddenUserProfileBySlug($slug);
    }
}
