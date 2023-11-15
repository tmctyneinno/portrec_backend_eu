<?php

namespace Database\Factories;

use App\Models\UserResume;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserResume>
 */
class UserResumeFactory extends Factory
{
    protected $model = UserResume::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // "user_id" => rand(1, 50),
            // "doc_url" => "www.resume.com",
            // "doc_name" => Str::random(10)
        ];
    }
}
