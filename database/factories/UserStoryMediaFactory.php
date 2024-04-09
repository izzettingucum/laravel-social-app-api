<?php

namespace Database\Factories;

use App\Enums\StoryMedia\StoryMediaEnum;
use App\Models\Story;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserStoryMedia>
 */
class UserStoryMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "story_id" => Story::factory(),
            "path" => $this->faker->filePath(),
            "media_type" => StoryMediaEnum::getTypeImage()
        ];
    }
}
