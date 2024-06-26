<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "name" => $this->name,
            "birthday" => $this->birthday,
            "gender" => $this->gender,
            "is_hidden" => $this->is_hidden,
            "city" => $this->city,
            "phone" => $this->phone
        ];
    }
}
