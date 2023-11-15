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
                'company_name' =>  $this->faker->firstName(),
                'company_location' => $this->faker->address(),
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now(),
                'job_title' => $this->faker->realText(300,2),
                'job_level' => rand(1, 5),
                'job_function_id' => rand(1, 5),
                'work_type_id' => rand(1, 5),
                'description' => fake()->sentence(),
                'status' => rand(0, 1)
            ];
    }
}
