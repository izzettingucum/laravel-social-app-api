<?php

namespace App\Builders\User;

use App\DTO\User\UserDTO;

final class UserObjectBuilder
{
    private ?int $id = null;
    private ?string $username = null;
    private ?string $slug = null;
    private ?string $email = null;
    private ?string $password = null;
    private ?int $two_factor_auth = null;

    public function setId(int $id): UserObjectBuilder
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $username
     * @return UserObjectBuilder
     */
    public function setUsername(string $username): UserObjectBuilder
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param string $slug
     * @return $this
     */
    public function setSlug(string $slug): UserObjectBuilder
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @param string $email
     * @return UserObjectBuilder
     */
    public function setEmail(string $email): UserObjectBuilder
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $password
     * @return UserObjectBuilder
     */
    public function setPassword(string $password): UserObjectBuilder
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param int $two_factor_auth
     * @return UserObjectBuilder
     */
    public function setTwoFactorAuth(int $two_factor_auth): UserObjectBuilder
    {
        $this->two_factor_auth = $two_factor_auth;
        return $this;
    }

    /**
     * @return UserDTO
     */
    public function build(): UserDTO
    {
        return new UserDTO($this->id, $this->username, $this->slug,$this->email, $this->password, $this->two_factor_auth);
    }

}
