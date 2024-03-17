<?php

namespace App\Builders\User;

use App\DTO\User\UserInfoDTO;

final class UserInfoObjectBuilder
{
    private string $name;
    private int $user_id;
    private string $birthday;
    private int $gender;
    private int $hidden;

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): UserInfoObjectBuilder
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param int $user_id
     * @return $this
     */
    public function setUserId(int $user_id): UserInfoObjectBuilder
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @param string $birthday
     * @return $this
     */
    public function setBirthday(string $birthday): UserInfoObjectBuilder
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @param int $gender
     * @return $this
     */
    public function setGender(int $gender): UserInfoObjectBuilder
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @param int $hidden
     * @return $this
     */
    public function setHidden(int $hidden): UserInfoObjectBuilder
    {
        $this->hidden = $hidden;
        return $this;
    }

    /**
     * @return UserInfoDTO
     */
    public function build(): UserInfoDTO
    {
        return new UserInfoDTO($this->name, $this->user_id, $this->birthday, $this->gender, $this->hidden);
    }
}
