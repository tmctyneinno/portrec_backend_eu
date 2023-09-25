<?php

namespace Database\Factories;

use App\Models\JobOpening;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobOpening>
 */
class JobOpeningFactory extends Factory
{
    protected $model = JobOpening::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => Str::random(10),
            "description" =>  Str::random(100),
            "required_skills" => Str::random(10),
            "job_functions" => rand(1, 10),
            "recruiter_id" => rand(1, 500),
            // "company_id" => rand(1, 500),
            "job_type_id" => rand(1, 500),
            "experience" => Str::random(100)
        ];
    }
}
