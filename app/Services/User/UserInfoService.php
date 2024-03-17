<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\Interfaces\UserInfoRepositoryInterface;

class UserInfoService
{
    private UserInfoRepositoryInterface $userInfoRepository;

    /**
     * @param UserInfoRepositoryInterface $userInfoRepository
     */
    public function __construct(UserInfoRepositoryInterface $userInfoRepository)
    {
        $this->userInfoRepository = $userInfoRepository;
    }
}
