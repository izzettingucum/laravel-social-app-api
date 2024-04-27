<?php

namespace App\DTO\Post;

final class PostDTO
{
    /**
     * @param int|null $id
     * @param string|null $title
     * @param int|null $user_id
     * @param int|null $is_archived
     */
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $title,
        public readonly ?int $user_id,
        public readonly ?int $is_archived
    )
    {}
}
