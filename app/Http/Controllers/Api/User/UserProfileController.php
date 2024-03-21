<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\User\UserProfileService;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    private UserProfileService $userService;

    /**
     * @param UserProfileService $userService
     */
    public function __construct(UserProfileService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return UserResource
     */
    public function index(): UserResource
    {
        $user = $this->userService->getCurrentLoggedInUserProfile();

        return UserResource::make(
            $user
        );
    }
}
