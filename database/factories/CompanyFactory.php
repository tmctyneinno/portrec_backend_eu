<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'recruiter_id' => 1,
            "industry_id" => rand(1, 500),
            "company_type_id" => rand(1, 40),
            "company_size_id" => rand(1, 6),
            "country_id" => rand(1, 120),
            "city" => Str::random(20),
            "name" => Str::random(8),
            "description" => fake()->sentences(),
            "address" => fake()->address(),
            "website" => fake()->url(),
            "email" => fake()->unique()->safeEmail(),
            "image" => fake()->imageUrl()
        ];
    }
}
