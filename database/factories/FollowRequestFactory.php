<?php

namespace Database\Factories;

use App\Enums\FollowRequest\ApprovalStatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FollowRequest>
 */
class FollowRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "sender_id" => User::factory(),
            "reciever_id" => User::factory(),
            "approval_status" => ApprovalStatusEnum::APPROVAL_PENDING
        ];
    }
}
