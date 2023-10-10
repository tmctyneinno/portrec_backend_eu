<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkExperience>
 */
class WorkExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return
            [
                'user_id' => rand(1, 51),
                'company_name' => Str::random(10),
                'company_location' => Str::random(20),
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now(),
                'job_title' => Str::random(15),
                'job_level' => rand(1, 5),
                'job_function_id' => rand(1, 5),
                'work_type_id' => rand(1, 5),
                'description' => Str::random(200),
                'status' => rand(0, 1)
            ];
    }
}
