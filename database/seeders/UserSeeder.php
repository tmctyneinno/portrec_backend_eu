<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'name' => "Test Test",
            'email' => "test@gmail.com",
            "password" => Hash::make("123456"),
            "gender" => "male",
            "dob" => Carbon::now(),
            "state" => "lagos",
            "country" => "2",
            "address" => Str::random(10),
            "linkedin" => "linkedin.com",
            "facebook" => "facebook.com",
            "title" => "Investent Banker",
            "skills" => json_encode(["Plumbing", "php", "fulstack"]),
            "about_me" => Str::excerpt("banker")
        ]);

        User::factory(200)->create();
    }
}
