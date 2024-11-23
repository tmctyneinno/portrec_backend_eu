<?php

namespace Database\Seeders;

use App\Models\Availability;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
  
        $data = [

            ['name' => 'Immediately'],
            ['name' => '1 Week'],
            ['name' => '2 Weeks'],
            ['name' => '3 Weeks'],
            ['name' => '1 month'],
            ['name' => 'more than 3 months'],

        ];
        foreach($data as $dd)Availability::create($dd);
    }
}
