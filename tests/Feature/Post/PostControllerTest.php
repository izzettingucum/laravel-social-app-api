<?php

namespace Tests\Feature\Post;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use WithFaker, LazilyRefreshDatabase;

    /**
     * @test
     */
    public function itCreatesPostSuccessfully()
    {
        Storage::fake();

        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->postJson(route("post.create"), [
            "title" => $this->faker->title,
            "media" => [UploadedFile::fake()->image("test.png", 200, 100)]
        ]);

        $response->assertCreated();
    }

    /**
     * @test
     */
    public function itDoesntCreatePostForNonExistingUser()
    {
        $response = $this->postJson(route("post.create"), [
            "title" => $this->faker->title,
            "media" => UploadedFile::fake()->image("test.png")
        ]);

        $response->assertUnauthorized();
    }
}
