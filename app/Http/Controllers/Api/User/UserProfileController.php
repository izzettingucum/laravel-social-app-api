<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    private UserService $userService;

    public function index()
    {
        //
    }

    public function show(string $slug)
    {
        //
    }
}
