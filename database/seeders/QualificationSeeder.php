<?php

namespace Database\Seeders;

use App\Models\Qualification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            ['name' => 'Degree'],
            ['name' => 'Diploma'],
            ['name' => 'High School (S.S.C.E)'],
            ['name' => 'MBA / MSc'],
            ['name' => 'MBBS'],
            ['name' => 'MPhil / PhD'],
            ['name' => 'N.C.E'],
            ['name' => 'OND'],
        ];

        foreach($data as $datas)Qualification::create($datas);
    }
}
