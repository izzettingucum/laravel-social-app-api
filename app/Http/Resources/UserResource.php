<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

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
            $this->merge(Arr::except(parent::toArray($request), [
                "email",
                "created_at",
                "updated_at",
                "email_verified_at",
                "two_factor_auth"
            ])),
            "user_info" => UserInfoResource::make($this->whenLoaded("userInfo")),
            "user_posts" => PostResource::collection($this->whenLoaded("UserPosts")),
        ];
    }
}
