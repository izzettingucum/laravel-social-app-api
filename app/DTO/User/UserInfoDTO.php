<?php

namespace App\DTO\User;

final class UserInfoDTO
{
    /**
     * @param string|null $name
     * @param int|null $user_id
     * @param string|null $birthday
     * @param int|null $gender
     * @param string|null $city
     * @param string|null $phone
     */
    public function __construct(
        public readonly ?string $name,
        public readonly ?int $user_id,
        public readonly ?string $birthday,
        public readonly ?int $gender,
        public readonly ?string $city,
        public readonly ?string $phone
    )
    {}
}
