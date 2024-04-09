<?php

namespace Tests\Feature\User;

use App\Models\Post;
use App\Models\PostMedia;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UserProfileImage;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserProfileControllerTest extends TestCase
{
    use LazilyRefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function itShowsCurrentLoggedInUserProfileCorrectly()
    {
        $user = User::factory()->create();

        $another_user = User::factory()->create();

        $user_info = UserInfo::factory()->for($user)->create();

        $user->userFollowers()->attach($another_user);

        $user->userFollowings()->attach($another_user);

        $user_profile_image = UserProfileImage::factory()->for($user)->create();

        $post = Post::factory()->for($user)->create();

        PostMedia::factory()->for($post)->create();

        $this->actingAs($user);

        $response = $this->getJson(route("user.profile.index"));

        $response->assertOk();

        $this->assertEquals($user->id, $response->json("user")["id"]);
        $this->assertEquals($user_info->name, $response->json("user")["user_info"]["name"]);
        $this->assertEquals(1, $response->json("user")["user_posts_count"]);
        $this->assertEquals(1, $response->json("user")["user_followers_count"]);
        $this->assertEquals(1, $response->json("user")["user_followings_count"]);
        $this->assertEquals($user_profile_image->path, $response->json("user")["user_profile_image"]["path"]);
    }

    /**
     * @test
     */
    public function itShowsAnotherNonHiddenProfileCorrectlyWithLogin()
    {
        $user = User::factory()->create();

        $another_user = User::factory()->create();

        $user_info = UserInfo::factory()->for($user)->create();

        $user_profile_image = UserProfileImage::factory()->for($user)->create();

        $post = Post::factory()->for($user)->create();

        PostMedia::factory()->for($post)->create();

        $this->actingAs($another_user);

        $response = $this->getJson(route("user.profile.show", $user->slug));

        $response->assertOk();

        $this->assertEquals($user->id, $response->json("user")["id"]);
        $this->assertEquals($user_profile_image->path, $response->json("user")["user_profile_image"]["path"]);
        $this->assertEquals($user_info->name, $response->json("user")["user_info"]["name"]);
        $this->assertEquals($post->title, $response->json("user")["user_posts"][0]["title"]);
        $this->assertEquals(0, $response->json("user")["user_followers_count"]);
        $this->assertEquals(0, $response->json("user")["user_followings_count"]);
        $this->assertEquals(1, $response->json("user")["user_posts_count"]);
    }

    /**
     * @test
     */
    public function itShowsAnotherNonHiddenProfileCorrectlyWithoutLogin()
    {
        $user = User::factory()->create();

        $another_user = User::factory()->create();

        $user_info = UserInfo::factory()->for($user)->create();

        $user_profile_image = UserProfileImage::factory()->for($user)->create();

        $user->userFollowers()->attach($another_user);

        $post = Post::factory()->for($user)->create();

        PostMedia::factory()->for($post)->create();

        $response = $this->getJson(route("user.profile.show", $user->slug));

        $response->assertOk();

        $this->assertEquals($user->id, $response->json("user")["id"]);
        $this->assertEquals($user_profile_image->path, $response->json("user")["user_profile_image"]["path"]);
        $this->assertEquals($user_info->name, $response->json("user")["user_info"]["name"]);
        $this->assertEquals($post->title, $response->json("user")["user_posts"][0]["title"]);
        $this->assertEquals(1, $response->json("user")["user_followers_count"]);
    }

    /**
     *@test
     */
    public function itShowsAnotherHiddenProfileCorrectlyWithoutLogin() {

        $user = User::factory()->create([
            "is_hidden" => true
        ]);

        $another_user = User::factory()->create();

        $user_profile_image = UserProfileImage::factory()->for($user)->create();

        $user->userFollowers()->attach($another_user);

        $response = $this->getJson(route("user.profile.show", $user->slug));

        $response->assertUnauthorized();

        $this->assertEquals($user->id, $response->json("user")["id"]);
        $this->assertEquals($user_profile_image->path, $response->json("user")["user_profile_image"]["path"]);
        $this->assertEquals(1, $response->json("user")["user_followers_count"]);
    }

    /**
     *@test
     */
    public function itShowsAnotherHiddenProfileCorrectlyWithLoginAndFollowing()
    {
        $user = User::factory()->create([
            "is_hidden" => true
        ]);

        $another_user = User::factory()->create();

        $user_info = UserInfo::factory()->for($user)->create();

        $user_profile_image = UserProfileImage::factory()->for($user)->create();

        $user->userFollowers()->attach($another_user);

        $post = Post::factory()->for($user)->create();

        PostMedia::factory()->for($post)->create();

        $this->actingAs($another_user);

        $response = $this->getJson(route("user.profile.show", $user->slug));

        $response->assertOk();

        $this->assertEquals($user->id, $response->json("user")["id"]);
        $this->assertEquals($user_profile_image->path, $response->json("user")["user_profile_image"]["path"]);
        $this->assertEquals($user_info->name, $response->json("user")["user_info"]["name"]);
        $this->assertEquals($post->title, $response->json("user")["user_posts"][0]["title"]);
        $this->assertEquals(1, $response->json("user")["user_followers_count"]);
    }

    /**
     * @test
     */
    public function itDoesntShowTheFullProfileOfAnotherHiddenUserProfile()
    {
        $user = User::factory()->create([
            "is_hidden" => true
        ]);

        $user_profile_image = UserProfileImage::factory()->for($user)->create();

        Post::factory()->for($user)->create();

        $another_user = User::factory()->create();

        $this->actingAs($another_user);

        $response = $this->getJson(route("user.profile.show", $user->slug));

        $response->assertUnauthorized();

        $this->assertEquals($user->id, $response->json("user")["id"]);
        $this->assertEquals($user_profile_image->path, $response->json("user")["user_profile_image"]["path"]);
        $this->assertEquals(0, $response->json("user")["user_followers_count"]);
        $this->assertEquals(0, $response->json("user")["user_followings_count"]);
        $this->assertEquals(1, $response->json("user")["user_posts_count"]);
    }
}
