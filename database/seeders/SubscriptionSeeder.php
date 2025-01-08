<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['plan_name' => 'Free', 'duration' => '10000000', 'period' => 'yearly', 'amount' => '0', 'type' => 'user'],
            // ['plan_name' => 'Basic', 'duration' => '30', 'period' => 'monthly', 'amount' => '2000'],
            ['plan_name' => 'Premium', 'duration' => '30', 'period' => 'monthly', 'amount' => '5000','type' => 'user'],
            ['plan_name' => 'Free', 'duration' => '10000000', 'period' => 'yearly', 'amount' => '0', 'type' => 'recruiter'],
            // ['plan_name' => 'Basic', 'duration' => '30', 'period' => 'monthly', 'amount' => '8000'],
            ['plan_name' => 'Premium', 'duration' => '30', 'period' => 'monthly', 'amount' => '15000', 'type' => 'recruiter'],
        ];

        foreach($data as $dd)Subscription::create($dd);

        
    }
}
