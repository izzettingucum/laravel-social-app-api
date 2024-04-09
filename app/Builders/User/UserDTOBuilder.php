<?php

namespace App\Builders\User;

use App\DTO\User\UserDTO;

final class UserDTOBuilder
{
    private ?int $id = null;
    private ?string $username = null;
    private ?string $slug = null;
    private ?string $email = null;
    private ?string $password = null;
    private ?int $two_factor_auth = null;
    private ?bool $is_hidden = null;

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id): UserDTOBuilder
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $username
     * @return UserDTOBuilder
     */
    public function setUsername(string $username): UserDTOBuilder
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param string $slug
     * @return $this
     */
    public function setSlug(string $slug): UserDTOBuilder
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @param string $email
     * @return UserDTOBuilder
     */
    public function setEmail(string $email): UserDTOBuilder
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $password
     * @return UserDTOBuilder
     */
    public function setPassword(string $password): UserDTOBuilder
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param int $two_factor_auth
     * @return UserDTOBuilder
     */
    public function setTwoFactorAuth(int $two_factor_auth): UserDTOBuilder
    {
        $this->two_factor_auth = $two_factor_auth;
        return $this;
    }

    /**
     * @param bool $is_hidden
     * @return UserDTOBuilder
     */
    public function setIsHidden(bool $is_hidden): UserDTOBuilder
    {
        $this->is_hidden = $is_hidden;
        return $this;
    }

    /**
     * @return UserDTO
     */
    public function build(): UserDTO
    {
        return new UserDTO($this->id, $this->username, $this->slug,$this->email, $this->password, $this->two_factor_auth, $this->is_hidden);
    }

}
