<?php

namespace Database\Factories;

use App\Enums\PostMedia\PostMediaEnum;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostMedia>
 */
class PostMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "post_id" => Post::Factory(),
            "path" => $this->faker->imageUrl(),
            "media_type" => PostMediaEnum::getTypeImage()
        ];
    }
}
