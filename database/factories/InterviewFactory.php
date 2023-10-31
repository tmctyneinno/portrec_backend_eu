<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Interview>
 */
class InterviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => rand(1, 20),
            "recruiter_id" => rand(1, 200),
            "application_id" => rand(1, 9),
            "interview_date" => fake()->date('Y-m-d'),
            "status" => rand(0, 1),
            "location" => fake()->country()
        ];
    }
}
