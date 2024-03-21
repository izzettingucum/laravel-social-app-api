<?php

namespace App\Repositories\User;

use App\DTO\User\UserDTO;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private User $userModel;

    /**
     * @param User $userModel
     */
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function getUserProfileByUserModel(User $user): mixed
    {
        return $user
            ->GetUserInfo()
            ->GetNonArchivedPostsWithImages()
            ->GetNonArchivedPostCount()
            ->GetUserFollowersCount()
            ->GetUserFollowingsCount()
            ->first();
    }

    /**
     * @param UserDTO $userDTO
     * @return mixed
     */
    public function getUserProfileBySlug(UserDTO $userDTO): mixed
    {
        return $this->userModel
            ->GetUserBySlug($userDTO->slug)
            ->GetUserInfo()
            ->GetNonArchivedPostsWithImages()
            ->GetNonArchivedPostCount()
            ->GetUserFollowersCount()
            ->GetUserFollowingsCount()
            ->first();
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function getUserHiddenStatus(User $user): mixed
    {
        return $user->userInfo()->first("is_hidden");
    }

    /**
     * @param User $user
     * @param UserDTO $userDTO
     * @return mixed
     */
   public function checkIfUserIsFollowing(User $user, UserDTO $userDTO): mixed
   {
       return $user
           ->CheckIfUserIsFollowing($userDTO->id)
           ->exists();
   }
}
