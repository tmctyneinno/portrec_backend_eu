<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            ['name' => 'Active Directory'],
            ['name' => 'Analysis skills'],
            ['name' => 'CSS'],
            ['name' => 'Full-stack development'],
            ['name' => 'Git'],
            ['name' => 'GitHub'],
            ['name' => 'HTML'],
            ['name' => 'iOS'],
            ['name' => 'JavaScript'],
            ['name' => 'jQuery'],
            ['name' => 'Laravel'],
            ['name' => 'Leadership'],
            ['name' => 'Linux'],
            ['name' => 'Microsoft SQL Server'],
            ['name' => 'MySQL'],
            ['name' => 'Operating systems'],
            ['name' => 'Organizational skills'],
            ['name' => 'PHP'],
            ['name' => 'PostgreSQL'],
            ['name' => 'Project management'],
            ['name' => 'SharePoint'],
            ['name' => 'SQL'],
            ['name' => 'Technical support'],
            ['name' => 'Test cases'],
            ['name' => 'VPN'],
            ['name' => 'Vue.js'],
            ['name' => 'Web development'],
            ['name' => 'Windows']
        ];
       foreach($data as $ss) Skill::create($ss);
    }
}
