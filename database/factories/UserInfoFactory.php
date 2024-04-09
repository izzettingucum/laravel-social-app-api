<?php

namespace Database\Factories;

use App\Enums\UserInfo\GenderEnum;
use App\Models\Image;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserInfo>
 */
class UserInfoFactory extends Factory
{
    use WithFaker;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name,
            "user_id" => User::factory(),
            "birthday" => $this->faker->date,
            "gender" => GenderEnum::getGenderMan(),
            "city" => $this->faker->city,
            "phone" => $this->faker->phoneNumber
        ];
    }
}
