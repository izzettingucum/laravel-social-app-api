<?php

namespace App\Repositories\Post;

use App\DTO\Post\PostDTO;
use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    private Post $postModel;

    public function __construct(Post $postModel)
    {
        $this->postModel = $postModel;
    }

    /**
     * @param PostDTO $postDTO
     * @return mixed
     */
    public function createPost(PostDTO $postDTO): mixed
    {
        return $this->postModel->create([
            "user_id" => $postDTO->user_id,
            "title" => $postDTO->title
        ]);
    }

    /**
     * @param PostDTO $postDTO
     * @return mixed
     */
    public function checkIfPostExists(PostDTO $postDTO): mixed
    {
        return $this->postModel
            ->find($postDTO->id)
            ->exists();
    }
}
