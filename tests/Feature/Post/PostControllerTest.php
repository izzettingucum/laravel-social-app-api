<?php

namespace Tests\Feature\Post;

use App\Models\Post;
use App\Models\PostMedia;
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

    /**
     * @test
     */
    public function itDeletesPostWithPostMediaSuccessfully()
    {
        $user = User::factory()->create();

        $post = Post::factory()->for($user)->create();

        $post_media = PostMedia::factory()->for($post)->create();

        $this->actingAs($user);

        $response = $this->deleteJson(route("post.delete", $post->id));

        $this->assertSoftDeleted($post);

        $this->assertModelMissing($post_media);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function itDoesntDeletePostThatBelongsToAnotherUser()
    {
        $user = User::factory()->create();

        $post = Post::factory()->create();

        $this->actingAs($user);

        $response = $this->deleteJson(route("post.delete", $post->id));

        $response->assertForbidden();
    }

    /**
     * @test
     */
    public function itDoesntDeletePostWithUnvalidId()
    {
        $user = User::factory()->create();

        $post = Post::factory()->create();

        $this->actingAs($user);

        $response = $this->deleteJson(route("post.delete", $this->faker->numberBetween(0, 1000)));

        $response->assertNotFound();
    }

    /**
     * @test
     */
    public function itUpdatesPostSuccessfully()
    {
        $user = User::factory()->create();

        $title = $this->faker->title;

        $post = Post::factory()->for($user)->create();

        $this->actingAs($user);

        $this->patchJson(route("post.update", $post->id), [
            "title" => $title,
        ])->assertOk();

        $this->assertDatabaseHas("posts", [
            "user_id" => $user->id,
            "title" => $title,
            "is_archived" => $post->is_archived
        ]);
    }

    /**
     * @test
     */
    public function itDoesntUpdatePostWithUnvalidId()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->deleteJson(route("post.delete", $this->faker->numberBetween(0, 1000)));

        $response->assertNotFound();
    }

    /**
     * @test
     */
    public function itDoesntUpdatePostThatBelongsToAnotherUser()
    {
        $user = User::factory()->create();

        $post = Post::factory()->create([
            "is_archived" => true
        ]);

        $this->actingAs($user);

        $response = $this->patchJson(route("post.update", $post->id), [
            "title" => $this->faker->title,
            "is_archived" => false
        ]);

        $response->assertForbidden();
    }

    /**
     * @test
     */
    public function itDoesntUpdatePostWithUnvalidAttributes()
    {
        $user = User::factory()->create();

        $post = Post::factory()->create();

        $this->actingAs($user);

        $response = $this->patchJson(route("post.update", $post->id), [
            "title" => 1
        ]);

        $response->assertUnprocessable();
    }
}
