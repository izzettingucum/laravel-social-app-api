<?php

namespace App\Repositories\Interfaces;

use App\DTO\User\UserDTO;
use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * @param User $user
     * @return mixed
     */
    public function getUserProfileByUserModel(User $user): mixed;

    /**
     * @param UserDTO $userDTO
     * @return mixed
     */
    public function getUserProfileBySlug(UserDTO $userDTO): mixed;

    /**
     * @param User $user
     * @return mixed
     */
    public function getUserHiddenStatus(User $user): mixed;

    /**
     * @param User $user
     * @param UserDTO $userDTO
     * @return mixed
     */
    public function checkIfUserIsFollowing(User $user, userDTO $userDTO): mixed;
}
