<?php

namespace Database\Seeders;

use App\Models\UserResume;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ResumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserResume::insert([
            "user_id" => 1,
            "resume_url" => "www.resume.com",
            "resume_name" => Str::random(10)
        ]);
        UserResume::factory(100)->create();
    }
}
