<?php

namespace Tests\Feature\User;

use App\Models\Post;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use LazilyRefreshDatabase;

    /**
     * @test
     */
    public function itShowsCurrentLoggedInUserCorrectly()
    {
        $user = User::factory()->create();

        UserInfo::factory()->for($user)->create();

        Post::factory()->for($user)->create();

        $this->actingAs($user);

        $response = $this->getJson(route("user.index"))->dump();

        $response->assertOk();

        $this->assertEquals($user->id, $response->json("data")["id"]);
    }

    /**
     * @test
     */
    public function itDoesntShowAnotherLoggedInUser()
    {
        $userOne = User::factory()->create();
        $userTwo = User::factory()->create();

        $this->actingAs($userOne);

        $response = $this->getJson(route("user.index"));

        $this->assertEquals($userOne->id, $response->json("data")["id"]);

        $this->assertNotEquals($userTwo->id, $response->json("data")["id"]);
    }

    /**
     * @test
     */
    public function itHidesUserDataForNonLoggedInUser()
    {
        User::factory()->create();

        $response = $this->getJson(route("user.index"));

        $response->assertUnauthorized();
    }
}
