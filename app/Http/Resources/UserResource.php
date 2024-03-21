<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return mixed
     */
    public function toArray($request): mixed
    {
        return [
            "id" => $this->id,
            "username" => $this->username,
            "slug" => $this->slug,
            "user_posts_count" => $this->whenCounted('userPosts', function () {
                return $this->user_posts_count;
            }),
            "user_followers_count" => $this->whenCounted("userFollowers", function () {
                return $this->user_followers_count;
            }),
            "user_followings_count" => $this->whenCounted("userFollowings", function () {
                return $this->user_followings_count;
            }),
            "user_info" => UserInfoResource::make($this->whenLoaded("userInfo")),
            "user_posts" => PostResource::collection($this->whenLoaded("userPosts"))
        ];
    }
}
