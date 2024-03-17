<?php

namespace App\DTO\User;

final class UserInfoDTO
{
    /**
     * @param string $name
     * @param int $user_id
     * @param string $birthday
     * @param int $gender
     * @param int $hidden
     */
    public function __construct(
        public readonly string $name,
        public readonly int $user_id,
        public readonly string $birthday,
        public readonly int $gender,
        public readonly int $hidden
    )
    {}
}
