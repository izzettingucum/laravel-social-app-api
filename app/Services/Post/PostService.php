<?php

namespace App\Services\Post;

use App\Builders\PostDTOBuilder;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Post;
use App\Repositories\Interfaces\PostMediaRepositoryInterface;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class PostService
{
    private PostRepositoryInterface $postRepository;
    private PostMediaRepositoryInterface $postMediaRepository;

    /**
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository, PostMediaRepositoryInterface $postMediaRepository)
    {
        $this->postRepository = $postRepository;
        $this->postMediaRepository = $postMediaRepository;
    }

    /**
     * @param int $post_id
     * @return void
     * @throws Throwable
     */
    public function checkIfPostExistsById(int $post_id): void
    {
        $postDTO = (new PostDTOBuilder())
            ->setId($post_id)
            ->build();

        $post_existing = $this->postRepository->checkIfPostExistsById($postDTO);

        throw_if(
            $post_existing == false,
            new NotFoundHttpException("Post cannot be found")
        );
    }

    /**
     * @param int $post_id
     * @return mixed
     */
    public function getPostById(int $post_id): mixed
    {
        $postDTO = (new PostDTOBuilder())
            ->setId($post_id)
            ->build();

        return $this->postRepository->getPostById($postDTO);
    }

    /**
     * @param CreatePostRequest $request
     * @return mixed
     * @throws Exception
     */
    public function createPostForCurrentLoggedInUser(CreatePostRequest $request): mixed
    {
        try {
            $postDTO = (new PostDTOBuilder())
                ->setUserId(auth()->id())
                ->setTitle($request->title)
                ->build();

            return $this->postRepository->createPost($postDTO);
        }
        catch (Exception $exception) {
            throw new Exception("An error occurred while creating the post: " . $exception->getMessage());
        }
    }

    /**
     * @param Post $post
     * @return void
     * @throws Exception
     */
    public function deletePostWithMedia(Post $post): void
    {
        try {
            DB::transaction(function () use ($post) {
                $post->postMedia()->each(function ($media) {
                    Storage::delete($media->path);
                    $this->postMediaRepository->deletePostMediaByPostMediaModel($media);
                });

                $this->postRepository->deletePostByPostModel($post);
            });
        }
        catch (Exception $exception) {
            throw new Exception("An error occurred while deleting the post: " . $exception->getMessage());
        }
    }

    /**
     * @param Post $post
     * @param UpdatePostRequest $request
     * @return void
     * @throws Exception
     */
    public function updatePost(Post $post, UpdatePostRequest $request): void
    {
        try {
            $postDTO = (new PostDTOBuilder())
                ->setTitle($request->title)
                ->setIsArchived($request->is_archived)
                ->build();

            $this->postRepository->updatePost($post, $postDTO);
        }
        catch (Exception $exception) {
            throw new Exception("An error occurred while updating the post: " . $exception->getMessage());
        }
    }
}
