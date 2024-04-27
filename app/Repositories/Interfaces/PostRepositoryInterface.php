<?php

namespace App\Repositories\Interfaces;

use App\DTO\Post\PostDTO;
use App\Models\Post;

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
    public function checkIfPostExistsById(PostDTO $postDTO): mixed;

    /**
     * @param PostDTO $postDTO
     * @return mixed
     */
    public function getPostById(PostDTO $postDTO): mixed;

    /**
     * @param Post $post
     * @param PostDTO $postDTO
     * @return mixed
     */
    public function updatePost(Post $post, PostDTO $postDTO): mixed;

    /**
     * @param Post $post
     * @return ?bool
     */
    public function deletePostByPostModel(Post $post): ?bool;
}
