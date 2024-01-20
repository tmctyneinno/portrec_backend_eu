<?php

namespace Database\Seeders;

use App\Models\CoverLetter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CoverLetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CoverLetter::insert([
            "user_id" => 1,
            "doc_url" => "www.resume.com",
            "content" => Str::random(10)
        ]);
        CoverLetter::factory(8)->create();
    }
}
