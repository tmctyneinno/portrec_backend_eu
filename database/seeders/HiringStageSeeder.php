<?php

namespace Database\Seeders;

use App\Models\HiringStage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HiringStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'In-Review'],
            ['name' => 'Interviewing'],
            ['name' => 'Shortlisted'],
            ['name' => 'Offered'],
            ['name' => 'Rejected'],
        ];


        foreach($data as $dd)
        {
            HiringStage::create($dd);
        }
    }
}
