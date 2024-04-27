<?php

use App\Http\Controllers\Api\Post\PostController;
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

Route::group(["prefix" => "/user"], function () {
    Route::group(["prefix" => "/profile", "middleware" => "auth"], function () {
        Route::get("/index", [UserProfileController::class, "index"])->name("user.profile.index");
    });
    Route::get("/{slug}", [UserProfileController::class, "show"])->name("user.profile.show");
});

Route::group(["prefix" => "/post", "middleware" => "auth"], function () {
    Route::post("/create", [PostController::class, "create"])->name("post.create");
    Route::patch("/update/{post_id}", [PostController::class, "update"])->name("post.update");
    Route::delete("/delete/{post_id}", [PostController::class, "delete"])->name("post.delete");
});


