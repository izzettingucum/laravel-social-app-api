<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\User\userService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class UserProfileController extends Controller
{
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $user = $this->userService->getCurrentLoggedInUserProfile();

        return response()->json([
            "user" => UserResource::make($user)
        ], Response::HTTP_OK);
    }

    /**
     * @param string $slug
     * @return JsonResponse
     * @throws Throwable
     */
    public function show(string $slug): JsonResponse
    {
        $this->userService->validateUserExistingBySlug($slug);
        $isHidden = $this->userService->getUserHiddenStatusBySlug($slug);
        $this->userService->setViewProfileStrategyByHiddenStatus($isHidden);
        $user = $this->userService->executeViewProfileStrategy($slug);
        $status = $this->userService->setViewProfileStatus($user);

        return response()->json([
            "user" => UserResource::make($user)
        ], $status);
    }
}
