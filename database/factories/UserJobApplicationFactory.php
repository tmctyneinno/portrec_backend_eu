<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserJobApplication>
 */
class UserJobApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "job_id" => rand(1, 50),
            "resume_link" => "www.example.com",
            "cover_letter_link" => "www.example.com",
            "cover_letter" => Str::excerpt("cover letter")
        ];
    }
}
