<?php

namespace App\Repositories\Interfaces;

use App\DTO\User\UserDTO;
use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * @param UserDTO $userDTO
     * @return mixed
     */
    public function getUserIdBySlug(UserDTO $userDTO): mixed;

    /**
     * @param UserDTO $userDTO
     * @return mixed
     */
    public function getWholeUserProfileBySlug(UserDTO $userDTO): mixed;

    /**
     * @param UserDTO $userDTO
     * @return mixed
     */
    public function getHiddenUserProfileBySlug(UserDTO $userDTO): mixed;

    /**
     * @param UserDTO $userDTO
     * @return mixed
     */
    public function checkUserExistingBySlug(UserDTO $userDTO): mixed;

    /**
     * @param UserDTO $userDTO
     * @return mixed
     */
    public function checkUserExistingById(UserDTO $userDTO): mixed;

    /**
     * @param UserDTO $userDTO
     * @return mixed
     */
    public function getUserHiddenStatusBySlug(userDTO $userDTO): mixed;

    /**
     * @param User $user
     * @param UserDTO $userDTO
     * @return mixed
     */
    public function checkIfUserIsFollowing(User $user, userDTO $userDTO): mixed;

    /**
     * @param User $user
     * @return mixed
     */
    public function checkIfPostLoaded(User $user): mixed;
}
