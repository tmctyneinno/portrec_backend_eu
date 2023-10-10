<?php

namespace Database\Seeders;

use App\Models\ProfilePicture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilePictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfilePicture::insert([
            "user_id" => 1,
            "image" => "https://picsum.photos/100/100"
        ]);
        ProfilePicture::factory(200)->create();
    }
}
