<?php

namespace App\Repositories\Interfaces;

use App\DTO\Post\PostDTO;

interface PostRepositoryInterface
{
    /**
     * @param PostDTO $postDTO
     * @return mixed
     */
    public function createPost(PostDTO $postDTO): mixed;

    /**
     * @param PostDTO $postDTO
     * @return mixed
     */
    public function checkIfPostExists(PostDTO $postDTO): mixed;
}
