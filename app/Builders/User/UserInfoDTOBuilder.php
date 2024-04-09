<?php

namespace App\Builders\User;

use App\DTO\User\UserInfoDTO;

final class UserInfoDTOBuilder
{
    private string $name;
    private int $user_id;
    private string $birthday;
    private int $gender;

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): UserInfoDTOBuilder
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param int $user_id
     * @return $this
     */
    public function setUserId(int $user_id): UserInfoDTOBuilder
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @param string $birthday
     * @return $this
     */
    public function setBirthday(string $birthday): UserInfoDTOBuilder
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @param int $gender
     * @return $this
     */
    public function setGender(int $gender): UserInfoDTOBuilder
    {
        $this->gender = $gender;
        return $this;
    }


    /**
     * @return UserInfoDTO
     */
    public function build(): UserInfoDTO
    {
        return new UserInfoDTO($this->name, $this->user_id, $this->birthday, $this->gender);
    }
}
