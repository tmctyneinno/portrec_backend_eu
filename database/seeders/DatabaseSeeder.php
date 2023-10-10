<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $this->call([
            UserSeeder::class,
            AvailabilitySeeder::class,
            RecruiterSeeder::class,
            JobFunctionSeeder::class,
            CompanySeeder::class,
            CompanyTypeSeeder::class,
            JobSeeder::class,
            EducationSeeder::class,
            ApplicationQuestionSeeder::class,
            ResumeSeeder::class,
            ProfilePictureSeeder::class,
            WorkExperienceSeeder::class,
            CoverLetterSeeder::class,
            CountrySeeder::class,
            CandidateSeeder::class,
            ProfilePictureSeeder::class,
            SkillSeeder::class,
            UserJobApplicationSeeder::class,


            // AdminSeeder::class,
            // CompanySeeder::class,
        ]);
    }
}
