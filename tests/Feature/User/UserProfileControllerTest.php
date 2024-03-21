<?php

namespace Tests\Feature\User;

use App\Models\Post;
use App\Models\User;
use App\Models\UserInfo;
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

        $post = Post::factory()->for($user)->create();

        $post->images()->create([
            "path" => $this->faker->filePath()
        ]);

        $this->actingAs($user);

        $response = $this->getJson(route("user.profile.index"));

        $response->assertOk();

        $this->assertEquals($user->id, $response->json("data")["id"]);
        $this->assertEquals($user_info->id, $response->json("data")["user_info"]["id"]);
        $this->assertEquals(1, $response->json("data")["user_posts_count"]);
    }

    /**
     * @test
     */
    public function itHidesUserProfileDataForNonLoggedInUser()
    {
        User::factory()->create();

        $response = $this->getJson(route("user.profile.index"));

        $response->assertUnauthorized();
    }
}
