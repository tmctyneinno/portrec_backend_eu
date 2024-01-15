<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobOpeningQuestion>
 */
class JobOpeningQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'recruiter_id' => rand(1, 10),
            'job_opening_id' => rand(1, 50),
            'questions' => $this->faker->sentence(rand(5, 10)),
            'answers' => $this->faker->sentence(rand(3, 5)),
        ];
    }
}
