<?php

namespace App\Enums\PostMedia;

enum PostMediaEnum : string
{
    case TYPE_REELS = "reels";
    case TYPE_IMAGE = "image";

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
    public static function getTypeImage(): string
    {
        return self::TYPE_IMAGE->value;
    }

    /**
     * @return string
     */
    public static function getTypeReels(): string
    {
        return self::TYPE_REELS->value;
    }
}
