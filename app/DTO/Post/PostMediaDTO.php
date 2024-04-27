<?php

namespace App\DTO\Post;

class PostMediaDTO
{
    /**
     * @param int|null $id
     * @param int|null $post_id
     * @param string|null $path
     * @param string|null $media_type
     */
    public function __construct(
        public readonly ?int $id,
        public readonly ?int $post_id,
        public readonly ?string $path,
        public readonly ?string $media_type
    )
    {}
}
