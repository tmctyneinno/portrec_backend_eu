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
            AvailabilitySeeder::class,
            JobIndustrySeeder::class,
            CompanyTypeSeeder::class,
            SkillSeeder::class,
            HiringStageSeeder::class,
            AdminSeeder::class,
            QualificationSeeder::class,
            CountryCurrencySeeder::class,
            SubscriptionSeeder::class,
            SubscriptionDataSeeder::class
        ]);
    }
}
