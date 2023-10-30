<?php

namespace Database\Factories;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    protected $model = Candidate::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id"  => rand(1, 51),
            "phone" => fake()->phoneNumber(),
            "professional_headline" => fake()->sentence(),
            "availability_id" => rand(1, 5),
            "salary_expectation" => rand(100, 1000),
            "job_function_id" => rand(1, 11),
            "years_Experience" => rand(1, 10)
        ];
    }
}
