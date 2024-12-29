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
        //

        $data = [
            ['plan_name' => 'Basic', 'duration' => '30', 'period' => 'monthly', 'amount' => '5000'],
            ['plan_name' => 'Premium', 'duration' => '30', 'period' => 'monthly', 'amount' => '5000'],
            // ['name' => 'Advance']
        ];

        foreach($data as $dd)Subscription::create($dd);

        
    }
}
