<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $num = rand(111111111, 999999999);
        // $arr = ["080", "090", "070", "081"];
        // $start = strval(Arr::random($arr));

        // Admin::insert([
        //     'name' => Str::random(10),
        //     'email' => Str::random(8) . "@gmail.com",
        //     "phone" => $start . $num,
        //     "password" => Hash::make("123456"),
        // ]);
    }
}
