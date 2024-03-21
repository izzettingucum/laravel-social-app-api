<?php

use App\Http\Controllers\Api\User\UserProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(["prefix" => "/user", "middleware" => "auth"], function () {
    Route::group(["prefix" => "/profile"], function () {
        Route::get("/index", [UserProfileController::class, "index"])->name("user.profile.index");
    });
});



