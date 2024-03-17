<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\User\UserService;

class UserController extends Controller
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
     * @return UserResource
     */
    public function index(): UserResource
    {
        $user = $this->userService->getCurrentLoggedInUser();

        return UserResource::make(
            $user
        );
    }
}
