<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Education::insert([
            "user_id" => 1,
            "institution" => Str::random(12),
            // "qualification" => "B.sc",
        ]);
        // Education::factory(10)->create();
    }
}
