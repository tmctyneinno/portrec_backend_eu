<?php
namespace Database\Factories;

use App\Models\JobOpening;
use Carbon\Carbon;
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
        $qualification = collect([1, 2, 3, 4, 5]);
        $responsibility = collect(["Responsibilities", "Who You are", "Nice to have"]);
        return [
            "title" => $this->faker->realText(30,2),
            "description" =>  $this->faker->paragraph(4),
            "required_skills" => json_encode($qualification->map(function ($skill, $key) {
                return ["name" => $this->faker->firstName(), "id" => $key];
            })),
            "job_level_id" => rand(1, 5),
            "location" => $this->faker->address(),
            "recruiter_id" => rand(1, 5),
            "company_id" => 1,
            "country_id" => 1,
            'industry_id' => rand(1,9),
            "job_type_id" => rand(1, 2),
            "experience" => $this->faker->realText(30,2),
            "min_salary" => $this->faker->biasedNumberBetween(2000, 2500),
            "max_salary" => $this->faker->biasedNumberBetween(2000, 2500),
            "benefits" => json_encode($qualification->map(function ($item) {
                return ["title" => $this->faker->realText(30,2), "icon" => "", "description" => $this->faker->paragraph(2)];
            })),
            "deadline" => fake()->dateTimeBetween("-1 month", "+1 month"),
            "status" => 0,
            "total_view" => rand(1, 10),
            "capacity" => rand(1, 10),
            "total_applied" => rand(1, 5),
            "responsibilities" => json_encode($responsibility),
            "other_qualifications" => json_encode($responsibility->map(function ($item) {
                return ["title" => $item,  "descriptions" => collect([1, 2, 3, 4])->map(function ($dt) {
                    return $this->faker->realText(30,2);
                })];
            })),
        ];
    }
}
