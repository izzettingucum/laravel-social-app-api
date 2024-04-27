<?php

namespace App\Repositories\Interfaces;

use App\DTO\Post\PostMediaDTO;
use App\Models\PostMedia;

interface PostMediaRepositoryInterface
{
    /**
     * @param PostMediaDTO $postMediaDTO
     * @return mixed
     */
    public function createMedia(PostMediaDTO $postMediaDTO): mixed;

    /**
     * @param PostMedia $postMedia
     * @return void
     */
    public function deletePostMediaByPostMediaModel(PostMedia $postMedia): void;
}
