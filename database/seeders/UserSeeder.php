<?php

namespace Database\Seeders;

use App\Models\User;
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
        // User::insert([
        //     'name' => Str::random(10),
        //     'email' => Str::random(8) . "@gmail.com",
        //     "password" => Hash::make("123456"),
        // ]);

        User::factory(50)->create([]);
    }
}
