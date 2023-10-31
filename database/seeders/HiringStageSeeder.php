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
        HiringStage::factory(5)->create();
    }
}
