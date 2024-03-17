<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\Interfaces\UserInfoRepositoryInterface;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserInfoRepository implements UserInfoRepositoryInterface
{
    /**
     * @param User $user
     * @return HasOne
     */
    public function getUserHiddenStatus(User $user): HasOne
    {
        return $user->userInfo()->first("is_hidden");
    }
}
