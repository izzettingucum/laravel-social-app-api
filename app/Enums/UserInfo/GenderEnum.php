<?php

namespace App\Enums\UserInfo;

enum GenderEnum: int
{
    case GENDER_MAN = 0;
    case GENDER_WOMAN = 1;

    /**
     * @return self[]
     */
    public static function toArrayAllValues(): array
    {
        return array_column(self::cases(), "value");
    }

    /**
     * @return string
     */
    public static function getGenderMan(): string
    {
        return self::GENDER_MAN->value;
    }

    /**
     * @return string
     */
    public static function getGenderWoman(): string
    {
        return self::GENDER_WOMAN->value;
    }
}
