<?php

namespace Database\Seeders;

use App\Models\WorkExperience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class WorkExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkExperience::insert([
            'user_id' => 1,
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
        ]);
        WorkExperience::factory(51)->create();
    }
}
