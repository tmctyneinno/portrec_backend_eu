<?php

namespace Database\Seeders;

use App\Models\JobOpening;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JobOpening::factory(100)->create();
    }
}
