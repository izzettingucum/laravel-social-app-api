<?php

namespace App\Repositories\Post;

use App\DTO\Post\PostMediaDTO;
use App\Models\PostMedia;
use App\Repositories\Interfaces\PostMediaRepositoryInterface;

class PostMediaRepository implements PostMediaRepositoryInterface
{
    private PostMedia $postMediaModel;

    /**
     * @param PostMedia $postMediaModel
     */
    public function __construct(PostMedia $postMediaModel)
    {
        $this->postMediaModel = $postMediaModel;
    }

    /**
     * @param PostMediaDTO $postMediaDTO
     * @return mixed
     */
    public function createMedia(PostMediaDTO $postMediaDTO): mixed
    {
        return $this->postMediaModel->create([
            "post_id" => $postMediaDTO->post_id,
            "path" => $postMediaDTO->path,
            "media_type" => $postMediaDTO->media_type
        ]);
    }

    /**
     * @param PostMedia $postMedia
     * @return void
     */
    public function deletePostMediaByPostMediaModel(PostMedia $postMedia): void
    {
        $postMedia->delete();
    }
}
