<?php

namespace App\DTO\User;

final class UserDTO
{
    /**
     * @param int|null $id
     * @param string|null $username
     * @param string|null $slug
     * @param string|null $email
     * @param string|null $password
     * @param int|null $two_factor_auth
     */
    public function __construct(
        public readonly ?int$id,
        public readonly ?string $username,
        public readonly ?string $slug,
        public readonly ?string $email,
        public readonly ?string $password,
        public readonly ?int $two_factor_auth
    )
    {}
}
