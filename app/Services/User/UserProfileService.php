<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserProfileService
{
    private UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return User
     */
    public function getCurrentLoggedInUserProfile(): User
    {
        $user = auth()->user();

        return $this->userRepository->getUserProfileByUserModel($user);
    }
}
