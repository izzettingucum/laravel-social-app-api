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

    public function getUserIdBySlug(UserDTO $userDTO): mixed
    {
        return $this->userModel
            ->GetUserBySlug($userDTO->slug)
            ->select("id")
            ->value("id");
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function getWholeUserProfileByUserModel(User $user): mixed
    {
        return $user
            ->GetUserInfo()
            ->GetNonArchivedPostsWithImages()
            ->GetNonArchivedPostCount()
            ->GetUserFollowersCount()
            ->GetUserFollowingsCount()
            ->GetUserProfileImage()
            ->firstOrFail();
    }

    /**
     * @param UserDTO $userDTO
     * @return mixed
     */
    public function getWholeUserProfileBySlug(UserDTO $userDTO): mixed
    {
        return $this->userModel
            ->GetUserBySlug($userDTO->slug)
            ->GetNameThatBelongsToUserFromUserInfo()
            ->GetNonArchivedPostsWithImages()
            ->GetNonArchivedPostCount()
            ->GetUserFollowersCount()
            ->GetUserFollowingsCount()
            ->GetUserProfileImage()
            ->firstOrFail();
    }

    /**
     * @param UserDTO $userDTO
     * @return mixed
     */
    public function getHiddenUserProfileBySlug(UserDTO $userDTO): mixed
    {
        return $this->userModel
            ->GetUserBySlug($userDTO->slug)
            ->GetNonArchivedPostCount()
            ->GetUserFollowersCount()
            ->GetUserFollowingsCount()
            ->getUserProfileImage()
            ->firstOrFail();
    }

    /**
     * @param UserDTO $userDTO
     * @return mixed
     */
    public function checkUserExisting(UserDTO $userDTO): mixed
    {
        return $this->userModel
            ->GetUserBySlug($userDTO->slug)
            ->exists();
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function getUserHiddenStatusBySlug(UserDTO $userDTO): mixed
    {
        return $this->userModel
            ->GetUserBySlug($userDTO->slug)
            ->first("is_hidden");
    }

    /**
     * @param User $user
     * @param UserDTO $userDTO
     * @return mixed
     */
    public function checkIfUserIsFollowing(User $user, UserDTO $userDTO): mixed
    {
        return $user
            ->CheckIfUserIsFollowingById($userDTO->id)
            ->exists();
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function checkIfPostLoaded(User $user): mixed
    {
        return $user->relationLoaded("userPosts");
    }
}
