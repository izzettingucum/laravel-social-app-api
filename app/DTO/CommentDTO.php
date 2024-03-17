<?php

namespace App\DTO;

final class CommentDTO
{
    /**
     * @param int $id
     * @param string $comment
     * @param int $user_id
     * @param int $post_id
     */
    public function __construct(
        public readonly int $id,
        public readonly string $comment,
        public readonly int $user_id,
        public readonly int $post_id
    )
    {}
}
