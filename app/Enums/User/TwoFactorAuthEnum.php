<?php

namespace App\Enums\User;

enum TwoFactorAuthEnum: int
{
    case TWO_FACTOR_DENIED = 0;
    case TWO_FACTOR_PENDING = 1;
    case TWO_FACTOR_ACTIVATED = 2;

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
    public static function getTwoFactorDenied(): string
    {
        return self::TWO_FACTOR_DENIED->value;
    }
}
