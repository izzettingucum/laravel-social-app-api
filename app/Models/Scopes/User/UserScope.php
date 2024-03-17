<?php

namespace App\Models\Scopes\User;

trait UserScope
{
    /**
     * @param $query
     * @param string $slug
     * @return mixed
     */
    public function scopeGetUserBySlug($query, string $slug): mixed
    {
        return $query->where("slug", $slug);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeGetUserInfo($query): mixed
    {
        return $query->with("userInfo");
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeGetNonArchivedPostsWithImages($query): mixed
    {
        return $query->with(["userPosts" => function ($query) {
            return $query->where("is_archived", false)->with("postImages");
        }]);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeGetNonArchivedPostCount($query): mixed
    {
        return $query->withCount(["userPosts" => function ($query) {
            return $query->where("is_archived", false);
        }]);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeGetUserFollowersCount($query): mixed
    {
        return $query->withCount("userFollowers");
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeGetUserFollowingCount($query): mixed
    {
        return $query->withCount("userFollowing");
    }

    /**
     * @param $query
     * @param int $userId
     * @return mixed
     */
    public function scopeCheckIfUserIsFollowing($query, int $userId): mixed
    {
        return $query->whereHas(["userFollowing" => function ($query) use ($userId) {
            return $query->where("user_id", $userId);
        }]);
    }
}
