<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\User\UserProfileService;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    private UserProfileService $userProfileService;

    /**
     * @param UserProfileService $userProfileService
     */
    public function __construct(UserProfileService $userProfileService)
    {
        $this->userProfileService = $userProfileService;
    }

    /**
     * @return UserResource
     */
    public function index(): UserResource
    {
        $user = $this->userProfileService->getCurrentLoggedInUserProfile();

        return UserResource::make(
            $user
        );
    }
}
