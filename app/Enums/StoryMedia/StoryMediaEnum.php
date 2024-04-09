<?php

namespace App\Enums\StoryMedia;

enum StoryMediaEnum : string
{
    case TYPE_REELS = "reels";
    case TYPE_IMAGE = "image";
    case TYPE_SURVEY = "survey";

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
}
