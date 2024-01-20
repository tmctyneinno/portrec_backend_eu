<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "job_id" => rand(1, 5),
            "user_id" => rand(1, 5),
            "cover_letter_id" => rand(1, 5),
            "portfolio_links" => fake()->url(),
            "hiring_stage_id" => rand(1, 5),
            "applied_date" => fake()->dateTimeBetween("-30 days"),
            "status" => rand(0, 1),
            "is_viewed" => rand(0, 1),
        ];
    }
}
