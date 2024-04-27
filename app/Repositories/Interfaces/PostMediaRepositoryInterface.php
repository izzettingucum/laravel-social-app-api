<?php

namespace App\Repositories\Interfaces;

use App\DTO\Post\PostMediaDTO;

interface PostMediaRepositoryInterface
{
    /**
     * @param PostMediaDTO $postMediaDTO
     * @return mixed
     */
    public function createMedia(PostMediaDTO $postMediaDTO): mixed;
}
