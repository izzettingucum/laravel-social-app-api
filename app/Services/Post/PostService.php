<?php

namespace App\Services\Post;

use App\Builders\PostDTOBuilder;
use App\Http\Requests\Post\CreatePostRequest;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class PostService
{
    private PostRepositoryInterface $postRepository;

    /**
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param int $user_id
     * @return void
     */
    public function checkIfUserIsCurrentLoggedInUserToCreatePost(int $user_id): void
    {
        $this->authorize("create", $user_id);
    }

    /**
     * @param int $id
     * @return void
     * @throws Throwable
     */
    public function checkIfPostExists(int $id): void
    {
        $postDTO = (new PostDTOBuilder())
            ->setId($id)
            ->build();

        $post_existing = $this->postRepository->checkIfPostExists($postDTO);

        throw_if(
            $post_existing == false,
            new NotFoundHttpException("Post cannot be found")
        );
    }

    /**
     * @param CreatePostRequest $request
     * @return mixed
     * @throws ValidationException
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
        catch (ValidationException $exception) {
            throw ValidationException::withMessages("An error occurred while creating the post.");
        }
    }
}
