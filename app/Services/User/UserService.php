<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\Interfaces\UserInfoRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService
{
    private UserRepositoryInterface $userRepository;
    private UserInfoRepositoryInterface $userInfoRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param UserInfoRepositoryInterface $userInfoRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, UserInfoRepositoryInterface $userInfoRepository)
    {
        $this->userRepository = $userRepository;
        $this->userInfoRepository = $userInfoRepository;
    }

    /**
     * @return User
     */
    public function getCurrentLoggedInUser(): User
    {
        $user = auth()->user();

        return $this->userRepository->getUserProfileByUserModel($user);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function getUserHiddenStatus(User $user): mixed
    {
        return $this->userInfoRepository->getUserHiddenStatus($user);
    }
}
