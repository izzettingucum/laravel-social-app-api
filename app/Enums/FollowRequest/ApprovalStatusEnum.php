<?php

namespace App\Enums\FollowRequest;

enum ApprovalStatusEnum: int
{
    case APPROVAL_DENIED = 0;
    case APPROVAL_PENDING = 1;
    case APPROVAL_APPROVED = 2;

    /**
     * @return ApprovalStatusEnum[]
     */
    public static function toArrayAllValues(): array
    {
        return array_column(self::cases(), "value");
    }

    /**
     * @return string
     */
    public static function getApprovalPending(): string
    {
        return self::APPROVAL_PENDING->value;
    }
}
