<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserInfoRepositoryInterface
{
    public function getUserHiddenStatus(User $user);
}
