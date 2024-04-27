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
    public function checkIfPostExistsById(PostDTO $postDTO): mixed
    {
        return $this->postModel
            ->query()
            ->where("id", $postDTO->id)
            ->exists();
    }

    /**
     * @param PostDTO $postDTO
     * @return mixed
     */
    public function getPostById(PostDTO $postDTO): mixed
    {
        return $this->postModel->find($postDTO->id);
    }

    /**
     * @param Post $post
     * @param PostDTO $postDTO
     * @return mixed
     */
    public function updatePost(Post $post, PostDTO $postDTO): mixed
    {
        foreach ($postDTO as $key => $value) {
            if (!is_null($value) && in_array($key, $post->getFillable())) {
                $post->{$key} = $value;
            }
        }

        $post->save();

        return $post;
    }

    /**
     * @param Post $post
     * @return bool|null
     */
    public function deletePostByPostModel(Post $post): ?bool
    {
        return $post->delete();
    }
}
