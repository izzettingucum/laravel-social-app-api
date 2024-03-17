<?php

namespace App\DTO;

final class PostDTO
{
    /**
     * @param int $id
     * @param string $title
     * @param int $user_id
     * @param int $is_archived
     */
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly int $user_id,
        public readonly int $is_archived
    )
    {}
}
