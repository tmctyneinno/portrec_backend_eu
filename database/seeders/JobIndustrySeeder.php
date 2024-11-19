<?php

namespace Database\Seeders;

use App\Models\Industry;
use App\Models\JobFunction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobIndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $data = [
        ['name' => 'Accounting, Auditing & Finance'],
        ['name' => 'Banking, Finance & Insurance'],
        ['name' => 'Creative & Design'],
        ['name' => 'Construction, Education'],
        ['name' => 'Consulting & Strategy'],
        ['name' => 'Customer Service & Support'],
        ['name' => 'Community & Social Services'],
        ['name' => 'Driver & Transport Services'],
        ['name' => 'Energy & Utilities'],
        ['name' => 'Enforcement & Security'],
        ['name' => 'Engineering & Technology'],
        ['name' => 'Entertainment'],
        ['name' => 'Events & Sport'],
        ['name' => 'Estate Agents & Property Management'],
        ['name' => 'Food Services & Catering'],
        ['name' => 'Farming & Agriculture'],
        ['name' => 'Medical & Pharmaceutical'],
        ['name' => 'Human Resources'],
        ['name' => 'Health & Safety'],
        ['name' => 'Hospitality & Leisure'],
        ['name' => 'Law & Compliance'],
        ['name' => 'Marketing & Communications'],
        ['name' => 'Management & Business Development'],
        ['name' => 'Product & Project Management'],
        ['name' => 'Software & Data'],
        ['name' => 'Sales'],
        ['name' => 'Supply Chain & Procurement'],
        ['name' => 'Trades & Services'],
        ['name' => 'Quality Control & Assurance'],
       ];

       foreach($data as $dats)Industry::create($dats);
    }
}
