<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Services\Post\PostMediaService;
use App\Services\Post\PostService;
use App\Services\User\UserService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Throwable;

class PostController extends Controller
{
    private PostService $postService;
    private UserService $userService;
    private PostMediaService $postMediaService;

    /**
     * @param PostService $postService
     * @param UserService $userService
     * @param PostMediaService $postMediaService
     */
    public function __construct(PostService $postService, UserService $userService, PostMediaService $postMediaService)
    {
        $this->postService = $postService;
        $this->userService = $userService;
        $this->postMediaService = $postMediaService;
    }

    /**
     * @param CreatePostRequest $request
     * @return JsonResponse
     * @throws Throwable
     * @throws ValidationException
     */
    public function create(CreatePostRequest $request): JsonResponse
    {
        $post = $this->postService->createPostForCurrentLoggedInUser($request);
        $this->postMediaService->createPostMedia($request, $post->id);

        return response()->json([
            "message" => "Post created successfully."
        ], Response::HTTP_CREATED);
    }

    /**
     * @param int $post_id
     * @return JsonResponse
     * @throws Throwable
     */
    public function delete(int $post_id): JsonResponse
    {
        $this->postService->checkIfPostExistsById($post_id);
        $post = $this->postService->getPostById($post_id);
        $this->authorize("checkIfCurrentLoggedInUserIsPostUser", $post);
        $this->postService->deletePostWithMedia($post);

        return response()->json([
            "message" => "Post deleted successfully."
        ], Response::HTTP_OK);
    }

    /**
     * @param int $post_id
     * @param UpdatePostRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(int $post_id, UpdatePostRequest $request): JsonResponse
    {
        $this->postService->checkIfPostExistsById($post_id);
        $post = $this->postService->getPostById($post_id);
        $this->authorize("checkIfCurrentLoggedInUserIsPostUser", $post);
        $this->postService->updatePost($post, $request);

        return response()->json([
            "message" => "Post updated successfully."
        ], Response::HTTP_OK);
    }
}
